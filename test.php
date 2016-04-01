<?php
/**
 * Created by PhpStorm.
 * User: ityike
 * Date: 16/3/26
 * Time: 14:37
 */

/*$str1 = 'hello bift!';
$str2 = 'hello beifu';
$bift = array('str1','str2');
$biftArry = compact($bift);
var_dump($biftArry);*/
/*class Ren{
    public $name;
    public $sex;
    public function __construct($n,$s)
    {
        $this->name = $n;
        $this->sex = $s;
    }

    function say(){
        echo 'hello world';
    }
}*/
/*$people = new Ren();
echo $people->say();
echo '<br/>';
$people->name = 'ityike';
$people->sex = 'man';
echo $people->name.$people->sex;*/
/*$people = new Ren('ityike','man');
echo $people->name.$people->sex;
echo '<br/>';
echo $people->say();*/

/*class A {
    public $uname;
    static $obj = NULL;

    private function __construct()
    {
        //$this->uname = $uname;
    }

    static function getObj(){
        if(is_null(self::$obj)){
            self::$obj = new A();
        }
        return self::$obj;
    }
    function getName(){
        echo $this->uname;
    }
}*/
//$aa = new A('ityike');
//$aa->getName();
//$aa = A::getObj();
//$aa->uname = 'ityike';
//echo $aa->uname;

/*class A {
    function say(){
        self::write();
    }
    function write(){
        echo "write";
    }
}

class B extends A {
    function write()
    {
        echo "write,write";
    }
}

$b = new B();
$b->write();*/

/*class Base {
    public function sayHello() {
        echo '你好,';
    }
}

trait SayWorld {
    public function sayHello() {
        parent::sayHello();
        echo '世界!';
    }
}

class MyHelloWorld extends Base {
    use SayWorld;
}

$o = new MyHelloWorld();
$o->sayHello();*/

/*class Outer
{
    private $prop = 1;
    protected $prop2 = 2;

    protected function func1()
    {
        return 3;
    }

    public function func2()
    {
        return new class($this->prop) extends Outer {
            private $prop3;

            public function __construct($prop)
            {
                $this->prop3 = $prop;
            }

            public function func3()
            {
                return $this->prop2 + $this->prop3 + $this->func1();
            }
        };
    }
}

echo (new Outer)->func2()->func3();*/

/*class Connection{
    protected $link;
    private $server,$username,$password,$db;

    public function __construct($server,$username,$password,$db)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->connect();
    }

    public function connect(){
        $this->link = mysqli_connect($this->server,$this->username,$this->password);
        mysqli_select_db($this->db,$this->link);
    }

    public function __sleep()
    {
        // TODO: Implement __sleep() method.
        return array('server','username','password','db');

    }

    public function __wakeup()
    {
        $this->connect();
    }
}*/

/*class BaseClass {
    public function test() {
        echo "BaseClass::test() called\n";
    }

    final public function moreTesting() {
        echo "BaseClass::moreTesting() called\n";
    }
}

class ChildClass extends BaseClass {
    public function moreTesting1() {
        echo "ChildClass::moreTesting() called\n";
    }
}

$yes = new ChildClass();
$yes->moreTesting();
echo '<br/>';
$yes->moreTesting1();*/

/*echo '<pre>';
class SubObject
{
    static $instances = 0;
    public $instance;

    public function __construct() {
        $this->instance = ++self::$instances;
    }

    public function __clone() {
        $this->instance = ++self::$instances;
    }
}

class MyCloneable
{
    public $object1;
    public $object2;

    function __clone()
    {

        // 强制复制一份this->object， 否则仍然指向同一个对象
        $this->object1 = clone $this->object1;
    }
}

$obj = new MyCloneable();

$obj->object1 = new SubObject();
$obj->object2 = new SubObject();

$obj2 = clone $obj;


print("Original Object:\n");
print_r($obj);

print("Cloned Object:\n");
print_r($obj2);*/


$array = array('111','222','333');
$array1 = implode(',',$array);
echo $array1;
var_dump(implode('hello', array()));













