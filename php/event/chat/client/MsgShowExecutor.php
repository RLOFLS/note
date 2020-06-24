<?php

use UI\Executor;
use UI\Area;

use UI\Controls\MultilineEntry;

class MsgShowExecutor extends Executor
{
    /**
     * @var MultilineEntry
     */
    private $multi;

    /** @var TcpClient $tcpClient */
    private $tcpClient;

    public function __construct(MultilineEntry $multi, $tcpClient) {
        $this->multi = $multi;
        $this->tcpClient = $tcpClient;

        /* construct executor with infinite timeout */
        parent::__construct();
    }

    protected function onExecute() {
        $ret = $this->tcpClient->onRead($this->multi);
        if ($ret === 'kill') {
            $this->kill();
        }
    }
}