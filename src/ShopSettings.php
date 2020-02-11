<?php

namespace SchGroup\IpsPayment;

class ShopSettings
{
    /**
     * @var string
     */
    public $urlIPN;
    /**
     * @var string
     */
    public $Integrated;
    /**
     * @var string
     */
    public $urlOK;
    /**
     * @var string
     */
    public $lang;

    /**
     * ShopSettings constructor.
     * @param string $urlIPN
     * @param string $urlOK
     * @param string|null $Integrated
     * @param string $lang
     */
    public function __construct(
        string $urlIPN,
        string $urlOK,
        ?string $Integrated = null,
        string $lang = 'en'
    ) {
        $this->urlIPN = $urlIPN;
        $this->urlOK = $urlOK;
        $this->Integrated = $Integrated;

        $this->lang = $lang;
    }
}