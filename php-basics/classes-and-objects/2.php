<?php
class Point
{
    public int $x;
    public int $y;
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    public function printPoint():string
    {
        return "(" . $this->x . ", " . $this->y . ")" . PHP_EOL;
    }
    public function swapPoints(Point $point1, Point $point2):string
    {
        $oldx = $point1->x;
        $oldy = $point1->y;
        $point1->x = $point2->x;
        $point1->y = $point2->y;
        $point2->x = $oldx;
        $point2->y = $oldy;
        return "Points have been swapped." . PHP_EOL;
    }
}
$p1 = new Point(5, 2);
$p2 = new Point(-3, 6);
echo $p1->printPoint();
echo $p2->printPoint();
echo $p1->swapPoints($p1, $p2);
echo "(" . $p1->x . ", " . $p1->y . ")" . PHP_EOL;
echo "(" . $p2->x . ", " . $p2->y . ")" . PHP_EOL;

//Exercise #2
//Write a method named swapPoints that accepts two Points as parameters and swaps their x/y values.
//
//Consider the following example code that calls swapPoints:
//
//$p1 = new Point(5, 2);
//$p2 = new Point(-3, 6);
//swapPoints(p1, p2);
//echo "(" . p1.x . ", " . p1.y . ")";
//echo "(" . p2.x . ", " . p2.y . ")";
//The output produced from the above code should be:
//
//(-3, 6)
//(5, 2)