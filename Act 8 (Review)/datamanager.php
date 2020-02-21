<?php
/**
 * Created by PhpStorm.
 * User: Jomari Garcia
 * Date: 12/13/2019
 * Time: 11:14 AM
 */
//Class
class Practice
{
    public $num; //Property
    public function __construct($num)
    {
        $this->num=$num;
    }
    function show_num()
    {
        echo $this->num;
    }
    function __destruct()
    {
        echo "Object has been destroyed";
    }
}
class Practice1 extends Practice
{
    public $num;
    function __construct($num)
    {
        parent::__construct($num);
    }
}
class ParentClass
{
    function test()
    {
        self::who();    // will output 'parent'
        $this->who();    // will output 'child'
    }

    function who()
    {
        echo 'parent<br>';
    }
}
class Data1
{
    function run()
    {

    }
}
class Data2 extends Data1
{
    function run()
    {
        print "I\n";
    }
}
class Data3 extends Data1
{
    function run()
    {
        print "am\n";
    }
}
class Data4 extends Data1
{
    function run()
    {
        print "Jomari<br>";
    }
}
/////////////////////////////////////////////////////
class Pass_DataA
{
    public function ME()
    {
        return "ME\n";
    }
}
class Pass_DataB extends Pass_DataA
{
    public function MYSELF()
    {
        return "MYSELF\n";
    }
}
class Pass_DataC extends Pass_DataB
{
    public function I()
    {
        return "I<br>";
    }
}
class RetreiveAll_Data extends Pass_DataC
{
    public function PrintALL()
    {
        echo $this->ME();
        echo $this->MYSELF();
        echo $this->I();
    }
}
/////////////////////////////////////////////////////
class AddingOfEmployee
{
    public $answer;
    public $title;
    public function setaddition($num1, $num2)
    {
        $this->answer = $num1 + $num2;
    }
    function getaddition()
    {
        echo $this->answer ."<br>";
    }
    public function  setsubtraction($num1, $num2)
    {
        $this->answer = $num1 - $num2;
    }
    function getsubtraction()
    {
        echo $this->answer ."<br>";
    }
    public function setmultiplication($num1, $num2)
    {
        $this->answer = $num1 * $num2;
    }
    function getmultiplication()
    {
        echo $this->answer ."<br>";
    }
    public function setdivision($num1, $num2)
    {
        $this->answer = $num1 / $num2;
    }
    function getdivision()
    {
        echo $this->answer ."<br>";
    }
    public function setmodulo($num1, $num2)
    {
        $this->answer = $num1 % $num2;
    }
    function getmodulo()
    {
        echo $this->answer ."";
    }
    public function firstname()
    {
        echo '<br>Jomari';
    }
    public function lastname()
    {
        echo '<br>Garcia';
    }
    public function setfirstname($firstname)
    {
        $this->title = $firstname;
    }
    function getfirstname()
    {
        echo $this->title ."";
    }
}
/////////////////////////////////////////////////////
//Inheritance (Single Level)
/*
class A
{
    public function printItem($string)
    {
        echo 'Hi : ' . $string . '\n';
    }
    public function printPHP()
    {
        echo 'I am from valuebound' . PHP_EOL;
    }
}
class B extends A
{
    public function printItem($string)
    {
        echo 'Hi: ' . $string . PHP_EOL;
    }
    public function printPHP()
    {
        echo "I am from ABC";
    }
}
*/
//Inheritance (Multi Level)
/*
class A2
{
    public function myage()
    {
        return  "age is 80\n";
    }
}
class B2 extends A2
{

    public function mysonage()
    {
        return "age is 50\n";
    }
}
class C2 extends B2
{
    public function mygrandsonage()
    {
        return  "age is 20\n";
    }
    public function myHistory()
    {
        echo "Class A " .$this->myage();
        echo "Class B ".$this-> mysonage();
        echo "Class C " . $this->mygrandsonage();
    }
}
*/
//Polymorphism
/*
class Shap
{
    function draw(){}
}
class Circle extends Shap
{
    function draw()
    {
        print "<br>Circle has been drawn.</br>";
    }
}
class Triangle extends Shap
{
    function draw()
    {
        print "Triangle has been drawn.</br>";
    }
}
class Ellipse extends Shap
{
    function draw()
    {
        print "Ellipse has been drawn.";
    }
}

$Val=array(2);

$Val[0]=new Circle();
$Val[1]=new Triangle();
$Val[2]=new Ellipse();

for($i=0;$i<3;$i++)
{
    $Val[$i]->draw();
}
*/
?>
