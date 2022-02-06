<?php

class Video
{
    private string $title;
    private bool $available;
    private float $avgRating; // avg user rating 1 bad to 10 awesome
    private array $ratings = []; // all rating given by users

    public function __construct(string $title, bool $available = true, float $avgRating = 0)
    {
        $this->title = $title;
        $this->available = $available;
        $this->avgRating = $avgRating;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getAvgRating(): float
    {
        return $this->avgRating;
    }

    public function beingCheckedOut(): void
    {
        $this->available = false;
    }

    public function beingReturned(): void
    {
        $this->available = true;
    }

    public function receivingRating(int $rating): void
    {
        $this->ratings [] = $rating;
        $this->avgRating = number_format(array_sum($this->ratings) / count($this->ratings), 2);
    }

    public function getPositiveRatingPercentage(): string // % of users, who has given rate 6-10
    {
        if (count($this->ratings) === 0) {
            return "0%";
        }
        $positiveRating = [];
        foreach ($this->ratings as $rating) {
            if ((int)$rating >= 6) {
                $positiveRating[] = $rating;
            }
        }
        return number_format(count($positiveRating) / count($this->ratings) * 100, 2) . "%";
    }
}