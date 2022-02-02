<?php

$wallet = (int) file_get_contents("/mnt/c/Users/jurgi/PhpstormProjects/php-basics/Other/wallet.txt");
$letters = ["A", "B", "C"];
$payouts = [
    "A" => 5,
    "B" => 10,
    "C" => 15
];

$board = [
    ['-', '-', '-', '-'],
    ['-', '-', '-', '-'],
    ['-', '-', '-', '-'],
];

$combinations = [
    [
        [0, 0], [0, 1], [0, 2], [0, 3]
    ],
    [
        [1, 0], [1, 1], [1, 2], [1, 3]
    ],
    [
        [2, 0], [2, 1], [2, 2], [2, 3]
    ],
    [
        [0, 0], [1, 1], [2, 2], [2, 3]
    ],
    [
        [2, 0], [1, 1], [0, 2], [0, 3]
    ],
];

function showBoard(array $board): void
{
    foreach ($board as $item) {
        foreach ($item as $value) {
            echo "  $value  ";
        }
        echo PHP_EOL;
    }
}

while (true) {
    echo '[1] Play!' . PHP_EOL;
    echo '[2] Check wallet balance.' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');

    switch ($option) {
        case 1:
            if($wallet<=0){
                echo "The wallet is empty!" . PHP_EOL . PHP_EOL;
                file_put_contents("/mnt/c/Users/jurgi/PhpstormProjects/php-basics/Other/wallet.txt", $wallet);
                exit;
            }
            echo "Let's spin!" . PHP_EOL;
            echo "You have {$wallet} EUR in your wallet." . PHP_EOL;

            $bet = (int) readline("Enter your bet: ");
            if($bet === null || $bet<=0){
                echo "Please check your bet." . PHP_EOL . PHP_EOL;
                break;
            }
            if($bet>$wallet){
                echo "You don't have enough money." . PHP_EOL . PHP_EOL;
                break;
            }
            readline("Press enter to spin!");
            $wallet -= $bet;

            foreach ($board as $itemKey => $item) {
                foreach ($item as $valueKey => $value) {
                    $board[$itemKey][$valueKey] = $letters[array_rand($letters)];
                }
            }                // Ieliek random vērtības no $letters

            showBoard($board);
//var_dump($board);die;
            for ($i = 0; $i < count($letters); $i++) {
                foreach ($combinations as $combination) {
                    foreach ($combination as $item) {
                        [$row, $column] = $item;

                        if ($board[$row][$column] !== $letters[$i]) {
                            break;
                        }

                        if (end($combination) === $item) {
                            echo "You have a line of {$letters[$i]}! You have won {$payouts[$letters[$i]]} x {$bet} EUR." . PHP_EOL;
                            $wallet += ($payouts[$letters[$i]] * $bet);
                        }
                    }
                }
            };

            echo "You have {$wallet} EUR in your wallet." . PHP_EOL . PHP_EOL;
             break;
        case 2:
            echo "You have {$wallet} EUR in your wallet." . PHP_EOL . PHP_EOL;
            break;
        default:
            file_put_contents("/mnt/c/Users/jurgi/PhpstormProjects/php-basics/Other/wallet.txt", $wallet);
            exit;
    };
}
