<?php
$start = microtime(true);

function f1()
{
    sleep(3);
    echo 'f1 sleep 3 arrived !!!!' . PHP_EOL;
}

function f2()
{
    sleep(2);
    echo 'f2 sleep 2 arrived !!!!' . PHP_EOL;
}

function f3()
{
    sleep(1);
    echo 'f3 sleep 1 arrived !!!!' . PHP_EOL;
}

$funs = [
    'f1',
    'f2',
    'f3'
];

foreach ($funs ?? [] as $f) {
    if ($f instanceof Closure) {
        $f();
    } else {
        call_user_func($f);
    }
}

$end = microtime(true)-$start;
echo 'use times : ' . $end .PHP_EOL;