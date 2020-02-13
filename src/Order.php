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
    public $subscribePeriod;
    /**
     * @var string
     */
    public $refOrder;
    /**
     * @var string
     */
    public $subscribe;

    /**
     * Order constructor.
     * @param string $refOrder
     * @param float $amount
     * @param string|null $subscribe
     * @param string|null $subscribePeriod
     */
    public function __construct(
        string $refOrder,
        float $amount,
        ?string $subscribe = null,
        ?string $subscribePeriod = null
    ) {
        $this->refOrder = $refOrder;
        $this->subscribe = $subscribe;
        $this->subscribePeriod = $subscribePeriod;
        $this->amount = $amount;
    }
}