<?php

$person = new stdClass();
$person->name = "John";
$person->surname = "Johnson";
$person->age = 18;

$ageLimit = readline("Enter age limit: ");

function ageCheck($actualAge, $ageLimit): string
{
    if ($actualAge < $ageLimit) {
        return "a minor";
    } else {
        return "an adult";
    }
}

echo $person->name . " is " . ageCheck($person->age, $ageLimit) . PHP_EOL;

//Exercise 3
//Create a person object with name, surname and age. Create a function that
// will determine if the person has reached 18 years of age. Print out if
// the person has reached age of 18 or not.

