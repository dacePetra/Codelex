<?php
function circleArea($r)
{
    return round((pi() * pow($r, 2)), 2);
}

function rectangleArea($l, $w)
{
    return $l * $w;
}

function triangleArea($b, $h)
{
    return $b * $h * 0.5;
}

while (true) {
    echo "Geometry Calculator" . PHP_EOL;
    echo "[1] Calculate the Area of a Circle" . PHP_EOL;
    echo "[2] Calculate the Area of a Rectangle" . PHP_EOL;
    echo "[3] Calculate the Area of a Triangle" . PHP_EOL;
    echo "[4] Quit" . PHP_EOL;

    $answer = (int)readline("Enter your choice (1-4): ");

    switch ($answer) {
        case 1:
            $radius = (int)readline("Please enter the radius of a circle: ");
            if ($radius <= 0) {
                echo "Please enter a positive number." . PHP_EOL . PHP_EOL;
            } else {
                echo "The Area of a Circle is " . circleArea($radius) . PHP_EOL . PHP_EOL;
            }
            break;
        case 2:
            $length = (int)readline("Please enter the length of a rectangle: ");
            $width = (int)readline("Please enter the width of a rectangle: ");
            if ($length <= 0 || $width <= 0) {
                echo "Please enter positive numbers." . PHP_EOL . PHP_EOL;
            } else {
                echo "The Area of a rectangle is " . rectangleArea($length, $width) . PHP_EOL . PHP_EOL;
            }
            break;

        case 3:
            $base = (int)readline("Please enter length of a triangle’s base: ");
            $height = (int)readline("Please enter the triangle’s height: ");
            if ($base <= 0 || $height <= 0) {
                echo "Please enter positive numbers." . PHP_EOL . PHP_EOL;
            } else {
                echo "The Area of a triangle is " . triangleArea($base, $height) . PHP_EOL . PHP_EOL;
            }
            break;

        case 4:
            echo "Thank you for using this product. Bye!" . PHP_EOL;
            exit;
            break;

        default:
            echo "Error, please enter numbers (1-4)!" . PHP_EOL . PHP_EOL;
            break;
    };
}

//Exercise #10
//See calculate-area.php
//
//Design a Geometry class with the following methods:
//
//A static method that accepts the radius of a circle and returns
// the area of the circle. Use the following formula:
//Area = π * r * 2
//Use Math.PI for π and r for the radius of the circle
//A static method that accepts the length and width of a rectangle
// and returns the area of the rectangle. Use the following formula:
//Area = Length x Width
//A static method that accepts the length of a triangle’s base and the triangle’s height.
// The method should return the area of the triangle. Use the following formula:
//Area = Base x Height x 0.5
//The methods should display an error message if negative values are used for
// the circle’s radius, the rectangle’s length or width, or the triangle’s base or height.
//
//Next write a program to test the class, which displays the following
// menu and responds to the user’s selection:
//
//Geometry calculator:
//
//Calculate the Area of a Circle
//Calculate the Area of a Rectangle
//Calculate the Area of a Triangle
//Quit
//Enter your choice (1-4):
//Display an error message if the user enters a number outside
// the range of 1 through 4 when selecting an item from the menu.