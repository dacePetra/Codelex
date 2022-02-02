<?php

echo "Let's play Rock/Paper/Scissors" . PHP_EOL;
$player1 = readline("Please enter player name: ");
$player2 = "Computer";
$options = ["scissors", "paper", "rock", "lizard", "spock"];

function showOptions($options)
{
    echo implode("/", $options);
}

$winningCombinations = [
    "scissors" => ["paper", "lizard"],
    "paper" => ["rock", "spock"],
    "rock" => ["scissors", "lizard"],
    "lizard" => ["paper", "spock"],
    "spock" => ["scissors", "rock"],
];

echo "Options: " . PHP_EOL;
showOptions($options);
echo PHP_EOL;

$choicePlayer1 = readline("{$player1}, please enter your choice: ");
$choicePlayer2 = $options[array_rand($options, 1)];
echo "Computer choice: {$choicePlayer2}" . PHP_EOL;

if ($choicePlayer1 === $choicePlayer2) {
    echo "It's a tie!" . PHP_EOL;
    exit;
}
if (in_array($choicePlayer2, $winningCombinations[$choicePlayer1])) {
    echo "{$player1} wins!" . PHP_EOL;
} else {
    echo "{$player2} wins!" . PHP_EOL;
}

