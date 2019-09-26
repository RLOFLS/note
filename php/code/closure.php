<?php

class Person {
    private $name = 'tom';
}

// $person = new Person();
// $getname = Closure::bind(function (Person $person){
//     return $person->name;
// }, null,Person::class);

// echo $getname($person);

$property =new  ReflectionProperty(Person::class,'name');
$property->setAccessible(true);
echo $property->getValue(new Person);