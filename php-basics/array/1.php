<?php

$numbers = [
    1789, 2035, 1899, 1456, 2013,
    1458, 2458, 1254, 1472, 2365,
    1456, 2165, 1457, 2456
];

//todo
echo "Original numeric array: " . PHP_EOL;
echo print_r($numbers) . PHP_EOL;

//todo
echo "Sorted numeric array: ";
sort($numbers);
echo print_r($numbers) . PHP_EOL;

$words = [
    "Java",
    "Python",
    "PHP",
    "C#",
    "C Programming",
    "C++"
];

//todo
echo "Original string array: ";
echo print_r($words) . PHP_EOL;

//todo
echo "Sorted string array: ";
sort($words);
echo print_r($words) . PHP_EOL;
