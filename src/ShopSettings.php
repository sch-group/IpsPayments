<?php

namespace SchGroup\IpsPayment;

class ShopSettings
{

    /**
     * @var string
     */
    private $Integrated;

    /**
     * @var string
     */
    private $lang;
    /**
     * @var string
     */
    private $merchantKey;
    /**
     * @var string
     */
    private $apiHost;

    /**
     * ShopSettings constructor.
     * @param string $merchantKey
     * @param string $apiHost
     * @param string|null $Integrated
     * @param string|null $lang
     */
    public function __construct(string $merchantKey, string $apiHost, string $Integrated = "NO", string $lang = null)
    {
        $this->merchantKey = $merchantKey;
        $this->Integrated = $Integrated;
        $this->lang = $lang;
        $this->apiHost = $apiHost;
    }

    /**
     * @return string
     */
    public function getIntegrated(): string
    {
        return $this->Integrated;
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
}