<?php

function factorial($number){
    $factorial = 1;
    for ($i = 1; $i <= $number; $i++){
        $factorial = $factorial * $i;
    }
    return $factorial;
}
$number = 10;
$fact = factorial($number);
echo $fact;
echo gettype($fact);

//Exercise #4
//Write a program to compute the product of integers from 1 to 10 (i.e., 1×2×3×...×10), as an int.
// Take note that it is the same as factorial of N.

