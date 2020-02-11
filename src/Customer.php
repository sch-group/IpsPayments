<?php

namespace SchGroup\IpsPayment;

class Customer
{
    /**
     * @var string
     */
    public $customerName;
    /**
     * @var string
     */
    public $customerEmail;
    /**
     * @var string
     */
    public $customerPhone;

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
}