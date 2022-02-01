<?php
class Date
{
    public string $occasion;
    public int $month;
    public int $day;
    public int $year;

    public function __construct(string $occasion, int $month, int $day, int $year)
    {
        $this->occasion = $occasion;
        $this->month = $month;
        $this->day = $day;
        $this->year = $year;
    }

        public function setMonth(int $month):void
    {
        $this->month = $month;
    }

    public function setDay(int $day): void
    {
        $this->day = $day;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function DisplayDate(): string
    {
        return $this->month . "/" . $this->day . "/" . $this->year . PHP_EOL;
    }
}
class Journal
{
    public array $dates = [];

    public function addDate(Date $date):void
    {
        $this->dates [] = $date;
    }

    public function findDateByKey($key)
    {
        foreach ($this->dates as $dateKey=>$date){
            if($key-1 == $dateKey){
                return $date->occasion . ": " . $date->DisplayDate() . PHP_EOL;
            }
        }
    }
}
$journal = new Journal();
echo "Welcome to DateTest application. Here you can save your special dates." . PHP_EOL;
while(true)
{
    echo "[1] Save new special date" . PHP_EOL;
    echo "[2] Show all saved special dates" . PHP_EOL;
    echo "[3] Search spacial date by occasion name" . PHP_EOL;
    echo "[4] Change month of special date" . PHP_EOL;
    echo "[Any] Exit" . PHP_EOL;
    $choice = readline("Enter your choice: ");
    echo PHP_EOL;

    switch ($choice){
        case 1:
            $occasion = readline("Enter occasion: ");
            $month = readline("Enter month of the date(1 for Jan, 12 for Dec): ");
            $day = readline("Enter day of the date: ");
            $year = readline("Enter year of the date: ");
            $journal->addDate(new Date($occasion, $month, $day, $year));
            echo "Date has been saved." . PHP_EOL . PHP_EOL;
            break;
        case 2:
            foreach ($journal->dates as $date){
                echo $date->occasion . ": " . $date->DisplayDate();
            }
            echo PHP_EOL;
            break;
        case 3:
            foreach ($journal->dates as $key=>$date){
                echo "[" . ($key+1) . "] " . $date->occasion . PHP_EOL;
            }
            $key = readline("Enter occasion number: ");
            echo $journal->findDateByKey($key);
            break;
        case 4:
            foreach ($journal->dates as $key=>$date){
                echo "[" . ($key+1) . "] " . $date->occasion . ": " . $date->DisplayDate() . PHP_EOL;
            }
            $key = readline("Let's change the month. Enter occasion number: ");
            $newMonth = readline("Enter new month: ");
            foreach ($journal->dates as $dateKey=>$date){
                if($key-1 == $dateKey){
                    $date->setMonth($newMonth);
                }
            }
            echo "Date has been changed: " . $journal->findDateByKey($key);
            break;
        default:
            echo "Bye bye!" . PHP_EOL;
            exit;
    }

}


//Exercise #5
//Create a class called Date that includes: three pieces of information as instance variables — a month, a day and a year.
//
//Your class should have a constructor that initializes the three instance variables and assumes that the values provided are correct.
// Provide a set and a get for each instance variable.
//
//Provide a method DisplayDate that displays the month, day and year separated by forward slashes /.
//
//Write a test application named DateTest that demonstrates class Date capabilities.
