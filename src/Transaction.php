<?php

namespace SchGroup\IpsPayment;

class Transaction
{
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
            'MerchantKey' => $this->shopSettings->getMerchantKey(),
            'amount'      => (string)$this->order->getAmount(),
            'RefOrder'    => $this->order->getRefOrder(),
        ];

        $this->customer->getName()      && $params['Customer_Name']      = $this->customer->getName();
        $this->customer->getFirstName() && $params['Customer_FirstName'] = $this->customer->getFirstName();
        $this->customer->getEmail()     && $params['Customer_Email']     = (string)$this->customer->getEmail();
        $this->customer->getPhone()     && $params['Customer_Phone']     = (string)$this->customer->getPhone();
        $this->shopSettings->getLang()  && $params['lang']               = (string)$this->shopSettings->getLang();
        $this->callback->getCallback()  && $params['urlIPN']             = (string)$this->callback->getCallback();
        $this->callback->getSuccess()   && $params['urlOK']              = (string)$this->callback->getSuccess();
        $this->callback->getFailed()    && $params['urlKO']              = (string)$this->callback->getFailed();

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
