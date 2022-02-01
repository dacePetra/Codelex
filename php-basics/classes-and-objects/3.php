<?php

class FuelGauge
{
    protected int $fuel;

    public function __construct(int $fuel)
    {
        $this->fuel = $fuel;
    }

    public function getFuel(): int
    {
        return $this->fuel;
    }

    public function addFuel($maxLiters = 70)
    {
        if ($this->fuel >= $maxLiters) {
            return "The car can hold a maximum of 70 liters.";
        } else {
            return $this->fuel += 1;
        }
    }

    public function subtractFuel($minLiters = 0)
    {
        if ($this->fuel == $minLiters) {
            return "No fuel.";
        } else {
            return $this->fuel -= 1;
        }
    }
}

class Odometer extends FuelGauge
{
    public int $mileage;

    public function __construct(int $fuel, int $mileage)
    {
        Parent::__construct($fuel);
        $this->mileage = $mileage;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    private function setMileageToZero()
    {
        $this->mileage = 0;
    }

    public function driveTenKm($maxMileage = 1000000): string
    {

        $this->mileage += 10;
        if ($this->mileage >= $maxMileage) {
            $milesOver = $this->mileage;
            $this->setMileageToZero();
            $this->mileage += ($milesOver - $maxMileage);
            $this->subtractFuel();
            return "Odometer has reached it's maximum and has been reset to 0." . PHP_EOL . "You have driven 10km" . PHP_EOL;
        }
        $this->subtractFuel();
        return "You have driven 10km" . PHP_EOL;
    }
}

//$fuel = new FuelGauge(60);
//echo $fuel->getFuel() . PHP_EOL;
//echo $fuel->addFuel() . PHP_EOL;
//echo $fuel->subtractFuel() . PHP_EOL;
//echo $fuel->subtractFuel() . PHP_EOL;

$car = new Odometer(6, 999987);
echo "You have added 1 liter of fuel. Liters of fuel: " . $car->addFuel() . PHP_EOL;
echo "You have subtracted 1 liter of fuel. Liters of fuel: " . $car->subtractFuel() . PHP_EOL;
echo "Liters of fuel: " . $car->getFuel() . PHP_EOL;
while ($car->getFuel() != 0) {
    echo "Mileage: " . $car->getMileage() . " km.    Fuel: " . $car->getFuel() . " liters." . PHP_EOL;
    echo $car->driveTenKm();
}
echo "Mileage: " . $car->getMileage() . " km.    Fuel: " . $car->getFuel() . " liters." . PHP_EOL;


//Exercise #3
//For this exercise, you will design a set of classes that work together to simulate a car's fuel
// gauge and odometer. The classes you will design are the following:
//
//The FuelGauge Class: This class will simulate a fuel gauge. Its responsibilities are as follows:
//
//To know the car’s current amount of fuel, in liters.
//To report the car’s current amount of fuel, in liters.
//To be able to increment the amount of fuel by 1 liter. This simulates putting fuel in the car.
// ( The car can hold a maximum of 70 liters.)
//To be able to decrement the amount of fuel by 1 liter, if the amount of fuel is greater than 0 liters.
// This simulates burning fuel as the car runs.
//The Odometer Class: This class will simulate the car’s odometer. Its responsibilities are as follows:
//
//To know the car’s current mileage.
//To report the car’s current mileage.
//To be able to increment the current mileage by 1 kilometer. The maximum mileage the odometer can store
// is 999,999 kilometer. When this amount is exceeded, the odometer resets the current mileage to 0.
//To be able to work with a FuelGauge object. It should decrease the FuelGauge object’s current amount of
// fuel by 1 liter for every 10 kilometers traveled. (The car’s fuel economy is 10 kilometers per liter.)
//Demonstrate the classes by creating instances of each. Simulate filling the car up with fuel,
// and then run a loop that increments the odometer until the car runs out of fuel.
// During each loop iteration, print the car’s current mileage and amount of fuel.
