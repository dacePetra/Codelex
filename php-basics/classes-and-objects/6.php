<?php

$surveyed = 12467;
$purchased_energy_drinks = 0.14;
$prefer_citrus_drinks = 0.64;

function calculate_energy_drinkers(int $numberSurveyed, $purchased_energy_drinks = 0.14)
{
    return $numberSurveyed * $purchased_energy_drinks;
    //throw new LogicException(";(");
}

function calculate_prefer_citrus(int $numberSurveyed, $prefer_citrus_drinks = 0.64)
{
    return $numberSurveyed *$prefer_citrus_drinks;
    //throw new LogicException(";(");
}


echo "Total number of people surveyed " . $surveyed . PHP_EOL;
echo "Approximately " . calculate_energy_drinkers($surveyed) . " bought at least one energy drink," . PHP_EOL;
echo calculate_prefer_citrus($surveyed) . " of those " . "prefer citrus flavored energy drinks." . PHP_EOL;


//Exercise #6
//See energy-drinks.php
//A soft drink company recently surveyed 12,467 of its customers and found that
// approximately 14 percent of those surveyed purchase one or more energy drinks per week.
// Of those customers who purchase energy drinks, approximately 64 percent of them prefer citrus flavored energy drinks.
//
//Write a program that displays the following:
//
//The approximate number of customers in the survey who purchased one or more energy drinks per week
//The approximate number of customers in the survey who prefer citrus flavored energy drinks
