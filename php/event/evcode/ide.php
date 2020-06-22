<?php
$end = Ev::now() +10;

$wT = new EvTimer(2, 2, function ($w) {

    /** @var EvTimer $w */
    echo Ev::now() . ' time run' . PHP_EOL;
    $w->data = Ev::now();
});

//空闲时候事件触发
$wIde = new EvIdle(function ($w) use ($end) {
    /** @var EvTimer $wT */
    $wT = $w->data;

    if ($wT->data > $end) {
        echo  Ev::now() . ' ide stop wt !!!' . PHP_EOL;
        $wT->stop();
        $w->stop();
    }
});

$wIde->data = $wT;

Ev::run();