<?php

$gameFile = file_get_contents("/mnt/c/Users/jurgi/PhpstormProjects/php-basics/array/default.txt");
$givenInfo = explode('
', $gameFile);//Uztaisu masīvu ar diviem stingiem(board un conbinations)

$boardSize = explode("x", (substr($givenInfo[0], (strpos($givenInfo[0], ":") + 1)))); //Iegūstu masīvu ar rindu un kolonnu skaitu
$board = array_fill(0, (int)($boardSize[1]), (array_fill(0, (int)($boardSize[0]), "-"))); //Uztaisu tukšu laukumu


$defaultCombinationsLine = explode("|", (substr($givenInfo[1], (strpos($givenInfo[1], ":") + 1)))); //Iegūstu kombinācijas līniju
$place = [];
foreach ($defaultCombinationsLine as $line) {
    $place[] = explode(";", $line);
}; //Tieku līdz masīvam ar stringiem

$combinations = [];
foreach ($place as $elemKey => $elem) {
    foreach ($elem as $valKey => $val) {
        $position = explode(",", $val);
        for ($i = 0; $i < count($position); $i++) {
            $position[$i] = intval($position[$i]);
        }
        $combinations[$elemKey][$valKey] = $position;
    }
};//Izveidoju kombinācijas nepieciešamajā fromātā

echo "Let's play TicTacToe!" . PHP_EOL;
$player1 = readline("Please enter symbol for player #1: ");
echo PHP_EOL;
$player2 = readline("Please enter symbol for player #2: ");
echo PHP_EOL;

$activePlayer = $player1;

//$board = [
//    ['-', '-', '-'],
//    ['-', '-', '-'],
//    ['-', '-', '-'],
//];

//$combinations = [
//    [
//        [0, 0], [0, 1], [0, 2]
//    ],
//    [
//        [1, 0], [1, 1], [1, 2]
//    ],
//    [
//        [2, 0], [2, 1], [2, 2]
//    ],
//    [
//        [0, 0], [1, 0], [2, 0]
//    ],
//    [
//        [0, 1], [1, 1], [2, 1]
//    ],
//    [
//        [0, 2], [1, 2], [2, 2]
//    ],
//    [
//        [0, 0], [1, 1], [2, 2]
//    ],
//    [
//        [0, 2], [1, 1], [2, 0]
//    ]
//];

function winnerWinnerChickenDinner(array $combinations, array $board, string $activePlayer): bool
{
    foreach ($combinations as $combination) {
        foreach ($combination as $item) {
            [$row, $column] = $item;
            if ($board[$row][$column] !== $activePlayer) {
                break;
            }

            if (end($combination) === $item) {
                return true;
            }
        }
    }

    return false;
}

function isBoardFull(array $board): bool
{
    foreach ($board as $row) {
        if (in_array('-', $row)) return false;
    }
    return true;
}

function showBoard(array $board): void
{
    foreach ($board as $item) {
        foreach ($item as $value) {
            echo "  $value  ";
        }
        echo PHP_EOL;
    }
}

while (!isBoardFull($board) && !winnerWinnerChickenDinner($combinations, $board, $activePlayer)) {
    showBoard($board);
    $position = readline("Enter position ({$activePlayer}): ");
    [$row, $column] = explode(',', $position);

    if ($board[$row][$column] !== '-') {
        echo 'Invalid position. its taken!' . PHP_EOL;
        continue;
    };

    $board[$row][$column] = $activePlayer;

    if (winnerWinnerChickenDinner($combinations, $board, $activePlayer)) {
        showBoard($board);
        echo 'Winner is ' . $activePlayer;
        echo PHP_EOL;
        exit;
    }

    $activePlayer = $player1 === $activePlayer ? $player2 : $player1;
};

showBoard($board);
echo 'The game was tied.';
echo PHP_EOL;
