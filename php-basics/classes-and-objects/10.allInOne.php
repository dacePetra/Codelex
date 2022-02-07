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
                $video->getAvgRating() . ", available: " . $video->isAvailable() . PHP_EOL;
        }
    }

    private function listAvailableVideos()
    {
        foreach ($this->store->getAvailableVideos() as $video) {
            echo "Title: '" . $video->getTitle() . "', average rating (1-bad, 10-awesome): " .
                $video->getAvgRating() . ", percentage of users that liked the video(rated from 6-10): " .
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

$app = new Application();
$app->run();

//$test= new VideoStoreTest();
//echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
//echo "Test: add 3 videos" . PHP_EOL;
//$test->testAddVideo();
//echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
//echo "Test: receive ratings to videos" . PHP_EOL;
//$test->testReceivingRating();
//echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
//echo "Test: rent and return video" . PHP_EOL;
//$test->testRentReturn();
//echo "~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~" . PHP_EOL;
//echo "Test: check inventory after 'Godfather II' has been rented" . PHP_EOL;
//$test->testInventory();
