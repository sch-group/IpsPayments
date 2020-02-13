<?php

declare(strict_types=1);

namespace SchGroup\IpsPayment;

use GuzzleHttp\ClientInterface;

class IpsPayment
{
    const API_URL = "https://wws.ips-payment.com";

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * IpsPayment constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * @param Transaction $transaction
     * @return string
     */
    public function buildLink(Transaction $transaction): string
    {
        return self::API_URL .'?'. http_build_query($transaction->toArray());
    }
    
}