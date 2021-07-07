<?php

namespace SchGroup\IpsPayment;

class Customer
{
    private string  $firstName;
    private string  $name;
    private ?string $email;
    private ?string $phone;

    /**
     * Customer constructor.
     * @param string      $firstName
     * @param string      $name
     * @param string|null $email
     * @param string|null $phone
     */
    public function __construct(string $name, string $firstName, ?string $email = null, ?string $phone = null)
    {
        $this->firstName = $firstName;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
