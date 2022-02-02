<?php

require_once 'Card.php';
require_once 'Deck.php';
require_once 'BlackPeter.php';
require_once 'Player.php';

$game = new BlackPeter();
$player = new Player();
$npc = new Player();

function show($player, $npc){
    echo 'Player: ';
    foreach ($player->getCards() as $card) {
        echo $card->getDisplayValue() . ' ';
    }
    echo PHP_EOL;
    echo 'NPC:    ';
    foreach ($npc->getCards() as $card) {
        echo $card->getDisplayValue() . ' ';
    }
    echo PHP_EOL . PHP_EOL;
}

function checkWinner($player, $npc)
{
    if ($player->cardsOnHand()==0){echo "Player wins!" . PHP_EOL;exit;}
    if ($npc->cardsOnHand()==0){echo "NPC wins!" . PHP_EOL;exit;}
}

//Deal
for ($i=0; $i < 25; $i++)
{
    $player->addCard($game->deal());
}
for ($i=0; $i < 24; $i++)
{
    $npc->addCard($game->deal());
}


show($player, $npc);

echo "Both disband pairs." . PHP_EOL;
$player->disband();
$npc->disband();
show($player, $npc);
while(true){
    sleep(1);
    echo "NPC is about to draw card from Player" . PHP_EOL;
    $npc->subtractCardFrom($player);
    show($player, $npc);
    checkWinner($player, $npc);

    sleep(1);
    echo "NPC disbands cards if there is a pair" . PHP_EOL;
    $npc->disband();
    show($player, $npc);
    checkWinner($player, $npc);

    sleep(1);
    echo "Player is about to draw card from NPC" . PHP_EOL;
    $player->subtractCardFrom($npc);
    show($player, $npc);
    checkWinner($player, $npc);

    sleep(1);
    echo "Player disbands cards if there is a pair" . PHP_EOL;
    $player->disband();
    show($player, $npc);
    checkWinner($player, $npc);
}