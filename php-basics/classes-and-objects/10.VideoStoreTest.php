<?php

class VideoStoreTest
{
    private VideoStore $store;

    public function __construct()
    {
        $this->store = new VideoStore();
    }

    public function testAddVideo():void
    {
        $this->store->addNewVideo("The Matrix");
        $this->store->addNewVideo("Godfather II");
        $this->store->addNewVideo("Star Wars Episode IV: A New Hope");

        foreach ($this->store->getInventory() as $video)
        {
            echo "Movie: " . $video->getTitle() . " Rating: " . $video->getAvgRating() . PHP_EOL;
        }
    }
    public function testReceivingRating():void
    {
        foreach ($this->store->getInventory() as $video) {
            echo "Before: Movie: " . $video->getTitle() . " Rating: " . $video->getAvgRating() . PHP_EOL;
            $video->receivingRating(rand(1, 10));
            $video->receivingRating(rand(1, 10));
            $video->receivingRating(rand(1, 10));
            echo "After: Movie: " . $video->getTitle() . " Rating: " . $video->getAvgRating() . PHP_EOL;
        }
    }

    public function testRentReturn():void
    {
        $this->store->checkingOut("Godfather II");
        foreach ($this->store->getInventory() as $video) {
            if ($video->getTitle() === "Godfather II") {
                if (!$video->isAvailable()) {
                    echo "Expected false(0): " . $video->isAvailable() . PHP_EOL;
                }
            }
        }

        $this->store->returning("Godfather II");
        foreach ($this->store->getInventory() as $video) {
            if ($video->getTitle() === "Godfather II") {
                if ($video->isAvailable()) {
                    echo "Expected true(1): " . $video->isAvailable() . PHP_EOL;
                }
            }
        }
    }

    public function testInventory():void
    {
        $this->store->checkingOut("Godfather II");
        foreach ($this->store->getInventory() as $video) {
            echo "Movie: " . $video->getTitle() . ", available: " . $video->isAvailable() .  PHP_EOL;
        }
    }

}