<?php

namespace SchGroup\IpsPayment;

class Callback
{
    private ?string $success;
    private ?string $failed;
    private ?string $callback;

    /**
     * ShopSettings constructor.
     * @param string|null $success
     * @param string|null $failed
     * @param string|null $callback
     */
    public function __construct(string $success = null, string $failed = null, string $callback = null)
    {
        $this->success  = $success;
        $this->failed   = $failed;
        $this->callback = $callback;
    }

    /**
     * @return string|null
     */
    public function getSuccess(): ?string
    {
        return $this->success;
    }

    /**
     * @return string|null
     */
    public function getFailed(): ?string
    {
        return $this->failed;
    }

    /**
     * @return string|null
     */
    public function getCallback(): ?string
    {
        return $this->callback;
    }
}
