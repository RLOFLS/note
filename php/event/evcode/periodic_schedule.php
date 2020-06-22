<?php

function reschedule_ab($w, $now)
{
    return $now + (2 - fmod($now, 2));
}

$w = new EvPeriodic(0, 0, 'reschedule_ab', function ($w) {
    echo time() . ' w second arrived!!' . PHP_EOL;
    echo 'Ev::iteration() == ' . Ev::iteration() . PHP_EOL;
    echo ' Ev::depth() = ' . Ev::depth() .PHP_EOL;
    echo ' Ev::now() = ' . Ev::now() .PHP_EOL;
    echo ' Ev::time() = ' . Ev::time() .PHP_EOL;
    /** @var EvWatcher $w */
    if (Ev::iteration() >= 3) {
        $w->stop();
    }
});

Ev::run();