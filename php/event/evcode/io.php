<?php

//等待标准输入

$w = new EvIo(STDIN, Ev::READ, function ($watcher, $revents) {
    /** @var EvWatcher $watcher */
    var_dump($revents);
    $content = fgets(STDIN, 1024);
    var_dump($content);
    echo "STDIN is readable\n";
});

Ev::run(Ev::RUN_ONCE);