<?php
$fruits = [
    "Oranges" => 12,
    "Apples" => 8,
    "Bananas" => 15,
    "Kiwi" => 9
];

$shippingCost = [
    "underTenKg" => 1,
    "overTenKg" => 2
];

function checkWeight($x): bool
{
    return $x > 10;
}

foreach ($fruits as $key => $fruit) {
    if (checkWeight($fruit) == 1) {
        echo $key . ", weight:" . $fruit . ", shipping cost:" . $shippingCost["overTenKg"] . PHP_EOL;
    } else {
        echo $key . ", weight:" . $fruit . ", shipping cost:" . $shippingCost["underTenKg"] . PHP_EOL;
    }
}

//Exercise 5
//Create a 2D associative array in 2nd dimension with fruits and their weight.
//Create a function that determines if fruit has weight over 10kg.
// Create a secondary array with shipping costs per weight.
// Meaning that you can say that over 10 kg shipping costs are 2 euros, otherwise its 1 euro.
// Using foreach loop print out the values of the fruits and how much it would cost to ship this product.