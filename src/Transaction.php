<?php

namespace SchGroup\IpsPayment;

class Transaction
{
    private const LEASE = 1;

    private Customer $customer;
    private Order $order;
    private ShopSettings $shopSettings;
    private Callback $callback;

    /**
     * Transaction constructor.
     * @param Order $order
     * @param Customer $customer
     * @param ShopSettings $shopSettings
     * @param Callback $callback
     */
    public function __construct(
        Order $order,
        Customer $customer,
        ShopSettings $shopSettings,
        Callback $callback
    ) {
        $this->customer = $customer;
        $this->order = $order;
        $this->shopSettings = $shopSettings;
        $this->callback = $callback;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $params = [
            'MerchantKey'        => $this->shopSettings->getMerchantKey(),
            'RefOrder'           => $this->order->getRefOrder(),
            'amount'             => $this->order->getAmount(),
            'Customer_Name'      => $this->customer->getCustomerName(),
            'Customer_Email'     => $this->customer->getCustomerEmail(),
            'Customer_Phone'     => $this->customer->getCustomerPhone(),
            'Customer_FirstName' => null,
            'Lease'              => self::LEASE,
        ];

        if (!empty($this->shopSettings->getLang())) {
            $params['lang'] = $this->shopSettings->getLang();
        }

        $this->callback->getSuccess()  && $params['urlOK']  = $this->callback->getSuccess();
        $this->callback->getFailed()   && $params['urlKO']  = $this->callback->getFailed();
        $this->callback->getCallback() && $params['urlIPN'] = $this->callback->getCallback();

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
