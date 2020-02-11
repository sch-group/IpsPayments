<?php

namespace SchGroup\IpsPayment;

class Order
{
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $Subscribe_Period;
    /**
     * @var string
     */
    public $RefOrder;
    /**
     * @var string
     */
    public $Subscribe;

    /**
     * Order constructor.
     * @param string $RefOrder
     * @param float $amount
     * @param string|null $Subscribe
     * @param string|null $Subscribe_Period
     */
    public function __construct(
        string $RefOrder,
        float $amount,
        ?string $Subscribe = null,
        ?string $Subscribe_Period = null
    ) {
        $this->RefOrder = $RefOrder;
        $this->Subscribe = $Subscribe;
        $this->Subscribe_Period = $Subscribe_Period;
        $this->amount = $amount;
    }
}