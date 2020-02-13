<?php

namespace SchGroup\IpsPayment;

class Transaction
{
    /**
     * @var Customer
     */
    private $customer;
    /**
     * @var Order
     */
    private $order;
    /**
     * @var ShopSettings
     */
    private $shopSettings;

    /**
     * Transaction constructor.
     * @param Order $order
     * @param Customer $customer
     * @param ShopSettings $shopSettings
     */
    public function __construct(
        Order $order,
        Customer $customer,
        ShopSettings $shopSettings
    ) {
        $this->customer = $customer;
        $this->order = $order;
        $this->shopSettings = $shopSettings;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "MerchantKey"=> $this->shopSettings->merchantKey,
            "RefOrder" => $this->order->refOrder,
            "amount" => $this->order->amount,
            "Customer_Name" => $this->customer->customerName,
            "Customer_Email" => $this->customer->customerEmail,
            "Customer_Phone" => $this->customer->customerPhone,
            "Integrated" => $this->shopSettings->Integrated,
            "lang" => $this->shopSettings->lang
        ];
    }
}