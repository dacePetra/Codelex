<?php

function createEmployee(string $name, float $basePay, int $hoursWorked): stdClass
{
    $employee = new stdClass();
    $employee->name = $name;
    $employee->basePay = $basePay;
    $employee->hoursWorked = $hoursWorked;
    return $employee;
}

$employees = [
    createEmployee('Employee 1', 7.5, 35),
    createEmployee('Employee 2', 8.2, 47),
    createEmployee('Employee 3', 10, 73),
];
$hourLimit = 60;
$minimumWage = 8;
$standardHours = 40;
$overtimeRate = 1.5;

function calculatePay($hoursWorked, $basePay, $hourLimit, $minimumWage, $standardHours, $overtimeRate)
{
    if ($basePay < $minimumWage) {
        return "Error, the base pay is less than $8.00 an hour.";
    } elseif ($hoursWorked > $hourLimit) {
        return "Error, the maximum of 60 working hours in a week is exceeded.";
    }
    if ($hoursWorked < $standardHours) {
        return $basePay * $hoursWorked;
    } else {
        return "Total pay: $" . ($standardHours * $basePay + ($hoursWorked - $standardHours) * $basePay * $overtimeRate);
    }
}

foreach ($employees as $employee) {
    echo "{$employee->name} " . calculatePay($employee->hoursWorked, $employee->basePay) . PHP_EOL;
    }

//Exercise #8
//Foo Corporation needs a program to calculate how much to pay their hourly employees.
// The US Department of Labor requires that employees get paid time and a half for any hours over 40
// that they work in a single week. For example, if an employee works 45 hours, they get 5 hours of overtime,
// at 1.5 times their base pay. The State of Massachusetts requires that hourly employees be paid
// at least $8.00 an hour. Foo Corp requires that an employee not work more than 60 hours in a week.
//
//Summary
//An employee gets paid (hours worked) × (base pay), for each hour up to 40 hours.
//For every hour over 40, they get overtime = (base pay) × 1.5.
//The base pay must not be less than the minimum wage ($8.00 an hour). If it is, print an error.
//If the number of hours is greater than 60, print an error message.

// Write a method that takes the base pay and hours worked as parameters, and prints the total pay or an error.
// Write a main method that calls this method for each of these employees:
//
//Employee	Base Pay	Hours Worked
//Employee 1	$7.50	35
//Employee 2	$8.20	47
//Employee 3	$10.00	73

