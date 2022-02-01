<?php

echo "This program will calculate the sum and average of all numbers in the interval (from lower bound to upper bound)." . PHP_EOL;

$start = (int) readline("Enter lower bound: ");
$end = (int) readline("Enter upper bound: ");

$numbers = range($start,$end); //ieliks masivaa 1,2,3,...100
$sum = array_sum($numbers);
$average = ($sum) / count($numbers);

echo "The sum of " . $start . " to " . $end . " is " . $sum . PHP_EOL;
echo "The average is " . $average . PHP_EOL;

//Exercise #3
//Write a program to produce the sum of 1, 2, 3, ..., to 100.
// Store 1 and 100 in variables lower bound and upper bound,
// so that we can change their values easily.
// Also compute and display the average. The output shall look like:

//The sum of 1 to 100 is 5050
//The average is 50.5
