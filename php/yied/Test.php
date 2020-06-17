<?php

function task1() {
    for ($i = 1; $i <= 10; ++$i) {
        echo "This is task 1 iteration $i.\n";
        sleep(1);
        yield;
    }
}
function task2() {
    for ($i = 1; $i <= 5; ++$i) {
        echo "This is task 2 iteration $i.\n";
        sleep(1);
        yield;
    }
}
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

$start = microtime(true);
$scheduler = new Scheduler();
$scheduler->newTask(task1());
$scheduler->newTask(task2());
$scheduler->run();

var_dump(microtime(true) - $start); //15s