<?php

echo "Let's play a game with 2 integers! The game will tell 'true' if the either one is 15 or if their sum or difference is 15." . PHP_EOL;

$firstInt = (int)readline("Please enter the first integer: ");

$secondInt = (int)readline("Please enter the second integer: ");


if ($firstInt === 15 || $secondInt === 15 || $firstInt + $secondInt = 15 || $firstInt - $secondInt = 15 || $secondInt - $firstInt = 15) {
    echo "True" . PHP_EOL;
} else {
    echo "False" . PHP_EOL;
}

//Exercise #1
//Write a program to accept two integers and return true if the either one is 15 or if their sum or difference is 15.
