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

    public function subtractCardFrom(Player $fromPlayer):void
    {
        $randomCardIndex = array_rand($fromPlayer->cards);
        $card = $fromPlayer->cards[$randomCardIndex];
        $this->addCard($card);
        unset($fromPlayer->cards[$randomCardIndex]);
    }

    public function disband()
    {
        $symbols = [];
        foreach ($this->cards as $card) {
            $symbols[] = $card->getSymbol();
        }
        $uniqueCardsCount = array_count_values($symbols);
        foreach ($uniqueCardsCount as $symbol => $count) {
            if ($count === 1) continue;
            if ($count === 2 || $count === 4) {
                //var_dump((string) $symbol, $count);
                foreach ($this->cards as $index => $card) {
                    if ($card->getSymbol() === (string)$symbol) {
                        unset ($this->cards[$index]);
                    }
                }
            }
            if ($count === 3) {
                //var_dump((string) $symbol, $count);
                for ($i = 0; $i < 2; $i++) {
                    foreach ($this->cards as $index => $card) {
                        if ($card->getSymbol() === (string)$symbol) {
                            unset ($this->cards[$index]);
                            break;
                        }
                    }
                }
            }
        }
    }
    public function cardsOnHand():int
    {
        $symbols = [];
        foreach ($this->cards as $card) {
            $symbols[] = $card->getSymbol();
        }
        $uniqueCardsCount = array_count_values($symbols);
        return (int) $uniqueCardsCount;

    }
}