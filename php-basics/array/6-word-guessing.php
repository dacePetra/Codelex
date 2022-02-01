<?php

echo "Let's play word guessing game!" . PHP_EOL;

$listOfWords = ["pen", "duck", "apple", "sunset", "happiness"];

$randomWord = $listOfWords[array_rand($listOfWords, 1)];
$word = str_split($randomWord); //Array of letters from the word
$badLetters = [];
$goodLetters = [];
$maxMisses = 5;
$board = [];
for ($i = 0; $i < count($word); $i++) {
    $board[$i] = "_";
}

while (true) {
    echo "-=-=-=-=-=-=-=-=-=-=-=-=-=-" . PHP_EOL . PHP_EOL;
    echo "Word: " . implode(" ", $board) . PHP_EOL . PHP_EOL;
    echo "Misses (max {$maxMisses}): " . implode(" ", $badLetters) . PHP_EOL . PHP_EOL;

    $guess = strtolower(readline("Please guess one letter: "));
    echo PHP_EOL;

    if ($guess === "" || ctype_alpha($guess) != 1) {
        echo "Error! You have to enter one letter." . PHP_EOL;
        continue;
    }
    if (in_array($guess, $goodLetters) || in_array($guess, $badLetters)) {
        echo "This letter has already been entered." . PHP_EOL;
        continue;
    }

    foreach ($word as $key => $letter) {
        if ($guess === $letter) {
            echo "Good job, there is '{$guess}' in the word" . PHP_EOL;
            $board[$key] = $guess;
            $goodLetters[] = $guess;
            if (count(array_diff($word, $goodLetters)) == 0) {
                echo "Word: " . implode(" ", $board) . PHP_EOL;
                echo "You have guessed the word!" . PHP_EOL . PHP_EOL;
                exit;
            }
        }
    };
    if (in_array($guess, $word) != 1) {
        echo "You missed!, there is no '{$guess}' in the word" . PHP_EOL;
        $badLetters[] = $guess;
        echo "Misses (max {$maxMisses}): " . implode(" ", $badLetters) . PHP_EOL . PHP_EOL;
        if (count($badLetters) == $maxMisses) {
            echo "You have missed {$maxMisses} times. Game over!" . PHP_EOL;
            echo "The word was '" . implode("", $word) . "'!" . PHP_EOL . PHP_EOL;
            exit;
        }
    }
}




//Exercise #6
//Write a program to play a word-guessing game like Hangman.
//
//It must randomly choose a word from a list of words.
//It must stop when all the letters are guessed.
//It must give them limited tries and stop after they run out.
//It must display letters they have already guessed (either only the incorrect guesses or all guesses).
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ _ _ _ _ _ _ _ _
//
//Misses:
//
//Guess:	e
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ _ _ _ _ _ _
//
//Misses:
//
//Guess:	i
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i _ _ _ _ _
//
//Misses:
//
//Guess:	a
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i a _ _ a _
//
//Misses:
//
//Guess:	r
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i a _ _ a _
//
//Misses:	r
//
//Guess:	s
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i a _ _ a _
//
//Misses:	rs
//
//Guess:	t
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i a t _ a _
//
//Misses:	rs
//
//Guess:	n
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i a t _ a n
//
//Misses:	rs
//
//Guess:	o
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	_ e _ i a t _ a n
//
//Misses:	rso
//
//Guess:	l
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	l e _ i a t _ a n
//
//Misses:	rso
//
//Guess:	v
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	l e v i a t _ a n
//
//Misses:	rso
//
//Guess:	h
//
//-=-=-=-=-=-=-=-=-=-=-=-=-=-
//
//Word:	l e v i a t h a n
//
//Misses:	rso
//
//YOU GOT IT!