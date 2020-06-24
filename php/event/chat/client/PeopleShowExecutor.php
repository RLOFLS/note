<?php

use UI\Executor;
use UI\Area;
use UI\Window;

use UI\Controls\MultilineEntry;

class PeopleShowExecutor extends Executor
{
    /**
     * @var MultilineEntry
     */
    private $multi;

    /** @var Window $win */
    private $win;

    public function __construct(MultilineEntry $multi, Window $win) {
        $this->multi = $multi;
        $this->win = $win;
        /* construct executor with infinite timeout */
        parent::__construct();
    }

    protected function onExecute() {
        $updClient = new UdpClient($this->win);
        $ret = $updClient->run($this->multi);
        if ($ret === 'kill') {
            $this->kill();
        }
    }
}