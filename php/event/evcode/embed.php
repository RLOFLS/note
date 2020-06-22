<?php

//var_dump(Ev::embeddableBackends());
//var_dump(Ev::recommendedBackends());
//
//var_dump(Ev::embeddableBackends() & Ev::recommendedBackends());
/** @var EvLoop $loop_hi */
$loop_hi = EvLoop::defaultLoop();
$loop_lo = NULL;
$embed   = NULL;

/*
* See if there is a chance of getting one that works
* (flags' value of 0 means autodetection)
*/
$loop_lo = Ev::embeddableBackends() & Ev::recommendedBackends()
    ? new EvLoop(Ev::embeddableBackends() & Ev::recommendedBackends())
    : 0;

$wt = $loop_hi->timer(2, 2, function () use ($loop_hi) {
    /** @var EvWatcher $w */
    echo time() . ' loop_hi timer' . PHP_EOL;
    if ($loop_hi->iteration >= 3) {
        $loop_hi->stop();
    }
});

if ($loop_lo) {
    var_dump(121);
    //嵌入到 loop_lo
    $embed = new EvEmbed($loop_hi, function () {
        echo ' embed ' . PHP_EOL;
    });

} else {
    $loop_lo = $loop_hi;
}
$embed2 = new EvEmbed($loop_hi, function () {
   echo 'loop hi embed !!!' . PHP_EOL;
});
$embed3 = new EvEmbed($loop_lo, function () {
    echo 'loop lo embed !!!' . PHP_EOL;
});

$wlot = $loop_lo->timer(2, 3, function () use ($loop_lo) {
    /** @var EvWatcher $w */
    echo time() . ' loop_lo timer' . PHP_EOL;
    if ($loop_lo->iteration >= 3) {
        $loop_lo->stop();
    }
});

//$loop_lo->run();

//执行默认事件循环
Ev::run();



