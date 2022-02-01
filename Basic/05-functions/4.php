<?php

function createPerson(string $name, string $surname, int $age): stdClass
{
    $person = new stdClass();
    $person->name = $name;
    $person->surname = $surname;
    $person->age = $age;
    return $person;
}

$persons = [
    createPerson('Kate', 'Cole', 24),
    createPerson('Tom', 'Smith', 16),
    createPerson('Rob', 'Pearson', 22)
];

$ageLimit = (int)readline("Enter age limit: ");

function ageCheck($actualAge, $ageLimit): string
{
    if ($actualAge < $ageLimit) {
        return "a minor";
    } else {
        return "an adult";
    }
}

foreach ($persons as $person) {
    echo $person->name . " is " . ageCheck($person->age, $ageLimit) . PHP_EOL;
}

//Exercise 4
//Create a array of objects that uses the function of exercise 3 but
// in loop printing out if the person has reached age of 18.
