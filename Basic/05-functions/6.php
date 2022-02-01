<?php

$arr = [2, "7", 1.1, 3, 9];

//echo count($arr)
//echo sizeof($arr);

for ($i = 0; $i <= count($arr) - 1; $i++) {
    echo $i;
}

echo "\n";

function doubleInt($input)
{
    if (is_int($input) == 1) {
        return ($input * 2) . ", ";
    };
};

foreach ($arr as $item) {
    echo doubleInt($item);
}

//Exercise 6
//Create a non-associative array with 5 elements where 3 are integers, 1 float and 1 string.
// Create a for loop that iterates non-associative array
// using php in-built function that determines count of elements in the array.
// Create a function that doubles the integer number. Within the loop using php in-built function print out
// the double of the number value (using your custom function).

