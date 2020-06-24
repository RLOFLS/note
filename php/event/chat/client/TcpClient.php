<?php

use UI\Window;
use UI\Controls\MultilineEntry;

class TcpClient
{
    private $address = '127.0.0.1';

    private $port = 9507;

    private $chatWin;

    private $sock;

    public function __construct(Window $chatWin)
    {
        $this->chatWin = $chatWin;
        $this->init();
    }

    public function close()
    {
       socket_close($this->sock);
       $this->sock = null;
    }

    /**
     * 读取
     * create on 2020/6/24
     * @param MultilineEntry $multiEntry
     * @return string|void
     */
    public function onRead(MultilineEntry $multiEntry)
    {
        if (! $this->sock) {
            $this->chatWin->error('error', '服务未连接');
            return 'kill';
        }
        $msg = '';
        $ret = socket_recv($this->sock, $buf, 1024, MSG_DONTWAIT);
        if ($ret === 0) {
            $this->chatWin->error('error', '服务器已断开');
            $this->close();
            return 'kill';
        }
        $msg .= $buf;
        if ($msg === '') {
            return;
        }
        $multiEntry->append($buf);
        $multiEntry->append(PHP_EOL);
        return;
    }

    /**
     * 发送信息
     * create on 2020/6/24
     * @param $msg
     * @return false|int|string|void
     */
    public function send($msg)
    {
        if (! $this->sock) {
            $this->chatWin->error('error', '服务未连接');
            return;
        }
        $ret = socket_send($this->sock, $msg, strlen($msg), 0);
        if ($ret === 0) {
            $this->close();
            return 'kill';
        }
        return $ret;
    }

    /**
     * 初始化
     * create on 2020/6/24
     */
    private function init()
    {
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (! $sock) {
            $this->chatWin->error('socket create failed', socket_strerror(socket_last_error()));
            return;
        }

        $ret = socket_connect($sock, $this->address, $this->port);
        if (! $ret) {
            $this->chatWin->error('socket connect failed', socket_strerror(socket_last_error()));
            return;
        }
        $this->sock = $sock;
    }
}
