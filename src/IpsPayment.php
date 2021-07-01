<?php

declare(strict_types=1);

namespace SchGroup\IpsPayment;

use Exception;
use JsonException;
use GuzzleHttp\Client;

class IpsPayment
{
    private const HEADERS = [
        'Content-Type' => 'application/x-www-form-urlencoded',
    ];

    /**
     * @param Transaction $transaction
     * @return string
     * @throws JsonException
     * @throws Exception
     */
    public function buildLink(Transaction $transaction): string
    {
        $requestBody = $this->prepareParams($transaction);
        $requestLink = $transaction->getShopSettings()->getTransitionPath();
        $response = $this->sendRequest($requestLink, $requestBody);

        print_r($response); exit;

        $this->prepareResponse($response);

        return $response['Url_To_Redirect_Customer'];
    }

    /**
     * @param Transaction $transaction
     * @return array
     */
    private function prepareParams(Transaction $transaction): array
    {
        $paramsToString  = implode('!', $transaction->toArray());
        $paramsToString .= implode('|', [
            $paramsToString,
            $transaction->getShopSettings()->getMerchantKey()
        ]);

        return array_merge($transaction->toArray(), [
            'SHA' => hash('sha512', base64_encode($paramsToString))
        ]);
    }

    /**
     * @param string $link
     * @return array
     * ```php
     *  [
     *      'Code'                     => '200',
     *      'Method'                   => 'GET",
     *      'Url_To_Redirect_Customer' => '<url-payment-form-web>',
     *      'SACS'                     => '<token>',
     *      'Direct_Link_Is'           => '<full-uri-redirect>',
     *  ]
     *  [
     *      'Error_Code'        => '<error-code>',
     *      'Error_Description' => '<error-description>',
     *  ]
     * ```
     * @throws JsonException
     */
    private function sendRequest(string $link, array $body): array
    {
        $client = new Client();
        $response = $client->post($link, [
            'form_params' => $body,
            'headers'     => self::HEADERS,
        ]);

        return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array $response
     * @throws Exception
     */
    private function prepareResponse(array $response): void
    {
        if (!isset($response['Code'])) {
            throw new Exception('ips request error: ' . $response['Error_Description']);
        }
    }
}
