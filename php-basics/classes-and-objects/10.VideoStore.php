<?php

class VideoStore
{
    private array $inventory;

    public function __construct(array $inventory = [])
    {
        $this->inventory = $inventory;
    }

    public function getInventory(): array
    {
        return $this->inventory;
    }

    public function getAvailableVideos(): array
    {
        $availableVideos = [];
        foreach ($this->inventory as $video) {
            if ($video->isAvailable() === true) {
                $availableVideos [] = $video;
            }
        }
        return $availableVideos;
    }

    public function getRentedVideos(): array
    {
        $rentedVideos = [];
        foreach ($this->inventory as $video) {
            if ($video->isAvailable() === false) {
                $rentedVideos [] = $video;
            }
        }
        return $rentedVideos;
    }

    public function addNewVideo(string $title): void
    {
        $this->inventory [] = new Video($title);
    }

    public function checkingOut(string $title): void
    {
        foreach ($this->inventory as $video) {
            if ($video->getTitle() === $title) {
                $video->beingCheckedOut();
            }
        }
    }

    public function returning(string $title): void
    {
        foreach ($this->inventory as $video) {
            if ($video->getTitle() === $title) {
                $video->beingReturned();
            }
        }
    }

    public function giveRating(string $title, int $rating): void
    {
        foreach ($this->inventory as $video) {
            if ($video->getTitle() === $title) {
                $video->receivingRating($rating);
            }
        }
    }

}