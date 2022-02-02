<?php

$personData = explode(',', file_get_contents('/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/Daniel.txt'));

$person = new stdClass();
$person->name = $personData[0];
$person->cash = (int) $personData[1];

function createProduct(string $name, int $price, string $category, string $description, string $expiryDate, int $amount): stdClass
{
    $product = new stdClass();
    $product->name = $name;
    $product->price = $price;
    $product->category = $category;
    $product->description = $description;
    $product->expiryDate = $expiryDate;
    $product->amount = $amount;
    return $product;
};


$products = [];

if(($handle = fopen('/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/products.csv', "r")) !== false){
    while (($data = fgetcsv($handle, 1000, ',')) !== false){
        [$name, $price, $category, $description, $expiryDate, $amount] = $data;
        $products[] = createProduct($name, (Int) $price, $category, $description, $expiryDate, $amount);
    }
    fclose($handle);
}

echo "{$person->name} has {$person->cash}$" . PHP_EOL . PHP_EOL;

$basket = [];
if (file_exists("/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/basket.txt")){
    $basket = explode(',', file_get_contents("/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/basket.txt"));
};

while (true) {
    echo '[1] Purchase' . PHP_EOL;
    echo '[2] Checkout' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');

    switch ($option) {
        case 1:
            foreach ($products as $index => $product) {
                echo "[{$index}] {$product->name} $ {$product->price}, Category: {$product->category},
                Description: {$product->description},
                Expiry date: {$product->expiryDate}
                Available amount: {$product->amount}" . PHP_EOL;
            };

            $selectProductIndex = (int)readline('Select product: ');

            $product = $products[$selectProductIndex] ?? null;

            if ($product === null) {
                echo "Product not found." . PHP_EOL;
                exit;
            }

            $basket[] = $selectProductIndex;

            echo "Added {$product->name} to the basket." . PHP_EOL;
            break;

        case 2: // checkout
            $totalSum = 0;
            foreach ($basket as $selectProductIndex)
            {
                $product = $products[$selectProductIndex];
                $totalSum += $product->price;
                echo "{$product->name} $ {$product->price}" . PHP_EOL;
            }
            echo "-----------------------" . PHP_EOL;
            echo "Total: {$totalSum} $";
            echo PHP_EOL;

            if ($person->cash >= $totalSum) {
                echo "Successful payment." . PHP_EOL;
                echo "{$person->name} has left $" . ($person->cash - $totalSum) . PHP_EOL;

                //here cash from the customer.txt file has to be subtracted.
            } else {
                echo "Payment failed. Not enough cash.";
            }
            echo PHP_EOL;

            //clear file
            if (file_exists("/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/basket.txt")){
                unlink("/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/basket.txt");
            };


            exit;

        default: //exit
            echo "Basket has been saved." . PHP_EOL;
            $productsIndexes = implode(',', $basket);
            file_put_contents("/mnt/c/Users/jurgi/PhpstormProjects/Codelex/php-basics/Other/Store/basket.txt", $productsIndexes);
            exit;
    }
}

//Story:
//
//A client asks you to build a simple program for his store that would allow couple of his
// clients to get information about the products and purchase them.
//
//Task:
//
//Create a database of products (.csv file)
//Database should hold information about the product
//
//Name
//Price
//Category
//Description
//Expiry date
//Amount
//Requester (buyer) is a .txt file that hold information about the person and how much cash he has.
//Create a store program that you can enter multiple commands.
//When the customer purchases the product, cash from the customer.txt file has to be subtracted.
// Example: "php store.php list" would list all products in the store. Example: "php store.php
// purchase apple-1 10" would make john.php purchase the 10 apples.
//
//Commands:
//
//List all products, prices & info
//List single product info
//Buy product from the store 1 or multiple items at the same time.
//Additional
//
//Create import script that will read information from the warehouse file and update your products in the store.
//Note that warehouse could only export their products in .txt file with | as separator.