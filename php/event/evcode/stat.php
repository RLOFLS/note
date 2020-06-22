<?php
$root = __DIR__;
//监控文件改变状态
$w = new EvStat($root . "/statLog", 8, function ($w) {
    echo "./statLog changed\n";

    $attr = $w->attr();
    if ($attr['nlink']) {
        printf("Current size: %ld\n", $attr['size']);
        printf("Current atime: %ld\n", $attr['atime']);
        printf("Current mtime: %ld\n", $attr['mtime']);
    } else {
        fprintf(STDERR, "`messages` file is not there!");
        $w->stop();
    }
});

Ev::run();
