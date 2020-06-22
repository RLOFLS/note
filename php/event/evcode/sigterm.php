<?php
$w = new EvSignal(SIGTERM, function ($watcher) {
    echo "SIGTERM received\n";
    $watcher->stop();
});

Ev::run();


//kill -15 22891 传递进程信号