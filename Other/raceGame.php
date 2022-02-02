<?php

$length = 15;
$racers = ["A", "B", "C", "D"];
$wallet = 100;
$winningsMultiplier = 3;

function showAll(array $roads)
{
    foreach ($roads as $road) {
        echo implode("", $road) . PHP_EOL;
    }
}

while (true) {
    echo PHP_EOL;
    echo '[1] Play racing game!' . PHP_EOL;
    echo '[2] Check wallet balance.' . PHP_EOL;
    echo '[3] Deposit money.' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');
    echo PHP_EOL;

    switch ($option) {
        case 1:
            echo "Today's racers: " . implode(" / ", $racers) . PHP_EOL;
            $yourRacer = strtoupper(readline("Choose your racer: "));
            if (!isset($yourRacer) || !ctype_alpha($yourRacer) || strlen($yourRacer) != 1) {
                echo "Error! You have to enter one letter." . PHP_EOL . PHP_EOL;
                break;
            }
            $bet = (int)readline("Enter your bet: ");
            if (!isset($bet) || $bet <= 0) {
                echo "Please check your bet." . PHP_EOL . PHP_EOL;
                break;
            }
            if ($bet > $wallet) {
                echo "You don't have enough money." . PHP_EOL . PHP_EOL;
                break;
            }
            readline("Press enter to start the race!");
            $wallet -= $bet;

            $roads = [];
            for ($i = 0; $i < count($racers); $i++) {
                for ($k = 0; $k < $length; $k++) {
                    $roads[$i][0] = $racers[$i];
                    $roads[$i][$k] = "_";
                }
            }
            $raceResult = [];
            $iterationNumber = 0;
            $overFinishLine = 0;
            $list = [];
            showAll($roads);
            echo PHP_EOL;
            sleep(1);
            while (true) {
                $iterationNumber += 1;
                foreach ($roads as $key => $road) {
                    $indexInRoad = array_search($racers[$key], $road);
                    $stepsInLoop = rand(1, 3);
                    $nextIndex = $indexInRoad + $stepsInLoop;
                    $roads[$key][$indexInRoad] = "_";
                    if ($nextIndex < ($length - 1)) {
                        $roads[$key][$nextIndex] = $racers[$key];
                    } else {
                        $roads[$key][$length - 1] = $racers[$key];
                        if ($indexInRoad != $length - 1) {
                            $raceResult[$iterationNumber][] = $racers[$key];
                            $overFinishLine += 1;
                        }
                    }
                }
                showAll($roads);
                if ($overFinishLine === count($racers)) {
                    echo "The race has ended! Results:" . PHP_EOL;
                    $sequence = array_values($raceResult);
                    for ($m = 1; $m <= $overFinishLine; $m++) {
                        $list[$m] = $m;
                    }
                    foreach ($sequence as $k => $v) {
                        if (is_array($v))
                            echo $list[$k + 1] . ".place: " . implode(" and ", $v) . PHP_EOL;
                        else
                            echo $list[$k + 1] . ".place: {$v}" . PHP_EOL;
                    }
                    if(in_array($yourRacer, $sequence[0])){
                        echo "You have won EUR: " . $bet*$winningsMultiplier . PHP_EOL;
                        $wallet += $bet*$winningsMultiplier;
                    }
                    break;
                }
                echo PHP_EOL;
                sleep(1);
            }
            break;
        case 2:
            echo "You have {$wallet} EUR in your wallet." . PHP_EOL;
            break;
        case 3:
            $deposit = (int)readline("How much money would you like to deposit? ");
            if (isset($deposit) == 0 || $deposit <= 0) {
                echo "Please check the amount." . PHP_EOL . PHP_EOL;
                break;
            } else {
                $wallet += $deposit;
                echo "You have {$wallet} EUR in your wallet." . PHP_EOL;
            }
            break;
        default:
            exit;
    }
}
