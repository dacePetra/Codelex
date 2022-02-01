<?php

class Person
{
    private string $name;
    private string $surname;
    private int $idNumber;

    public function __construct(string $name, string $surname, int $idNumber)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->idNumber = $idNumber;
    }

    public function getName(Person $person)
    {
        return $this->name;
    }

    public function getSurname(Person $person)
    {
        return $this->surname;
    }

    public function getIdNumber(Person $person)
    {
        return $this->idNumber;
    }
}

$jack = new Person("Jack", "Cole", 546897);
$jane = new Person("Jane", "Smith", 123555);
$jim = new Person("Jim", "Stone", 815649);
//var_dump($jack);
//var_dump($jane);
//var_dump($jim);die;

class Registry
{
    private array $list = [];

    public function add(Person $person): void
    {
        $this->list[] = $person;
    }

    public function getPersons(): array
    {
        return $this->list;
    }

}

$registry = new Registry();
$registry->add($jack);
$registry->add($jane);
$registry->add($jim);

while (true) {
    echo '[1] Print the list' . PHP_EOL;
    echo '[2] Add person to list' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');
    echo PHP_EOL;

    switch ($option) {
        case 1:
            foreach ($registry->getPersons() as $person) {
                echo $person->getName($person) . " " . $person->getSurname($person) . " " . $person->getIdNumber($person) . PHP_EOL;
            };
            echo PHP_EOL;
            break;
        case 2:
            $newPersonName = readline('Enter name: ');
            $newPersonSurname = readline('Enter surname: ');
            $newPersonIdNumber = readline('Enter ID number(6 digits): ');
            $registry->add(new Person($newPersonName, $newPersonSurname, $newPersonIdNumber));
            echo "Person has been added." . PHP_EOL . PHP_EOL;
            break;
        default:
            exit;
    }
}
