<?php

function xrang($start, $end, $step = 1) {
    for ($i = $start; $i <= $end; $i += $step) {
        yield $i;
    }
}

$ret = xrang(1, 10);
print_r($ret);


echo($ret->current()).PHP_EOL;
echo($ret->current()).PHP_EOL;
$ret->next();
echo($ret->current()).PHP_EOL;
$ret->rewind();