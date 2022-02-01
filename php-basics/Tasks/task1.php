<?php

class Weapon
{
    public string $name;
    public int $power;

    public function __construct(string $name, float $power)
    {
        $this->name = $name;
        $this->power = $power;
    }
}

$item1 = new Weapon('Colt', 55);
$item2 = new Weapon('Rifle', 40);
$item3 = new Weapon('Glock', 15);
//var_dump($item1, $item2, $item3);

class Inventory
{
    public array $inventory = [];

    public function addInventory(Weapon $weapon): void
    {
        $this->inventory[] = $weapon;
    }
}

$stock = new Inventory();
$stock->addInventory($item1);
$stock->addInventory($item2);
$stock->addInventory($item3);
//var_dump($stock);

foreach ($stock as $value) {
    foreach ($value as $item) {
        echo $item->name . ", power: " . $item->power . PHP_EOL;
    }
}
