<?php

class MagicMethod {

    public $name;
    public $age;

    public function __construct($name = 'tym') {
        $this->name = $name;
    }
    public function __sleep() {
        return ['name'];  //age 数据将不会序列化
    }

    public function __wakeup() {
        $this->age = 12;
    }

    /**
     * 当以函数的方式调用对象时候
     */
    public function __invoke($arguments)
    {   
        var_dump($arguments);
    }

    /**
     * 对象被var_export () 时候被调用
     */
    public static function __set_state($an_array) // As of PHP 5.1.0
    {
        $obj = new MagicMethod;
        $obj->name = $an_array['name'].'-name';
        $obj->age = $an_array['age'].'-name';
        return $obj;
    }

    // public function __debugInfo()
    // {
    //     return ['gender' => 'male'];
    // }

    public function __destruct()
    {
        echo 'destruct';
    }

    public function __clone()
    {
        echo 'cloned'.PHP_EOL;
    }
}

$obj = new MagicMethod('age');
// $obj->age = 12;
// var_dump($obj);
// $str = serialize($obj);
// $obj2 =  unserialize($str);
// var_dump($obj2);

//$obj(['asda','adada']);


// $obj->name = 'asda';
// $obj->age = 22;
// eval('$b = ' . var_export($obj, true) . ';'); 
// var_dump($b);
// object(MagicMethod)#2 (2) {
//     ["name"]=>
//     string(9) "asda-name"
//     ["age"]=>
//     string(7) "22-name"
//   }
$obj->name = 'tty1';
$obj2 = clone $obj;
//test __debuginfo()
$obj2->name = 'tty2';
var_dump($obj); 
var_dump($obj2); 
// object(MagicMethod)#1 (1) {
//     ["gender"]=>
//     string(4) "male"
//   }