<?php

echo time() . PHP_EOL;
$wCheck = new EvCheck(function ($w) {
    echo 'check !!' . PHP_EOL;
    /** @var EvWatcher $w */
}, null, Ev::MAXPRI);

$wPrepare = new EvPrepare(function () {
    echo 'perpare !!!' . PHP_EOL;
});


$wT = new EvTimer(2, 0, function () {
    echo time() . PHP_EOL;
    echo "evTimer " . PHP_EOL;
});

Ev::run();