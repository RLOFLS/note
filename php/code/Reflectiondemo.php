<?php

class Student {

    public $name;
    private $age;
    private $gender;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * 设置姓名
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * 获取姓名
     */
    public function getName(){
        return $this->name;
    }

    /**
     * 获取年龄
     */
    public function getAge() {
        return $this->age;
    }
}

class PrintClass {

    public static function printC($className) {
        $obj = new  ReflectionClass($className);
        $instance = $obj->newInstance('tty');
        //获取类属性
        $properties = $obj->getProperties(); //返回属性对性数组
        foreach ($properties as $property ){
            echo implode(' ',Reflection::getModifierNames($property->getModifiers()))   . ' ' . $property->getName();
            if ($property->isPublic() && $val = $property->getValue($instance)) {
                echo ' = ' . $val . ' ;'.PHP_EOL;
            } else {
                echo  ' ;'.PHP_EOL;
            }
        }

        //打印方法
        $methods = $obj->getMethods();
        foreach ($methods as $method) {
            echo implode(' ', Reflection::getModifierNames($method->getModifiers())) .' function ' . $method->name . '{ ... }' .PHP_EOL;
        }
    }

}
PrintClass::printC(get_class(new Student('tym')));