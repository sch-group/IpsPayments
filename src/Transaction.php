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
            "MerchantKey"=> '8545e3aa27ba62e0API5e3aa27ba62e1',
            "RefOrder" => $this->order->RefOrder,
            "amount" => $this->order->amount,
            "Customer_Name" => $this->customer->customerName,
            "Customer_Email" => $this->customer->customerEmail,
            "Customer_Phone" => $this->customer->customerPhone,
            "Integrated" => $this->shopSettings->Integrated,
            "lang" => $this->shopSettings->lang
        ];
    }
}