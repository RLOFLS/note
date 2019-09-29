<?php
class CliClient {
    /**
     * @var string $domain
     */
    private $domain = '127.0.0.1';

    /**
     * @var int $port
     */
    private $port;

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
        if (socket_connect($sock, $domain, $port) === false) {
            echo 'socket_connect() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
        }
        $this->originSocket = $sock;
        socket_set_nonblock( $this->originSocket);
        echo "连接成功,输入“quit”退出\n";
        socket_write($this->originSocket, "HI\r\n", strlen("HI\r\n"));
    }

    /**
     * 发送消息
     */
    public function sendMsg() {
        while (true) {
           //$this->getMsg();
           //echo 1;
            if($val = trim(fgets(STDIN))) {
                 //获取消息
                fwrite(STDOUT, "-----".$val."----\r\n");
                if($val == "quit" ) {
                    $this->close();
                }
                //if($val == "get") {
                    $this->getMsg();
                    //continue;
                //}
                //fwrite(STDOUT, "client:".$val."\r\n");
                if(socket_write($this->originSocket, $val."\r\n", strlen($val."\r\n")) === false) {
                    echo 'socket_write() 失败原因'.socket_strerror(socket_last_error($this->originSocket)) . "\n";
                }
                // if(socket_send($this->originSocket, $val."\r\n", strlen($val."\r\n"),0) === false) {
                //     echo 'socket_write() 失败原因'.socket_strerror(socket_last_error($this->originSocket)) . "\n";
                // }
                //echo '111';
                $val ='';
            }
            
            
        }
    } 

    /**
     * 获取消息
     */
    function getMsg() {
        // while ($out = socket_read($this->originSocket, 2048,PHP_NORMAL_READ)) {
        //     if (!$out) {
        //         break;
        //     }
        //     fwrite(STDOUT, $out);
        //     echo 'reading'.PHP_EOL;
        // }
        while ($flag = socket_recv($this->originSocket, $buf, 1024, 0)) {
           // var_dump($flag);
            fwrite(STDOUT, $buf);
        }
        //fwrite(STDOUT, $buf);
        //echo 'reading'.PHP_EOL;
        unset($buf);
        //echo '111122';
    }

    /**
     * 退出连接
     */
    public function close() {
        while ($flag = socket_recv($this->originSocket, $buf, 1024, 0)) {
            //var_dump($flag);
            fwrite(STDOUT, $buf);
        }
        fwrite(STDOUT, '退出连接'."\n");
        socket_shutdown($this->originSocket);
        @socket_close($this->originSocket);       
        die();
    }

    public function __destruct()
    {
        @socket_close($this->originSocket);
    }
}

$cliClient = new CliClient();
$cliClient->sendMsg();