<?php

include '../vendor/autoload.php';

$start = microtime(true);


$v = \Amp\Promise\wait(\Amp\ParallelFunctions\parallelMap([100,100,100], function ($n) {
    echo 'f berfore ' . $n . ' arrived !!!' . PHP_EOL;
    sleep($n);
    echo 'f sleep ' .$n . ' arrived !!!!' . PHP_EOL;
    return $n;
}));
var_dump($v);


$end = microtime(true) - $start;
echo 'use times : ' . $end . PHP_EOL;