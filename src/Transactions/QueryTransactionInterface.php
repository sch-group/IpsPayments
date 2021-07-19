<?php

namespace SchGroup\IpsPayment\Transactions;

use SchGroup\IpsPayment\ShopSettings;

interface QueryTransactionInterface
{
    public function getShopSettings(): ShopSettings;

    public function toArray(): array;
}
