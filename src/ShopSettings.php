<?php

namespace SchGroup\IpsPayment;

class ShopSettings
{

    /**
     * @var string
     */
    public $Integrated;

    /**
     * @var string
     */
    public $lang;
    /**
     * @var string
     */
    public $merchantKey;

    /**
     * ShopSettings constructor.
     * @param string $merchantKey
     * @param string|null $Integrated
     * @param string $lang
     */
    public function __construct(string $merchantKey, string $Integrated = "NO", string $lang = 'en')
    {
        $this->merchantKey = $merchantKey;
        $this->Integrated = $Integrated;
        $this->lang = $lang;
    }
}