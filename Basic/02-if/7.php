<?php

$number = 77;

switch ($number) {
    case $number<50:
        echo "low";
        break;
    case ($number>=50 && $number<100):
        echo "medium";
        break;
    case $number>=100:
        echo "high";
        break;
}
//I have included number 50 in "medium" and 100 in "high".

//Exercise 7
//Create a variable $number with integer by your choice.
// Create a switch statement that prints out text "low" if the value is under 50,
// "medium" if the case is higher than 50 but lower than 100, "high" if the value is >100.

