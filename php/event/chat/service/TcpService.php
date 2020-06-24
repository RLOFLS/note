<?php

class TcpService
{
    /** @var array $connections 连接 */
    private $connections = [];

    private $connNames = [];

    private $watchers = [];

    private $port;

    private $service;

    private $udpService;

    private $udpEvent;

    private $udpPort;

    private $eventBase;

    public function __construct($port, $udpPort)
    {
        $this->port = $port;
        $this->udpPort = $udpPort;
        $this->initService();
        $this->initUdpService();
    }

    /**
     * 初始udp服务
     * create on 2020/6/24
     */
    public function initUdpService()
    {
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if (!$sock) {
            die('创建create sock failed ' . socket_strerror(socket_last_error()));
        }

        $bindRet = socket_bind($sock, '127.0.0.1', $this->udpPort);
        if (!$bindRet) {
            die('bind sock failed ' . socket_strerror(socket_last_error()));
        }
        socket_set_nonblock($sock);
        $this->udpService = $sock;

    }

    /**
     * 初始tcp协议
     * create on 2020/6/24
     */
    public function initService()
    {
        $sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (!$sock) {
            die('创建create sock failed ' . socket_strerror(socket_last_error()));
        }

        $bindRet = socket_bind($sock, '127.0.0.1', $this->port);
        if (!$bindRet) {
            die('bind sock failed ' . socket_strerror(socket_last_error()));
        }

        $listenRet = socket_listen($sock);
        if (!$listenRet) {
            die('bind sock failed ' . socket_strerror(socket_last_error()));
        }
        socket_set_nonblock($sock);
        echo "service 127.0.0.1 : {$this->port} start" . PHP_EOL;

        $this->service = $sock;
        $this->connections[(int)$sock] = $sock;
        $this->connNames[(int)$sock] = 'server';
    }

    public function run()
    {
        $this->eventBase = new EventBase();
        $event = new Event($this->eventBase, $this->service, Event::READ | Event::PERSIST, [$this, 'onAccept'], $this->eventBase);
        $event->add();
        $this->watchers[(int)$this->service] = $event;
        $this->udpEvent();
        $this->eventBase->loop();
    }

    /**
     * 监控upd
     * create on 2020/6/24
     */
    public function udpEvent()
    {
        $this->udpEvent = new Event($this->eventBase, $this->udpService, Event::READ | Event::PERSIST, function ($udp) {
            $ret = socket_recvfrom($udp, $buf , 1024 , MSG_DONTWAIT, $name, $port);
            if ($ret && $ret > 0) {
                $users = implode(PHP_EOL, array_values($this->connNames));
                $ret = socket_sendto($udp, $users, strlen($users), MSG_DONTROUTE, $name, $port);
            }
        });
        $this->udpEvent->add();
    }

    /**
     * 接收新连接
     * create on 2020/6/23
     * @param $sock
     * @param $event
     * @param $eventBase
     */
    public function onAccept($sock, $event, $eventBase)
    {
        $conn = socket_accept($this->service);
        if (! $conn) {
            echo 'no new connect';
            return;
        }
        socket_set_nonblock($conn);
        $this->connections[(int)$conn] = $conn;
        $this->connNames[(int)$conn] = '用户' . (int)$conn;
        $msg = $this->getConnName((int)$this->service) . ': ' . $this->getConnName((int)$conn) . '加入聊天室';
        echo $msg . PHP_EOL;
        $this->sendMsg($msg);
        $event = new Event($eventBase, $conn, Event::READ | Event::PERSIST, [$this, 'onRead'], [(int)$conn, $eventBase]);
        $event->add();
        $this->watchers[(int)$conn] = $event;
    }

    /**
     * 读取
     * create on 2020/6/23
     * @param $sock
     */
    public function onRead($sock)
    {
        /**@var EvIo $w */
        $id = (int)$sock;
        $conn = $this->connections[$id];
        $msg = '';
        while ($ret = socket_recv($conn, $buf, 1024, MSG_DONTWAIT)) {
            $errNo = socket_last_error($sock);
            if ($errNo == 32) { //断开连接.00000
                $this->closeConn($id);
                return;
            }
            if (!$buf) {
                sleep(1);
            }
            $msg .= $buf;
        }
        if ($ret === 0) {
            $this->closeConn($id);
            return;
        }
        if ($msg === '') {
            return;
        }
        $msg = $this->getConnName($id) . ': ' . $msg;
        $this->sendMsg($msg);
    }

    /**
     * 发送信息
     * create on 2020/6/23
     * @param string $msg
     */
    public function sendMsg(string $msg = '')
    {
        foreach ($this->connections as $id => $sock) {
            if ($sock == $this->service) {
                continue;
            }
            $ret = socket_send($sock, $msg, strlen($msg), MSG_DONTROUTE);
            //socket_close($sock);
            $errNo = socket_last_error($sock);
            if ($errNo == 32) { //断开连接.00000
                $this->closeConn($id);
            }

        }
    }

    /**
     * 关闭连接
     * create on 2020/6/23
     * @param int $sock
     */
    public function closeConn(int $sock)
    {
        $msg = $this->getConnName($sock) . ":" . '离开聊天';
        $this->watchers[$sock]->del();
        unset($this->connNames[$sock]);
        unset($this->watchers[$sock]);
        unset($this->connections[$sock]);
        $this->sendMsg($msg);
        echo $msg . PHP_EOL;
    }

    private function getConnName(int $sock)
    {
        return isset($this->connNames[$sock]) ? $this->connNames[$sock] : 'undefined';
    }
}