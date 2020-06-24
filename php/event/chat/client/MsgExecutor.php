<?php

use UI\Executor;
use UI\Area;

class MsgExecutor extends Executor
{
    /**
     * @var Area
     */
    private $area;

    public function __construct(Area $area) {
        $this->area = $area;

        /* construct executor with infinite timeout */
        parent::__construct();
    }

    protected function onExecute() {
        $num = rand(0, 100);
        $msg = [
            'hello ' . $num,
            "hello hello tym hell" . $num,
           ];
        $this->area->setMsg($msg);

        $this->area->redraw();
    }
}