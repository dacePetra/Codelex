<?php
class Account
{
    private string $name;
    private float $balance;

    public function __construct(string $name, float $balance)
    {
        $this->name = $name;
        $this->balance = $balance;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function deposit(float $amount): void
    {
        $this->balance += $amount;
    }

    public function withdrawal(float $amount): void
    {
        $this->balance -= $amount;
    }

}