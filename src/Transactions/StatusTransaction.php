<?php

namespace SchGroup\IpsPayment\Transactions;

use SchGroup\IpsPayment\Order;
use SchGroup\IpsPayment\ShopSettings;

class StatusTransaction implements QueryTransactionInterface
{
    private Order        $order;
    private ShopSettings $shopSettings;

    /**
     * Transaction constructor.
     * @param Order $order
     * @param ShopSettings $shopSettings
     */
    public function __construct(Order $order, ShopSettings $shopSettings)
    {
        $this->order        = $order;
        $this->shopSettings = $shopSettings;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'ApiKey'  => $this->shopSettings->getMerchantKey(),
            'TransID' => $this->order->getPaymentId(),
        ];
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
