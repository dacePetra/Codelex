<?php

class Car
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
$item0 = new Car("Bugatti La Voiture Noire");
$item1 = new Car("McLaren Speedtail");
$item2 = new Car("Aston Martin Vulcan");
$item3 = new Car("Bugatti Divo");
$item4 = new Car("Lamborghini Sian");

class CarSalon
{
    public array $available = [];
    public array $reserved = [];

    public function addStock(Car $car): void
    {
        $this->available[] = $car;
    }

    public function showAvailable()
    {
        foreach ($this->available as $key => $car) {
            echo "[" . ($key+1) . "] {$car->name}" . PHP_EOL;
        }
    }

    public function showReserved()
    {
        foreach ($this->reserved as $car) {
            echo $car->name . PHP_EOL;
        }
    }

    public function makeReservation(int $index)
    {
        foreach ($this->available as $key => $car) {
            if ($key == $index-1) {
                $this->reserved[] = $car;
                unset($this->available[$index-1]);
//                var_dump($this->available, $this->reserved);
            }
        }
    }
}

$lot = new CarSalon();
$lot->addStock($item0);
$lot->addStock($item1);
$lot->addStock($item2);
$lot->addStock($item3);
$lot->addStock($item4);


while (true) {
    echo '[1] Make reservation' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');

    switch ($option) {
        case 1:

            echo PHP_EOL . "Available:" . PHP_EOL;
            $lot->showAvailable() . PHP_EOL;
            if(count($lot->reserved) != 0) {
                echo PHP_EOL . "Reserved:" . PHP_EOL;
                $lot->showReserved() . PHP_EOL;
            }
            echo PHP_EOL;
            $index = (int)readline("Which car would you like to reserve? >>");
            $lot->makeReservation($index);
            echo PHP_EOL;
            break;
        default:
            exit;
    }
}
