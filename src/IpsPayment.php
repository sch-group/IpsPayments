<?php

declare(strict_types=1);

namespace SchGroup\IpsPayment;

use Exception;
use JsonException;

class IpsPayment
{
    private const HEADERS = ['Content-Type: application/x-www-form-urlencoded'];

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

        $this->prepareResponse($response);

        return $response['DirectLinkIs'];
    }

    /**
     * @param Transaction $transaction
     * @return array
     */
    private function prepareParams(Transaction $transaction): array
    {
        $paramsToString = implode('!', array_values($transaction->toArray()));
        $paramsToString .= '!' . $transaction->getShopSettings()->getSecretKey();
        $paramsToString .= '|' . $transaction->getShopSettings()->getSecretKey();

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
     *      'DirectLinkIs'             => '<full-uri-redirect>',
     *  ]
     *  [
     *      'ErrorCode'        => '<error-code>',
     *      'ErrorDescription' => '<error-description>',
     *  ]
     * ```
     * @throws Exception
     * @throws JsonException
     */
    private function sendRequest(string $link, array $body): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link . '/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
        curl_setopt($ch, CURLOPT_HTTPHEADER, self::HEADERS);
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
        if (!isset($response['Code'])) {
            throw new Exception('ips request error: ' . $response['ErrorDescription']);
        }
    }
}
