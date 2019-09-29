<?php
set_time_limit(0);
class ChatServer {

    /**
     * @var string $domain
     */
    private $domain = '127.0.0.1';

    /**
     * @var int $port
     */
    private $port;

    /**
     * @var array $connections 连接池
     */
    private $connections = [];

    /**
     * @var socket resourse 
     */
    private $originSocket;

    
    public function __construct($domain = '127.0.0.1',$port = 15656) {
        $this->domain = $domain;
        $this->port = $port;
        //创建socket
        if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            echo 'socket_creat() 失败原因'.socket_strerror(socket_last_error()) . "\n";
        }
        //绑定端口
        if (socket_bind($sock, $domain, $port) === false) {
            echo 'socket_bind() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
        }
        //监听
        if (socket_listen($sock) === false) {
            echo 'socket_listen() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
        }
        $this->connections[] = $sock;
        $this->originSocket = $sock;

    }

    /**
     * 运行
     */
    public function run() {

        $sockets[]=$this->originSocket;  
        $write = [];
        $except = [];
        //循环
        while( true ) {
            $changes=$sockets;
            //是否错误
            if (socket_select($changes, $write, $except, null) === false) {
                echo 'socket_select() 失败原因'.socket_strerror(socket_last_error()) . "\n";
                break;
            } 
            foreach ($changes as $sock) {
                //有新的连接
               if ($sock == $this->originSocket) {
                    if (($msgSock = socket_accept($sock)) === false) {
                        echo 'socket_accept() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
                    }
                    //获取用户发送的信息
                    $content = trim(socket_read($msgSock, 1024, PHP_NORMAL_READ));
                    $id = uniqid();
                    $msg = "用户---($id),加入连接池\r\n";
                    $this->sendSingleMsg('$idwelcome', $msgSock, "欢迎用户 ---(".$id.")\n");
                    //通知全部客户端
                    $this->sendAll($sockets, $msgSock, $msg);
                    //加入新的连接池
                    $sockets[$id] = $msgSock;
                    echo "$id:客户端加入连接池\r\n";
               }
               else {
                   //接受数据
                   socket_recv($sock, $buf, 1024, 0);
                   //群法消息
                   $msg = '';
                   foreach ($sockets as $k => $v) {
                       if ($sock == $v) {
                           $msg = "来自 ".$k. "的消息：\r\n".$buf; 
                       }
                   }
                   $this->sendAll($sockets, $sock, $msg);
               }
            }
        }
    }

    /**
     * 向所有客户端发送消息
     * @param array $connections socket连接池
     * @param socket resourser
     * @param string $msg
     */
    public function sendAll($connections, $sock, $msg){
        foreach( $connections as $id => $con) {
            if($con != $sock && $con != $this->originSocket) {
                $this->sendSingleMsg('$idalll', $con, $msg);
            }
        }
    }

    /**
     * 向单个客户端发送消息
     * @param socket 
     * @param string
     */
    public function sendSingleMsg($id, $sock, $msg) {
        echo $id.PHP_EOL;
        if(@socket_write($sock, $msg, strlen($msg))===false) {
            echo 'socket_write() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
            //@socket_close($sock);
            //unset($this->connections[$id]);
        }
    }


    /**
     * 清理工作
     */
    public function __destruct()
    {
        foreach ($this->connections as $value) {
            @socket_close($value);
        }
    }
}

$chatServer = new ChatServer();
$chatServer->run();