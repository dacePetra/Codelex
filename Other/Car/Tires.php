<?php

class Tire
{
    public string $name;
    private int $condition;


    public function __construct(string $name, int $condition = 100)
    {
        $this->name = $name;
        $this->condition = $condition;
    }

    public function changeCondition(int $percent): void
    {
        $this->condition -= $percent;
    }
    public function getCondition(): int
    {
        return $this->condition;
    }
    public function getName(): string
    {
        return $this->name;
    }
}