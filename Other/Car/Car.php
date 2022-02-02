<?php

class Car
{
    private string $name;
    private FuelGauge $fuelGauge;
    private Odometer $odometer;
    private const CONSUMPTION_PER_KM = 0.07; //7L per 100km
    private const TIRE_QUALITY_LOSS_PER_KM = [1, 2];

    private array $tires;
    private $pinCode;
    private bool $started = false;

    public function __construct(string $name, int $pinCode, int $fuelGaugeAmount)
    {
        $this->name = $name;
        $this->pinCode = $pinCode;
        $this->fuelGauge = new FuelGauge($fuelGaugeAmount);
        $this->odometer = new Odometer();
        $this->tires = [
            new Tire("Front right"),
            new Tire("Front left"),
            new Tire("Back right"),
            new Tire("Back left")
        ];
    }

    public function hasStarted(): bool
    {
        return $this->started;
    }

    public function start(int $pinCode): void
    {
        if ($this->pinCode === $pinCode) {
            $this->started = true;
        }
    }

    public function drive(int $distance = 10): void
    {

        if ($this->fuelGauge->getFuel() <= 0) return;

        $this->fuelGauge->change($distance * -self::CONSUMPTION_PER_KM);
        $this->odometer->addMileage($distance);
        [$minQualityLoss, $maxQualityLoss] = self::TIRE_QUALITY_LOSS_PER_KM;

        foreach ($this->tires as $tire) {
            $tire->changeCondition(rand($minQualityLoss * $distance, $maxQualityLoss * $distance));
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFuel(): float
    {
        return $this->fuelGauge->getFuel();
    }

    public function getMileage(): int
    {
        return $this->odometer->getMileage();
    }

    public function hasValidTires(): bool
    {
        $brokenTires = [];

        foreach ($this->tires as $tire) {
            if ($tire->getCondition() <= 0) {
                $brokenTires[] = $tire;
            }
        }
        return count($brokenTires) < 2;
    }

    public function getTires(): array
    {
        return $this->tires;
    }
}
