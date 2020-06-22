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

function run(array $funs)
{
    foreach ($funs ?? [] as $f) {
        if ($f instanceof Closure) {
            yield $f();
        } else {
            yield call_user_func($f);
        }
    }
}

/** @var Generator $i */
$i = run($funs);
foreach ($i as $f) {
   event($f);
}

function event($f) {
    $w = new EvTimer(0, 0, function ($w) use ($f) {
        $f;
        /** @var EvTimer $w */
    });
}

Ev::run();

$end = microtime(true) - $start;
echo 'use times : ' . $end . PHP_EOL;