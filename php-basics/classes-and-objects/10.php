<?php

require_once '10.Video.php';
require_once '10.VideoStore.php';
require_once '10.Application.php';
require_once '10.VideoStoreTest.php';

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
//The goal of this optional exercise is to design and implement a simple inventory control system
// for a small video rental store. Define least two classes: a class Video to model a video and
// a class VideoStore to model the actual store.
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
//Finally, create a VideoStoreTest which will test the functionality of your other two classes.
// It should allow the following:
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
