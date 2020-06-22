<?php
echo time() . 'arrived!!' . PHP_EOL;
// 间隔2秒
$w = new EvPeriodic(0, 2 , null, function ($w) {
    echo time() . ' w second arrived!!' . PHP_EOL;
    echo 'Ev::iteration() == ' . Ev::iteration() . PHP_EOL;
   /** @var EvWatcher $w */
   if (Ev::iteration() >= 3) {
       $w->stop();
   }
});

//$w2 = new EvPeriodic(2, 1 , null, function ($w) {
//    echo time() . ' w2 second arrived!!' . PHP_EOL;
//    echo 'Ev::iteration() == ' . Ev::iteration() . PHP_EOL;
//    /** @var EvWatcher $w */
//    if (Ev::iteration() >= 3) {
//        $w->stop();
//    }
//});

Ev::run();

// offset: time()+4
// interval = 0, reschedule_cb = null 使用 offset 只执行1次
// interval != 0, reschedule_cb = null 间隔 interval 执行， 忽略offset 设置
// reschedule_cb ！= null 忽略 offset , interval 设置

