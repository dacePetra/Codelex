<?php

class Player
{
    private array $cards = [];

    public function getCards(): array
    {
        return $this->cards;
    }

    public function addCard(Card $card): void
    {
        $this->cards [] = $card;
    }

    public function subtractCardFrom(Player $fromPlayer): void
    {
        $randomCardIndex = array_rand($fromPlayer->cards);
        $card = $fromPlayer->cards[$randomCardIndex];
        $this->addCard($card);
        unset($fromPlayer->cards[$randomCardIndex]);
    }

    public function disband()
    {
        $values = [];
        foreach ($this->cards as $card) {
            if ($card->getColor() == "0") {
                $c = "R";
            } else {
                $c = "B";
            };
            $values[] = $card->getSymbol() . $c;
        }
        $uniqueCardsCount = array_count_values($values);
        foreach ($uniqueCardsCount as $value => $count) {
            if ($count === 1) continue;
            if ($count === 2) {
                foreach ($this->cards as $index => $card) {
                    if ($card->getColor() == "0") {
                        $color = "R";
                    } else {
                        $color = "B";
                    };
                    $cardValue = $card->getSymbol() . $color;
                    if ($cardValue === (string)$value) {
                        unset ($this->cards[$index]);
                    }
                }
            }
        }
    }


    public function cardsOnHand(): int
    {
        $symbols = [];
        foreach ($this->cards as $card) {
            $symbols[] = $card->getSymbol();
        }
        $uniqueCardsCount = array_count_values($symbols);
        return (int)$uniqueCardsCount;

    }
}