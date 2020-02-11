<?php

declare(strict_types=1);

namespace SchGroup\IpsPayment;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Log\{NullLogger, LoggerInterface};
use GuzzleHttp\ClientInterface;

class IpsPayment
{
    /**
     * @var NullLogger
     */
    private $logger;

    const API_URL = "https://wws.ips-payment.com";
    /**
     * @var string
     */
    private $apiKey;
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * IpsPayment constructor.
     * @param string $apiKey
     * @param ClientInterface $client
     */
    public function __construct(string $apiKey, ClientInterface $client, LoggerInterface $logger)
    {
        $this->apiKey = $apiKey;
        $this->client = $client;
        $this->logger = $logger;
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