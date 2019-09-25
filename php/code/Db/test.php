<?php

$current_rul = __DIR__;
define("ROOT_URL", dirname(__DIR__));

spl_autoload_register(function ($class_name) {
    require_once ROOT_URL .'/' . str_replace('\\','/', $class_name)  . '.php';
});

$factory = new Db\DbFactory();
$db = $factory::factory('Mysql');
//var_dump($db);die;
$sql = 'select * from user limit 10';
print_r($db->query($sql));