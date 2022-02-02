<?php

class Product
{
    public string $name;
    public float $price;
    public int $amount;

    public function __construct(string $name, float $price, int $amount)
    {
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }
}

$item1 = new Product("Bread", 3.33, 2);
$item2 = new Product("Butter", 10.00, 3);
$item3 = new Product("Milk", 1000.01, 1);
//var_dump($item1, $item2, $item3);die;

class Store
{
    public array $stock = [];
    public function __construct(array $stock){
        foreach ($stock as $product){
            $this->addStock($product);
        }
    }
    public function addStock(Product $product):void
    {
        $this->stock[] = $product;
    }
    public function totalSum():int
    {
        $sum = 0;
        foreach ($this->stock as $product){
            $sum += $product->price * $product->amount;
        }
        return $sum;
    }

}
$shelf = new Store([$item1, $item2, $item3]);

//$shelf->addStock($item1);
//$shelf->addStock($item2);
//$shelf->addStock($item3);
//var_dump($shelf);

foreach ($shelf as $value) {
    foreach ($value as $item) {
        echo "{$item->name}, power: {$item->price}$, amount in stock: {$item->amount}" . PHP_EOL;
    }
}
echo "___________________________________" . PHP_EOL;
echo "Total: " . $shelf->totalSum() . "$" . PHP_EOL;
