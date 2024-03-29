<?php

namespace SchGroup\IpsPayment;

class ShopSettings
{
    private const TRANSACTION_CREATE_PATH = 'init_transactions';
    private const TRANSACTION_GET_PATH    = 'transactions';

    private ?string $lang;
    private string $merchantKey;
    private string $apiHost;
    private string $secretKey;

    /**
     * ShopSettings constructor.
     * @param string      $merchantKey
     * @param string      $apiHost
     * @param string      $secretKey
     * @param string|null $lang
     */
    public function __construct(string $merchantKey, string $apiHost, string $secretKey, string $lang = null)
    {
        $this->merchantKey = $merchantKey;
        $this->lang = $lang;
        $this->apiHost = $apiHost;
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getLang(): ?string
    {
        return $this->lang;
    }

    /**
     * @return string
     */
    public function getMerchantKey(): string
    {
        return $this->merchantKey;
    }

    /**
     * @return string
     */
    public function getApiHost(): string
    {
        return $this->apiHost;
    }

    /**
     * @return string
     */
    public function getTransitionCreatePath(): string
    {
        return $this->apiHost . '/' . self::TRANSACTION_CREATE_PATH;
    }

    /**
     * @return string
     */
    public function getTransitionGetPath(): string
    {
        return $this->apiHost . '/' . self::TRANSACTION_GET_PATH;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}
