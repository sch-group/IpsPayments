<?php

namespace SchGroup\IpsPayment;

class Customer
{
    private string $customerName;
    private ?string $customerEmail;
    private ?string $customerPhone;

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
