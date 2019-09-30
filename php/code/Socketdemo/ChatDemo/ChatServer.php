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
     * @var array $readSockets 读取连接池
     */
    private $readSockets = [];
    /**
     * @var array $writeSockets 读取连接池
     */
    private $writeSockets = [];

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
        $this->readSockets[] = $sock;
        $this->writeSockets[] = $sock;
        $this->originSocket = $sock;

        socket_set_nonblock($this->originSocket);

    }

    /**
     * 运行
     */
    public function run() {

        $except = [];
        //循环
        while( true ) {
            $read=$this->readSockets;
            $write =$this->writeSockets;
            //是否错误
            if (socket_select($read, $write, $except, null) === false) {
                echo 'socket_select() 失败原因'.socket_strerror(socket_last_error()) . "\n";
                break;
            } 
            print_r($read);
            print_r($write);
            foreach ($read as $sockId => $sock) {            
                //有新的连接
               if ($sock == $this->originSocket) {
                    if (($msgSock = socket_accept($sock)) === false) {
                        echo 'socket_accept() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
                        continue;
                    }
                    //获取用户发送的信息
                    $content = trim(socket_read($msgSock, 1024));
                    $id = uniqid();
                    $msg = "用户---($id),加入连接池\n";
                    $this->sendSingleMsg($id, $msgSock, "欢迎用户 ---(".$id.")\n");
                    //通知全部客户端
                    $this->sendAll($write, $msgSock, $msg);
                    //加入新的连接池
                    $this->readSockets[$id] = $msgSock;
                    $this->writeSockets[$id] = $msgSock;
                    echo "$id:客户端加入连接池\n";
               }
               else {
                   //接受数据 tips 客户端主动断开 检测不到 知道一直停留在read 读取是"";
                    if (($temp = @socket_read($sock, 1024)) === false) {
                        $this->closeSocket($sockId, $sock);
                        continue;
                    }
                    if ($temp == "" || $temp == "quit\n") { //客户端断开连接
                        $this->closeSocket($sockId, $sock);
                        continue;
                    }
                   //群法消息
                   $msg = '';
                   foreach ( $this->writeSockets as $k => $v) {
                       if ($sock == $v) {
                           $msg = "来自 ".$k. "的消息：\n".$temp; 
                       }
                   }
                   $this->sendAll($write, $sock, $msg);
               }
            }
            sleep(2);
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
                $this->sendSingleMsg($id, $con, $msg);
            }
        }
    }

    /**
     * 向单个客户端发送消息
     * @param socket 
     * @param string
     */
    public function sendSingleMsg($id, $sock, $msg) {
        if(@socket_write($sock, $msg, strlen($msg))===false) {
           // echo 'socket_write() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
            //echo 'socket_write() 失败原因'.socket_last_error($sock) . "\n";
            //断开连接
           if (socket_last_error($sock) == 32) {
               $this->closeSocket($id, $sock);
           }
            //@socket_close($sock);
            //unset($this->connections[$id]);
        }
    }

    /**
     * 关闭断开连接的客户端资源
     * @param string $id
     * @param resource $socket
     */
    public function closeSocket ($id, $sock) {
        socket_close($sock);
        unset($this->readSockets[$id]);
        unset($this->writeSockets[$id]);
    }

    /**
     * 清理工作
     */
    public function __destruct()
    {
        foreach ($this->readSockets as $value) {
            @socket_close($value);
        }
        socket_close($this->originSocket);
    }
}

$chatServer = new ChatServer();
$chatServer->run();