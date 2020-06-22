<?php

function printLine($fd, $events, $args)
{
    static $max_iteration = 0;

    $max_iteration ++;

    if ($max_iteration >= 5) {
        echo ' 5 iteration arrived !!!' . PHP_EOL;
        /** @var EventBase $eb */
        $eb = $args[0];
        $eb->exit();
    }

    echo fgets($fd);
}

$eb = new EventBase();

$fd = STDIN; //标准输入
//设置事件
$e = new Event($eb, $fd, Event::READ | Event::PERSIST, 'printLine', [$eb]);

//定时器事件
function timerCb($args)
{
    /** @var EventBase $eb */
    $eb = $args[0];
    echo 'timerCb : ' . $eb->getTimeOfDayCached() . PHP_EOL;
    /** @var Event $et */
    $et = $args[1];
    var_dump($et->addTimer(2));
}

$et = Event::timer($eb, 'timerCb', [$eb, &$et]);

//开启事件
$e->add();
$et->addTimer(2);
//开始事件循环
$eb->loop();