<?php

$person = new stdClass();
$person->name = 'Daniel';
$person->cash = 2050;
$person->licenses = ['A', 'C'];

function createWeapon(string $name, int $price, string $license = null): stdClass
{
    $weapon = new stdClass();
    $weapon->name = $name;
    $weapon->price = $price;
    $weapon->license = $license;
    return $weapon;
}

$weapons = [
    createWeapon('AK47', 1000, 'C'),
    createWeapon('Deagle', 500, 'A'),
    createWeapon('Knife', 100),
    createWeapon('Glock', 250, 'A'),
];

echo "{$person->name} has {$person->cash}$" . PHP_EOL . PHP_EOL;

$basket = [];

while (true) {
    echo '[1] Purchase' . PHP_EOL;
    echo '[2] Checkout' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');

    switch ($option) {
        case 1:
            foreach ($weapons as $index => $weapon) {
                echo "[{$index}] {$weapon->name} ({$weapon->license}) {$weapon->price}" . PHP_EOL;
            };

            $selectWeaponIndex = (int)readline('Select weapon: ');

            $weapon = $weapons[$selectWeaponIndex] ?? null;

            if ($weapon === null) {
                echo "Weapon not found." . PHP_EOL;
                exit;
            }

            if ($weapon->license !== null && !in_array($weapon->license, $person->licenses)) {
                echo "Invalid license." . PHP_EOL;
                exit;
            }

            $basket[] = $weapon;

            echo "Added {$weapon->name} to the basket." . PHP_EOL;
            break;

        case 2: // checkout
            $totalSum = 0;
            foreach ($basket as $weapon)
                {
                    $totalSum += $weapon->price;
                    echo "{$weapon->name} $ {$weapon->price}" . PHP_EOL;
                }
            echo "-----------------------" . PHP_EOL;
            echo "Total: {$totalSum} $";
            echo PHP_EOL;

            if ($person->cash >= $totalSum) {
                echo "Successful payment.";
            } else {
                echo "Payment failed. Not enough cash.";
            }

            echo PHP_EOL;

            exit;
            break;

        default: //exit
            exit;
            break;
    }
}

//Exercise 7**
//Imagine you own a gun store. Only certain guns can be purchased with license types.
// Create an object (person) that will be the requester to purchase a gun
// (object) Person object has a name, valid licenses (multiple) & cash.
// Guns are objects stored within an array. Each gun has license letter,
// price & name. Using PHP in-built
// functions determine if the requester (person) can buy a gun from the store.