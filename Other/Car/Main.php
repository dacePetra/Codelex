<?php
require_once 'Car/Tires.php';
require_once 'Car/FuelGauge.php';
require_once 'Car/Odometer.php';
require_once 'Car.php';

$name = readline('Car name: ');
$fuelGaugeAmount = (int)readline('Fuel Gauge amount: ');
$driveDistance = (int)readline('Drive distance: ');

$car = new Car($name, 1234, $fuelGaugeAmount);

echo "------ " . $car->getName() . " ------";
echo PHP_EOL;

$pinCode = (int) readline("Enter car PIN code: ");
$car->start($pinCode);
if (!$car->hasStarted()){
    echo "{$car->getName()} has not started." . PHP_EOL;
}

while ($car->getFuel() > 0 && $car->hasValidTires() && $car->hasStarted()) {
    echo "Fuel: " . $car->getFuel() . "l" . PHP_EOL;
    echo "Mileage: " . $car->getMileage() . "km" . PHP_EOL;

    foreach ($car->getTires() as $tire) {
        echo "Tire ({$tire->getName()}): " . $tire->getCondition() . "%" . PHP_EOL;
    }

    $car->drive($driveDistance);


    sleep(1);
}