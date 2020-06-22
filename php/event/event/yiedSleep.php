<?php
$start = microtime(true);

$f1 = function() {
    sleep(3);
    echo 'f1 sleep 3 arrived !!!!' . PHP_EOL;
};

$f2 = function() {
    sleep(2);
    echo 'f2 sleep 2 arrived !!!!' . PHP_EOL;
};

$f3 = function() {
    sleep(1);
    echo 'f3 sleep 1 arrived !!!!' . PHP_EOL;
};

$funs = [
    $f1,
    $f2,
    $f3
];

function run(array $funs)
{
    foreach ($funs ?? [] as $f) {
        yield new T($f);
    }
}
class T
{
    public $isFished = false;
    public $cb = null;
    public $g = null;
    public $w = null;
    public function __construct($cb)
    {
        $this->cb = $cb;
    }

    public function run()
    {

        $ret  = yield call_user_func($this->cb);
        if ($ret) {
            $this->isFished = true;
        }
        var_dump($ret);
        return $ret;
    }

    public function reslove()
    {
       return $this->g->send(333);
    }
}


$w = [];
$i = 0;
foreach (run($funs) ?? [] as $task) {
    $i ++;
    $w[$i] = new EvTimer(0,0, function ($w) {
        /** @var EvTimer $w  */
        /** @var T $task */
        $task = $w->data;
        $task->w = $w;
        if (($ret = $task->run()) instanceof Generator) {
            $task->g = $ret;
        };
        if ($task->g instanceof Generator) {
            $task->reslove();
        }
        if ($task->isFished) {
            $w->stop();
        } else {
            var_dump(5);
            $w->again();
        }

    }, $task);
}


///** @var EvTimer $wT */
//foreach ($w as $wT) {
//    $wT->start();
//}

    /** @var EvTimer $wT */
    foreach ($w as $wT) {

        $wT->start();

    }
    Ev::run(Ev::RUN_NOWAIT);

Ev::run(Ev::RUN_NOWAIT);




//Ev::run();

$end = microtime(true)-$start;
echo 'use times : ' . $end .PHP_EOL;
