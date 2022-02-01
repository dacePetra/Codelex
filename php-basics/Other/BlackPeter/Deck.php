<?php
require_once 'Card.php';
class Deck
{
    private array $cards = [];
    private array $symbols = [
        '♣', '♦', '♥', '♠'
    ];

    public function __construct(array $cards = [])
    {
        $this->cards = $cards;
        if (empty($this->cards)) $this->shuffle();
    }

    public function draw(): Card
    {
        $randomCardIndex = array_rand($this->cards);
        $card = $this->cards[$randomCardIndex];
        array_splice($this->cards, $randomCardIndex, 1);
        return $card;
    }

    private function shuffle(): void
    {
        $this->cards = [];
        for ($i = 1; $i <= 13; $i++) {
            for ($j = 0; $j < 4; $j++) {
                switch ($i) {
                    case 11:
                        break;
                    case 12:
                        $this->cards[] = new Card($this->symbols[$j], 'Q');
                        break;
                    case 13:
                        $this->cards[] = new Card($this->symbols[$j], 'K');
                        break;
                    default:
                        $this->cards[] = new Card($this->symbols[$j], $i);
                        break;
                }
            }
        }
        $this->cards[] = new Card('♠', 'J');
    }
    public function getCards(): array
    {
        return $this->cards;
    }
}
