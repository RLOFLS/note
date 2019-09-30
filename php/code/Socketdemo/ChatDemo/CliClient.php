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
            if($val = trim(fgets(STDIN))) {
                 //获取消息
                if($val == "quit" ) {
                    $this->close();
                }
                if(socket_write($this->originSocket, $val."\r\n", strlen($val."\r\n")) === false) {
                    echo 'socket_write() 失败原因'.socket_strerror(socket_last_error($this->originSocket)) . "\n";
                }
                $val ='';
            }    
        }
    } 

    /**
     * 获取消息
     */
    function getMsg() {
        while (($buf = socket_read($this->originSocket,1024)) != "") {
            fwrite(STDOUT, $buf);
        }
        unset($buf);
    }

    /**
     * 退出连接
     */
    public function close() {
        if ($this->originSocket == null) {
            die ();
        }
        while ($flag = socket_recv($this->originSocket, $buf, 1024, 0)) {
            //var_dump($flag);
            fwrite(STDOUT, $buf);
        }
        fwrite(STDOUT, '退出连接'."\n");
        $str = "quit\n";
        socket_write($this->originSocket,"quit\n", strlen($str));
        socket_close($this->originSocket);    
        $this->originSocket = null;   
        die();
    }

    public function __destruct()
    {
        $this->close();
    }
}

$cliClient = new CliClient();
$cliClient->sendMsg(); 
