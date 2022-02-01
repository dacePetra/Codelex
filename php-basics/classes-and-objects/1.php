<?php

class Product
{   public string $name;
    public float $price;
    public int $amount;

    public function __construct(string $name, float $price, int $amount)
        {
            $this->name = $name;
            $this->price = $price;
            $this->amount = $amount;
        }
    public function printProduct():string
    {
        return "{$this->name}, price " . number_format($this->price,2) . " EUR, amount {$this->amount}" . PHP_EOL;
    }
    public function setQuantity($newAmount): string
    {
        $this->amount = $newAmount;
        return "Amount has been changed: " . $this->printProduct();
    }
    public function setPrice($newPrice): string
    {
        $this->price= $newPrice;
        return "Price has been changed: " . $this->printProduct();
    }
}

$item1 = new Product("Banana", 1.1, 13);
$item2 = new Product("Logitech mouse", 70.00, 14);
$item3 = new Product("iPhone 5s", 999.99, 3);
$item4 = new Product("Epson EB-U05", 440.46, 1);
echo $item1->printProduct();
echo $item2->printProduct();
echo $item3->printProduct();
echo $item4->printProduct();
echo PHP_EOL;
echo $item2->setPrice(80.88);
echo $item4->setQuantity(44);


//Exercise #1
//Create a class Product that represents a product sold in a shop. A product has a price, amount and name.
//
//The class should have:
//
//A constructor Product(string name, float startPrice, int amount)
//A function printProduct() that prints a product in the following form:
//Banana, price 1.1, amount 13
//Test your code by creating a class with main method and add three products there:
//
//"Logitech mouse", 70.00 EUR, 14 units
//"iPhone 5s", 999.99 EUR, 3 units
//"Epson EB-U05", 440.46 EUR, 1 units
//Print out information about them.
//
//Add new behaviour to the Product class:
//
//possibility to change quantity
//possibility to change price
//Reflect your changes in a working application.