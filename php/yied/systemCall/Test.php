<?php
function getTaskId() {
    return new SystemCall(function(Task $task, Scheduler $scheduler) {
        $task->setSendValue($task->getTaskId());
        $scheduler->schedule($task);
    });
}

function task($max) {
    $tid = (yield getTaskId()); // <-- here's the syscall!
    for ($i = 1; $i <= $max; ++$i) {
        sleep(1);
        echo "This is task $tid iteration $i.\n";
        yield;
    }
}
spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

$start = microtime(true);
$scheduler = new Scheduler;
$scheduler->newTask(task(10));
$scheduler->newTask(task(5));
$scheduler->run();

var_dump(microtime(true) - $start); //15s