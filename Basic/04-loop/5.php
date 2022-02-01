<?php

$persons = [
        [
            "name" => "Daniel",
            "surname" => "Johnson",
            "age" => 25,
            "birthday" => "28.11."
        ],
        [
            "name" => "Kate",
            "surname" => "Jasmine",
            "age" => 24,
            "birthday" => "26.09."
        ],
        [
            "name" => "Tom",
            "surname" => "Smith",
            "age" => 29,
            "birthday" => "25.01."
        ]
];

for ($i=0; $i<=2; $i++){
    echo $persons[$i]["name"] . " " . $persons[$i]["surname"] . ", age:" . $persons[$i]["age"] . ", birthday:" . $persons[$i]["birthday"];
    echo "\n";
}

//Exercise 5
//Create an associative array with objects of multiple persons.
//Each person should have a name, surname, age and birthday.
// Using loop (by your choice) print out every persons personal data.