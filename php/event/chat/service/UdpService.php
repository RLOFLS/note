<?php

class UdpService
{

    private $connections = [];

    private $port;

    private $service;

    public function __construct($port)
    {
        $this->port = $port;
        $this->initUdpService();
    }

    public function initUdpService()
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if (!$sock) {
            die( '创建create sock failed ' . socket_strerror(socket_last_error($sock)));
        }

        $bindRet = socket_bind($sock, '127.0.0.1', $this->port);
        if (! $bindRet) {
            die( 'bind sock failed ' . socket_strerror(socket_last_error($sock)));
        }

        socket_set_nonblock($sock);
        echo "service 127.0.0.1 : {$this->port} start" . PHP_EOL;

        $this->service = $sock;
        $this->connections[$this->port] = '127.0.0.1';
    }

    public function run()
    {

        while (true) {
            $name = '';
            $port = 0;
            $buf = '';
            $msg = '';
            $ret = socket_recvfrom($this->service, $buf , 1024 , MSG_DONTWAIT, $name, $port);
            if (! $buf) { sleep(1);}
            $msg .= $buf;
            if ($port) {
                if (! isset($this->connections[$port])) {
                    $this->connections[$port] = $name;
                    $msg2 = $this->getConnName($port) .':加入聊天室';
                    $this->sendMsg($msg2);
                    echo $msg2 . PHP_EOL;
                }
                $msg = $this->getConnName($port) . ':' . $msg;
                $this->sendMsg($msg);
            }

        }

    }

    /**
     * create on 2020/6/23
     * @param string $msg
     * @param string $type
     */
    public function sendMsg(string $msg = '')
    {
        foreach ($this->connections as $port => $name) {
            if ($port == $this->port) {
                continue;
            }
            //$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
            $len = strlen($msg);
            //$ret = socket_sendto($sock, $msg, $len, 0, $name, $port);
            $sock = $this->service;
            //udp 无法判断否成功接口
            $ret = socket_sendto($sock, $msg, strlen($msg), MSG_DONTROUTE, $name, $port);
            if (! $ret) {
                echo $this->getConnName($port) . ' :socket_sendto sock failed ' . socket_strerror(socket_last_error($sock)) . PHP_EOL;
            }
            //socket_close($sock);
            $errNo = socket_last_error();
            if ($errNo == SO_BROADCAST) { //断开连接.00000
                $this->closeConn($port);
            }
        }
    }

    /**
     * create on 2020/6/23
     * @param $port
     */
    public function closeConn($port)
    {
        $msg = $this->getConnName($port) . ":" . '离开聊天';
        unset($this->connections[$port]);
        $this->sendMsg($msg);
        echo $msg . PHP_EOL;
    }

    private function getConnName(int $sock)
    {
        return isset($this->connections[$sock]) ? $this->connections[$sock] . ':' . $sock : 'undefined';
    }
}