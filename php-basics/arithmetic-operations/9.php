<?php

echo "Let's calculate your BMI!" . PHP_EOL;

$weight = (int) readline("Please enter your weight in kilograms >> ");

$height = (int) readline("Please enter your height in centimeters >> ");

function bmi($kg, $cm)
{
    return round(($kg / 0.45359237 * 703 / pow(($cm / 2.54), 2)), 2);
}

if (bmi($weight, $height) < 18.5 && bmi($weight, $height) > 0)
{
    echo "Your BMI is: " . bmi($weight, $height) . " You are considered underweight." . PHP_EOL;
} elseif (bmi($weight, $height) > 18.5 && bmi($weight, $height) < 25)
{
    echo "Your BMI is: " . bmi($weight, $height) . " Your weight is considered optimal." . PHP_EOL;
} elseif (bmi($weight, $height) > 25)
{
    echo "Your BMI is: " . bmi($weight, $height) . " You are considered overweight." . PHP_EOL;
} else {
    echo "Please check the entered values!" . PHP_EOL;
}

//Exercise #9
//Write a program that calculates and displays a person's body mass index (BMI).
// A person's BMI is calculated with the following formula: BMI = weight x 703 / height ^ 2.
// Where weight is measured in pounds and height is measured in inches. Display a message
// indicating whether the person has optimal weight, is underweight, or is overweight.
// A sedentary person's weight is considered optimal if his or her BMI is between 18.5 and 25.
// If the BMI is less than 18.5, the person is considered underweight.
// If the BMI value is greater than 25, the person is considered overweight.
//
//Your program must accept metric units.
//
