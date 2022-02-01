<?php

echo "Enter a number to find out whether it is odd or even." . PHP_EOL;

$number = (int)readline("Please enter the number: ");

function CheckOddEven($number)
{
    if ($number % 2 != 0) {
        echo "Odd Number" . PHP_EOL;;
    } else {
        echo "Even Number" . PHP_EOL;;
    };
    exit("bye!" . PHP_EOL);
}

CheckOddEven($number);

//Exercise #2
//Write a program called CheckOddEven which prints "Odd Number" if the int variable “number” is odd,
// or “Even Number” otherwise. The program shall always print “bye!” before exiting.
