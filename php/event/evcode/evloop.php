<?php

/** @var EvLoop $loop */
$loop = EvLoop::defaultLoop();

$wT = $loop->timer(2, 0, function ($w) {
    /** @var EvWatcher $w */

    echo 'evloop timer ' . PHP_EOL;
});
Ev::run();
