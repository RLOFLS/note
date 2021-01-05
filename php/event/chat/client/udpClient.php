<?php

use UI\Window;
use UI\Controls\MultilineEntry;

class UdpClient
{
    private $address = '127.0.0.1';

    private $port = 9508;

    private $chatWin;

    private $sock;

    public function __construct(Window $chatWin)
    {
        $this->chatWin = $chatWin;
        $this->init();
    }

    /**
     * run
     * create on 2020/6/24
     * @param MultilineEntry $multiEntry
     * @return string|void
     */
    public function run(MultilineEntry $multiEntry)
    {
        $send = 'people';
        $ret = socket_send($this->sock, $send, strlen($send), MSG_DONTROUTE);
        $msg = '';
        $ret = socket_recv($this->sock, $buf, 1024, MSG_WAITALL);
        $msg .= $buf;
        if ($ret === 0) {
            return 'kill';
        }
        if ($msg === '') {
            return $this->close();
        }
        $multiEntry->setText($msg);
        return $this->close();

    }

    public function close()
    {
       socket_close($this->sock);
       return;
    }

    /**
     * 初始化
     * create on 2020/6/2
     */
    private function init()
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if (! $sock) {
            $this->chatWin->error('socket create failed', socket_strerror(socket_last_error()));
            return;
        }

        $ret = socket_connect($sock, $this->address, $this->port);
        if (! $ret) {
            $this->chatWin->error('socket connect failed', socket_strerror(socket_last_error()));
            $this->close();
            return;
        }
        //socket_set_nonblock($sock);
        $this->sock = $sock;
    }
}
