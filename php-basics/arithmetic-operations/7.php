<?php

function x($t)
{
    $a = -9.81;
    $vi = 0;
    $xi = 0;
    return 0.5 * $a * pow($t, 2) + $vi * $t + $xi;
}

echo x(10) . "m";

//Exercise #7
//Modify the example program to compute the position of an object after falling for 10 seconds,
//outputting the position in meters. The formula in Math notation is:
//Gravity formula
//Note: The correct value is -490.5m.