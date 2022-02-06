<?php

class Application
{
    private VideoStore $store;

    public function __construct()
    {
        $this->store = new VideoStore();
    }

    function run()
    {
        while (true) {
            echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
            echo "Choose the operation you want to perform: \n";
            echo "Choose [0] for EXIT\n";
            echo "Choose [1] to fill video store\n";
            echo "Choose [2] to rent video (as user)\n";
            echo "Choose [3] to return video (as user)\n";
            echo "Choose [4] to list inventory\n";

            $command = (int)readline();

            switch ($command) {
                case 0:
                    echo "Bye!" . PHP_EOL;
                    die;
                case 1:
                    $newVideoTitle = readline("Enter the title of new video: ");
                    $this->addMovies($newVideoTitle);
                    break;
                case 2:
                    echo "Available movies:" . PHP_EOL;
                    $this->listAvailableVideos();
                    $wantedVideoTitle = readline("Enter the title of video: ");
                    if (!$this->movieIsRegistered($wantedVideoTitle)) {
                        echo "Please check the title. This title is not registered in our inventory." . PHP_EOL;
                        break;
                    }
                    $this->rentVideo($wantedVideoTitle);
                    break;
                case 3:
                    $returnedVideoTitle = readline("Enter the title of video: ");
                    if (!$this->movieIsRegistered($returnedVideoTitle)) {
                        echo "Please check the title. This title is not registered in our inventory." . PHP_EOL;
                        break;
                    }
                    echo "Would you like to give rating for '{$returnedVideoTitle}'?" . PHP_EOL;
                    echo "[1] Yes" . PHP_EOL;
                    echo "[2] No" . PHP_EOL;
                    $wantToRate = readline("Enter number of your choice: ");
                    if ((int)$wantToRate === 1) {
                        $this->returnVideo($returnedVideoTitle);
                        $givenRating = readline("Please enter your rating: ");
                        $this->enterRating($returnedVideoTitle, $givenRating);
                        echo "Video has been returned successfully. Rating accepted." . PHP_EOL;
                    } elseif ((int)$wantToRate === 2) {
                        $this->returnVideo($returnedVideoTitle);
                        echo "Video has been returned successfully. No rating." . PHP_EOL;
                    } else {
                        echo "Please try again. Video has not been returned." . PHP_EOL;
                    }
                    break;
                case 4:
                    echo "INVENTORY:" . PHP_EOL;
                    $this->listInventory();
                    break;
                default:
                    echo "Sorry, I don't understand you." . PHP_EOL;
                    break;
            }
        }
    }

    private function addMovies(string $title): void
    {
        $this->store->addNewVideo($title);
    }

    private function rentVideo(string $title): void
    {
        $this->store->checkingOut($title);
    }

    private function returnVideo(string $title): void
    {
        $this->store->returning($title);
    }

    private function listInventory()
    {
        foreach ($this->store->getInventory() as $video) {
            echo "Title: '" . $video->getTitle() . "', average rating (1-bad, 10-awesome): " .
                $video->getAvgUserRating() . ", available: " . $video->isAvailable() . PHP_EOL;
        }
    }

    private function listAvailableVideos()
    {
        foreach ($this->store->getAvailableVideos() as $video) {
            echo "Title: '" . $video->getTitle() . "', average rating (1-bad, 10-awesome): " .
                $video->getAvgUserRating() . ", percentage of users that liked the video(rated from 6-10): " .
                $video->getPositiveRatingPercentage() . PHP_EOL;
        }
    }

    private function enterRating(string $title, int $rating): void
    {
        $this->store->giveRating($title, $rating);
    }

    private function movieIsRegistered(string $returnedVideoTitle): bool
    {
        foreach ($this->store->getInventory() as $video) {
            if ($video->getTitle() === $returnedVideoTitle) {
                return true;
            }
        }
        return false;
    }

}

class VideoStore
{
    private array $inventory;

    public function __construct(array $inventory = [])
    {
        $this->inventory = $inventory;
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

    public function getInventory(): array
    {
        return $this->inventory;
    }
}

class Video
{
    private string $title;
    private bool $available;
    private float $avgUserRating; // 1 bad to 10 awesome
    private array $ratings = [];

    public function __construct(string $title, bool $available = true, float $avgUserRating = 0)
    {
        $this->title = $title;
        $this->available = $available;
        $this->avgUserRating = $avgUserRating;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isAvailable(): bool
    {
        return $this->available;
    }

    public function getAvgUserRating(): float
    {
        return $this->avgUserRating;
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
        $this->avgUserRating = number_format(array_sum($this->ratings) / count($this->ratings), 2);
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
            echo "Movie: " . $video->getTitle() . " Rating: " . $video->getAvgUserRating() . PHP_EOL;
        }
    }
    public function testReceivingRating():void
    {
        foreach ($this->store->getInventory() as $video) {
            echo "Before: Movie: " . $video->getTitle() . " Rating: " . $video->getAvgUserRating() . PHP_EOL;
            $video->receivingRating(rand(1, 10));
            $video->receivingRating(rand(1, 10));
            $video->receivingRating(rand(1, 10));
            echo "After: Movie: " . $video->getTitle() . " Rating: " . $video->getAvgUserRating() . PHP_EOL;
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

$app = new Application();
$app->run();

$test= new VideoStoreTest();
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
echo "Test: add 3 videos" . PHP_EOL;
$test->testAddVideo();
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
echo "Test: receive ratings to videos" . PHP_EOL;
$test->testReceivingRating();
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
echo "Test: rent and return video" . PHP_EOL;
$test->testRentReturn();
echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
echo "Test: check inventory after 'Godfather II' has been rented" . PHP_EOL;
$test->testInventory();




//Exercise #10
//See video-store.php
//
//The goal of this optional exercise is to design and implement a simple inventory control system for a small video rental store. Define least two classes: a class Video to model a video and a class VideoStore to model the actual store.
//
//Assume that a Video may have the following state:
//
//A title;
//a flag to say whether it is checked out or not; and
//an average user rating.
//In addition, Video has the following behaviour:
//
//being checked out;
//being returned;
//receiving a rating.
//The VideoStore may have the state of videos in there currently. The VideoStore will have the following behaviour:
//
//add a new video (by title) to the inventory;
//check out a video (by title);
//return a video to the store;
//take a user's rating for a video;
//list the whole inventory of videos in the store.
//Finally, create a VideoStoreTest which will test the functionality of your other two classes. It should allow the following:
//
//Add 3 videos: "The Matrix", "Godfather II", "Star Wars Episode IV: A New Hope".
//Give several ratings to each video.
//Rent each video out once and return it.
//List the inventory after "Godfather II" has been rented out out.
//Summary of design specs:
//
//Store a library of videos identified by title.
//Allow a video to indicate whether it is currently rented out.
//Allow users to rate a video and display the percentage of users that liked the video.
//Print the store's inventory, listing for each video:
//its title,
//the average rating,
//and whether it is checked out or on the shelves.
