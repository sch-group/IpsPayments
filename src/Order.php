<?php

namespace SchGroup\IpsPayment;

class Order
{
    private float $amount;
    private ?string $subscribePeriod;
    private string $refOrder;
    private ?string $subscribe;
    private ?string $paymentId;

    /**
     * Order constructor.
     * @param string $refOrder
     * @param float $amount
     * @param string|null $subscribe
     * @param string|null $subscribePeriod
     * @param string|null $paymentId
     */
    public function __construct(
        string $refOrder,
        float $amount,
        ?string $subscribe = null,
        ?string $subscribePeriod = null,
        ?string $paymentId = null
    ) {
        $this->refOrder = $refOrder;
        $this->subscribe = $subscribe;
        $this->subscribePeriod = $subscribePeriod;
        $this->amount = $amount;
        $this->paymentId = $paymentId;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string|null
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
     * @return string|null
     */
    public function getSubscribe(): ?string
    {
        return $this->subscribe;
    }

    /**
     * @return string|null
     */
    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }
}
