<?php

class Movie
{
    public string $title;
    public string $studio;
    public string $rating;

    public function __construct(string $title, string $studio, string $rating)
    {
        $this->title = $title;
        $this->studio = $studio;
        $this->rating = $rating;
    }
}

class MoviesList
{
    public array $movies = [];
    public array $moviesWithPG = [];

    public function addMovies(Movie $movie): void
    {
        $this->movies[] = $movie;
    }

    public function GetPG(): array
    {
        foreach ($this->movies as $movie) {
            if ($movie->rating == "PG") // if also PG13, then: strpos($movie->rating, "PG") !== false
            {
                $this->moviesWithPG [] = $movie;
            }
        }
        return $this->moviesWithPG;
    }
}

$casinoRoyale = new Movie('Casino Royale', 'Eon Productions', 'PG13');
$glass = new Movie('Glass', 'Buena Vista International', 'PG13');
$spiderMan = new Movie('Spider-Man: Into the Spider-Verse', 'Columbia Pictures', 'PG');
$frozen = new Movie("Frozen", "Walt Disney Animation Studios", "R");

$list = new MoviesList();
$list->addMovies($casinoRoyale);
$list->addMovies($glass);
$list->addMovies($spiderMan);
$list->addMovies($frozen);
$list->GetPG();

foreach ($list->moviesWithPG as $movie) {
    echo $movie->title . PHP_EOL;
}

//Exercise #4
//The class Movie is started below. An instance of class Movie represents a film.
// This class has the following three class variables:
//  title, which is a string representing the title of the movie
//  studio, which is a string representing the studio that made the movie
//  rating, which is a string representing the rating of the movie (i.e. PG­13, R, etc)
//1. Write a constructor for the class Movie, which takes the title of the movie, studio,
// and rating as its arguments, and sets the respective class variables to these values.
//2. Write a method GetPG, which takes an array of base type Movie as its argument,
// and returns a new array of only those movies in the input array with a rating of "PG".
// You may assume the input array is full of Movie instances. The returned array may be empty.
//3. Write a piece of code that creates an instance of the class Movie:
//with the title “Casino Royale”, the studio “Eon Productions” and the rating “PG­13”;
//with the title “Glass”, the studio “Buena Vista International” and the rating “PG­13”;
//with the title “Spider-Man: Into the Spider-Verse”, the studio “Columbia Pictures” and the rating “PG”.