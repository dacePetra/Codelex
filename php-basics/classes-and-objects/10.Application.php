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

    private function listInventory()         // TODO ???
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