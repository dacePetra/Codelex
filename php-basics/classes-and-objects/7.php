<?php

class Dog
{
    private string $name;
    private string $sex;
    private ?Dog $mother;
    private ?Dog $father;


    public function __construct(string $name, string $sex, ?Dog $mother = null, ?Dog $father = null)
    {
        $this->name = $name;
        $this->sex = $sex;
        $this->mother = $mother;
        $this->father = $father;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function fathersName(): string
    {
        if ($this->father == null) {
            return "Unknown";
        }
        return $this->father->getName();
    }

    public function hasSameMother(Dog $otherDog):bool
    {
        return $this->mother->getName() === $otherDog->mother->getName();
    }

}

class DogTest
{
    public function main()
    {
        $max = new Dog('Max', 'male');
        $rocky = new Dog('Rocky', 'male');
        $sparky = new Dog('Sparky', 'male');
        $buster = new Dog('Buster', 'male');
        $sam = new Dog('Sam', 'male');
        $lady = new Dog('Lady', 'female');
        $molly = new Dog('Molly', 'female');
        $coco = new Dog('Coco', 'female');

        $max = new Dog('Max', 'male', $lady, $rocky);
        $rocky = new Dog('Rocky', 'male', $molly, $sam);
        $sparky = new Dog('Sparky', 'male');
        $buster = new Dog('Buster', 'male', $lady, $sparky);
        $sam = new Dog('Sam', 'male');
        $lady = new Dog('Lady', 'female');
        $molly = new Dog('Molly', 'female');
        $coco = new Dog('Coco', 'female', $molly, $buster);

        echo 'Coco father test: ';
        echo $coco->fathersName() == 'Buster' ? 'PASS' : 'FAIL';
        echo PHP_EOL;
        echo 'Sparky father test: ';
        echo $sparky->fathersName() == 'Unknown' ? 'PASS' : 'FAIL';
        echo PHP_EOL;
        echo 'Coco father test: ';
        echo $coco->hasSameMother($rocky) == 'true' ? 'PASS' : 'FAIL';
        echo PHP_EOL;
    }
}

(new DogTest())->main();





//Exercise #7
//The questions in this exercise all deal with a class Dog that you have to program from scratch.
//
//Create a class Dog. Dogs should have a name, and a sex.
//Make a class DogTest with a Main method in which you create the following Dogs:
//Max, male
//Rocky, male
//Sparky, male
//Buster, male
//Sam, male
//Lady, female
//Molly, female
//Coco, female
//Change the Dog class so that each dog has a mother and a father.
//Add to the main method in DogTest, so that:
//Max has Lady as mother, and Rocky as father
//Coco has Molly as mother, and Buster as father
//Rocky has Molly as mother, and Sam as father
//Buster has Lady as mother, and Sparky as father
//Change the dog class to include a method fathersName that return the name of the father.
// If the father reference is null, return "Unknown". Test in the DogTest main method that it works.
//referenceToCoco.FathersName() returns the string "Buster"
//referenceToSparky.FathersName() returns the string "Unknown"
//Change the dog class to include a method boolean HasSameMotherAs(Dog otherDog). The method should return true on the call
//referenceToCoco.HasSameMotherAs(referenceToRocky). Show that the new method works in the DogTest main method.
