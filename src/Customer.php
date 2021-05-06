<?php

namespace SchGroup\IpsPayment;

class Customer
{
    /**
     * @var string
     */
    private $customerName;
    /**
     * @var string
     */
    private $customerEmail;
    /**
     * @var string
     */
    private $customerPhone;

    /**
     * Customer constructor.
     * @param string $customerName
     * @param string|null $customerEmail
     * @param string|null $customerPhone
     */
    public function __construct(
        string $customerName,
        ?string $customerEmail = null,
        ?string $customerPhone = null
    ) {
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->customerPhone = $customerPhone;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @return string
     */
    public function getCustomerEmail(): ?string
    {
        return $this->customerEmail;
    }

    /**
     * @return string
     */
    public function getCustomerPhone(): ?string
    {
        return $this->customerPhone;
    }
}