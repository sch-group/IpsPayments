<?php

namespace SchGroup\IpsPayment;

class Order
{
    private float $amount;
    private ?string $subscribePeriod;
    private string $refOrder;
    private ?string $subscribe;

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

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getSubscribePeriod(): ?string
    {
        return $this->subscribePeriod;
    }

    /**
     * @return string
     */
    public function getRefOrder(): string
    {
        return $this->refOrder;
    }

    /**
     * @return string
     */
    public function getSubscribe(): ?string
    {
        return $this->subscribe;
    }
}
