<?php
class Card
{
    private string $suit;
    private string $symbol;
    //private int $color; //0=red, 1=black

    public function __construct(string $suit, string $symbol)
    {
        $this->suit = $suit;
        $this->symbol = $symbol;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }


    public function getDisplayValue(): string
    {
        return "{$this->symbol}.{$this->suit}";
    }

}