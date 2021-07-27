<?php

declare(strict_types=1);

namespace SchGroup\IpsPayment;

use Exception;
use JsonException;
use SchGroup\IpsPayment\Transactions\StatusTransaction;
use SchGroup\IpsPayment\Transactions\GetLinkTransaction;
use SchGroup\IpsPayment\Transactions\QueryTransactionInterface;

class IpsPayment
{
    private const POST_HEADERS = [
        'Content-Type: application/x-www-form-urlencoded',
    ];

    private const GET_HEADERS = [
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
    ];

    /**
     * @param GetLinkTransaction $transaction
     * @return string
     * @throws JsonException
     * @throws Exception
     */
    public function getLink(GetLinkTransaction $transaction): string
    {
        $requestBody = $this->generateBody($transaction);
        $requestLink = $transaction->getShopSettings()->getTransitionCreatePath();
        $response = $this->sendPostRequest($requestLink, $requestBody);

        $this->prepareResponse($response);

        return $response['DirectLinkIs'];
    }

    /**
     * @param $transaction $transaction
     * @return int
     * @throws JsonException
     * @throws Exception
     */
    public function getStatus(StatusTransaction $transaction): int
    {
        $requestBody = $this->generateBody($transaction);
        $requestLink = $transaction->getShopSettings()->getTransitionGetPath();
        $response = $this->sendGetRequest($requestLink, $requestBody);

        return (int)$response['Transaction_Status']['State'];
    }

    /**
     * @param QueryTransactionInterface $transaction
     * @return array
     */
    private function generateBody(QueryTransactionInterface $transaction): array
    {
        $paramsToString = implode('!', array_values($transaction->toArray()));
        $paramsToString .= '!' . $transaction->getShopSettings()->getSecretKey();
        $paramsToString .= '|' . $transaction->getShopSettings()->getSecretKey();

        return array_merge($transaction->toArray(), [
            'SHA'=> hash('sha512', base64_encode($paramsToString)),
        ]);
    }

    /**
     * @return array
     * ```php
     *  [
     *      'Code'                     => '200',
     *      'Method'                   => 'GET',
     *      'Url_To_Redirect_Customer' => '<url-payment-form-web>',
     *      'SACS'                     => '<token>',
     *      'DirectLinkIs'             => '<full-uri-redirect>',
     *  ]
     *  [
     *      'ErrorCode'        => '<error-code>',
     *      'ErrorDescription' => '<error-description>',
     *  ]
     * ```
     * @throws JsonException
     * @throws Exception
     */
    private function sendPostRequest(string $link, array $body): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link . '/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::POST_HEADERS);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Curl request error: ' . $ch);
        }

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @return array
     * ```php
     *  [
     *      'Created'           => '2020-08-26 12:03:35',
     *      'Merchant_Order_Id' => '1598436214-7790-D',
     *      'Financial'         =>
     *          'Total_Paid' => '49.99',
     *          'Total_Fees' => '1.00',
     *          'Total_Net'  => '48.99',
     *          'Currency'   => 'EUR',
     *      ],
     *      'Customer' => [
     *          'Ip_Client_Transaction' => '92.184.105.244',
     *          'Ips_ClientID'          => 'AS-9473029775382228',
     *          'Client'                => [
     *              'Name'        => 'client name',
     *              'Firstname'   => 'client first name',
     *              'Email'       => 'client@email.com',
     *              'Phone'       => '',
     *              'Original_IP' => '176.180.84.22',
     *              'Known_since' => '2020-08-25 21:21:12',
     *          ],
     *      ],
     *      'Bank' => [
     *          'Internal_IPS_Id' => '150-26082020-120336',
     *          'Transaction ID'  => 'TX-3165299470680365,
     *      ],
     *      'Card' => [
     *          'Type'              => 'MASTERCARD',
     *          'Number'            => '0000XXXXXXXX0000',
     *          'Expire'            => '10/2020',
     *          'Id'                => 'CC-4645456011192904',
     *          'Recurring_Capable' => 'yes', //yes = register Id for charge with ID
     *      ],
     *      'ProcessIPN' => [
     *          'Processed'        => [
     *              'state'      => '2',
     *              'descriptor' => 'Ipn request successfully completed',
     *          ],
     *          'Return HTTP Code' => '200',
     *          'Uri Call'         => 'https://www.mywebsite.com/notifypayment',
     *      ],
     *      'Transaction_Status' => [
     *          'State'                 => '2',
     *          'Description'           => 'Payment has been approved successfully',
     *          'Bank_Code'             => '000000000',
     *          'Bank_Code_Description' => 'APPROUVED',
     *      ]
     *  ]
     * ```
     * @throws JsonException
     * @throws Exception
     */
    private function sendGetRequest(string $link, array $body): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link . '/?' . http_build_query($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::GET_HEADERS);
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Curl request error: ' . $ch);
        }

        return json_decode($result, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array $response
     * @throws Exception
     */
    private function prepareResponse(array $response): void
    {
        if (isset($response['ErrorCode'])) {
            throw new Exception('ips request error: ' . $response['ErrorDescription']);
        }
    }
}
