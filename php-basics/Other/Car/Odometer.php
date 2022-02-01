<?php
class Odometer
{
    private int $mileage = 0;

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function addMileage(int $amount)
    {
        $this->mileage += $amount;
    }
}