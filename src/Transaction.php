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
        $params = [
            "MerchantKey"=> $this->shopSettings->getMerchantKey(),
            "RefOrder" => $this->order->getRefOrder(),
            "amount" => $this->order->getAmount(),
            "Customer_Name" => $this->customer->getCustomerName(),
            "Customer_Email" => $this->customer->getCustomerEmail(),
            "Customer_Phone" => $this->customer->getCustomerPhone(),
            "Integrated" => $this->shopSettings->getIntegrated(),
        ];
        if(!empty($this->shopSettings->getLang())) {
            $params["lang"] = $this->shopSettings->getLang();
        }

        return $params;
    }

    /**
     * @return Customer
     */
    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @return ShopSettings
     */
    public function getShopSettings(): ShopSettings
    {
        return $this->shopSettings;
    }
}