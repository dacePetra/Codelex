<?php

class FuelGauge
{
    private float $fuel = 0;
    private const FUEL_CAPACITY = 70;

    public function __construct(float $amount)
    {
        $this->change($amount);
    }

    public function change(float $amount): void
    {
        $this->fuel += $amount;

        if ($this->fuel > self::FUEL_CAPACITY) {
            $this->fuel = self::FUEL_CAPACITY;
        }

        if ($this->fuel < 0) {
            $this->fuel = 0;
        }
    }

    public function getFuel(): float
    {
        return $this->fuel;
    }
}

