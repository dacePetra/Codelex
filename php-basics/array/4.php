<?php

$randomTen = [];

for ($i = 0; $i <= 9; $i++) {
    $randomTen[$i] = rand(1, 100);
};

$copy = [];

for ($i = 0; $i < count($randomTen); $i++) {
    $copy[$i] = $randomTen[$i];
};


array_pop($randomTen);
$randomTen[] = -7; //array_push($randomTen,-7);

print("Array 1: ");
for ($i = 0; $i < count($randomTen); $i++) {
    print($randomTen[$i] . " ");
}
echo PHP_EOL;

print("Array 2: ");
for ($i = 0; $i < count($copy); $i++) {
    print($copy[$i] . " ");
}
echo PHP_EOL;

//Exercise #4
//Write a program that creates an array of ten integers.
// It should put ten random numbers from 1 to 100 in the array.
// It should copy all the elements of that array into another array of the same size.
//
//Then display the contents of both arrays.
// To get the output to look like this, you'll need a several for loops.
//
//Create an array of ten integers
//Fill the array with ten random numbers (1-100)
//Copy the array into another array of the same capacity
//Change the last value in the first array to a -7
//Display the contents of both arrays
//Array 1: 45 87 39 32 93 86 12 44 75 -7
//Array 2: 45 87 39 32 93 86 12 44 75 50