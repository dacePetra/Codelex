<?php

abstract class Shape
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract protected function getArea(): float;
}

class Square extends Shape
{
    protected int $sideLength;

    public function __construct(string $name, int $sideLength)
    {
        parent::__construct($name);
        $this->sideLength = $sideLength;

    }

    public function getArea(): float
    {
        return pow($this->sideLength, 2);
    }
}

class Triangle extends Shape
{
    protected int $base;
    protected int $height;

    public function __construct(string $name, int $base, int $height)
    {
        parent::__construct($name);
        $this->base = $base;
        $this->height = $height;
    }

    public function getArea(): float
    {
        return $this->base * $this->height * 0.5;
    }
}

class Circle extends Shape
{
    protected int $radius;

    public function __construct(string $name, int $radius)
    {
        parent::__construct($name);
        $this->radius = $radius;
    }

    public function getArea(): float
    {
        return floor(M_PI * pow($this->radius, 2));
    }
}

class AllShapes
{
    private array $all = [];

    public function add(Shape $name): void
    {
        $this->all[] = $name;
    }

    public function getShapes(): array
    {
        return $this->all;
    }

}

//$square = new Square("Square", 5);
//$triangle = new Triangle("Triangle", 3, 4);
//$circle = new Circle("Circle", 6);

//$all = new AllShapes;
//$all->add($square);
//$all->add($triangle);
//$all->add($circle);
//$sum = 0;
//
//foreach ($all->getShapes() as $item) {
//    echo $item->getName() . " area: " . $item->getArea() . PHP_EOL;
//    $sum += $item->getArea();
//}
//echo "Sum of all shapes: " . $sum . PHP_EOL;


$all = new AllShapes;

while (true) {

    echo '[1] Enter new shape and get area' . PHP_EOL;
    echo '[2] Get sum of all areas of shapes' . PHP_EOL;
    echo '[Any] Exit' . PHP_EOL;

    $option = (int)readline('Select an option: ');
    echo PHP_EOL;

    switch ($option) {
        case 1:
            echo '[1] Square' . PHP_EOL;
            echo '[2] Triangle' . PHP_EOL;
            echo '[3] Circle' . PHP_EOL;
            echo '[Any] Exit' . PHP_EOL;
            $newShape = readline("Choose shape: ");
            echo PHP_EOL;

            switch ($newShape) {
                case 1:
                    $name = readline("Enter name of your square: ");
                    $sideLength = (int)readline("Enter side length in cm: ");
                    $square = new Square($name, $sideLength);
                    echo $square->getName() . " area :" . $square->getArea() . PHP_EOL . PHP_EOL;
                    $all->add($square);
                    break;
                case 2:
                    $name = readline("Enter name of your triangle: ");
                    $base = (int)readline("Enter base in cm: ");
                    $height = (int)readline("Enter height in cm: ");
                    $triangle = new Triangle($name, $base, $height);
                    echo $triangle->getName() . " area :" . $triangle->getArea() . PHP_EOL . PHP_EOL;
                    $all->add($triangle);
                    break;
                case 3:
                    $name = readline("Enter name of your circle: ");
                    $radius = (int)readline("Enter radius in cm: ");
                    $circle = new Circle($name, $radius);
                    echo $circle->getName() . " area :" . $circle->getArea() . PHP_EOL . PHP_EOL;
                    $all->add($circle);
                    break;
                default:
                    break;
            }
            break;

        case 2:
            $sum = 0;
            foreach ($all->getShapes() as $item) {
                echo $item->getName() . " area: " . $item->getArea() . PHP_EOL;
                $sum += $item->getArea();
            }
            echo "Sum of all shapes: " . $sum . PHP_EOL . PHP_EOL;
            break;
        default:
            echo "Thank you for using this program." . PHP_EOL;
            return false;
    }
}
