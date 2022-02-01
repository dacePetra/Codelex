<?php
echo "Let's play Tic-Tac-Toe!" . PHP_EOL;

function display_board()
{
    echo " 0 0 | 0 1 | 0 2 \n";
    echo "-----+-----+-----\n";
    echo " 1 0 | 1 1 | 1 2 \n";
    echo "-----+-----+-----\n";
    echo " 2 0 | 2 1 | 2 2 \n";
}
display_board();

$playerO = "O";
$playerX = "X";
$activePlayer = $playerO;

echo "Row and column input must be separated by space. For example: '0 1'" . PHP_EOL;
$board = [
    '.', '.', '.',
    '.', '.', '.',
    '.', '.', '.'
];

while (true) {
    $input = readline("{$activePlayer}, choose your location (row, column): ") . PHP_EOL;

    if(strpos($input, " ", 1) !== 1){
        echo "Error, wrong input! No 'space' between numbers." . PHP_EOL;continue;
    };
        if(substr($input, 0, 1) == 0 || substr($input, 0, 1) == 1 || substr($input, 0, 1) == 2
    || substr($input, 2, 1) == 0 || substr($input, 2, 1) == 1 || substr($input, 2, 1) == 2 ){
        echo "\n";
    } else {
        echo "Error, wrong input! Enter row and column numbers from 0 to 2." . PHP_EOL;continue;
    };

    $answer = explode(" ", $input,);

    $r = (int)$answer[0];
    $c = (int)$answer[1];

    if ($r === 0 && $c === 0) {$board[0] = $activePlayer;};
    if ($r === 0 && $c === 1) {$board[1] = $activePlayer;};
    if ($r === 0 && $c === 2) {$board[2] = $activePlayer;};
    if ($r === 1 && $c === 0) {$board[3] = $activePlayer;};
    if ($r === 1 && $c === 1) {$board[4] = $activePlayer;};
    if ($r === 1 && $c === 2) {$board[5] = $activePlayer;};
    if ($r === 2 && $c === 0) {$board[6] = $activePlayer;};
    if ($r === 2 && $c === 1) {$board[7] = $activePlayer;};
    if ($r === 2 && $c === 2) {$board[8] = $activePlayer;};

    foreach (array_chunk($board, 3) as $chunk) {
        echo implode(' ', $chunk) . PHP_EOL;
    };

    if($board[0]=="O" && $board[0]==$board[1] && $board[1]==$board[2]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[3]=="O" && $board[3]==$board[4] && $board[4]==$board[5]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[6]=="O" && $board[6]==$board[7] && $board[7]==$board[8]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[0]=="O" && $board[0]==$board[3] && $board[3]==$board[6]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[1]=="O" && $board[1]==$board[4] && $board[4]==$board[7]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[2]=="O" && $board[2]==$board[5] && $board[5]==$board[8]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[0]=="O" && $board[0]==$board[4] && $board[4]==$board[8]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };
    if($board[2]=="O" && $board[2]==$board[4] && $board[4]==$board[6]){
        echo "Game over! Player {$activePlayer} has won!" . PHP_EOL; exit;
    };

    if(in_array(".", $board) == false){
        echo "Game over! It's a tie." . PHP_EOL;
        exit;
    };
    $activePlayer = $playerO === $activePlayer ? $playerX : $playerO;
}


//Code an interactive, two-player game of Tic-Tac-Toe. You'll use a two-dimensional array of chars.
//
//(...a game already in progress)
//
//	X   O
//	O X X
//	  X O
//
//'O', choose your location (row, column): 0 1
//
//	X O O
//	O X X
//	  X O
//
//'X', choose your location (row, column): 2 0
//
//	X O O
//	O X X
//	X X O
//
//The game is a tie.