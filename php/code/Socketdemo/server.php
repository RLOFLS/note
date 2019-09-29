#!/usr/local/bin/php -q
<?php
$host = '127.0.0.1';
$port = 15656;

ob_implicit_flush();
set_time_limit(0);

//创建socket
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo 'socket_creat() 失败原因'.socket_strerror(socket_last_error()) . "\n";
}

//绑定端口
if (socket_bind($sock, $host, $port) === false) {
    echo 'socket_bind() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
}

//监听
if (socket_listen($sock,5) === false) {
    echo 'socket_listen() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
}

//socket_set_block($sock);

//交互
do {
    if (($msgsock = socket_accept($sock)) === false) {
        echo 'socket_accept() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
        break;
    }
    //socket_set_nonblock( $msgsock);
    //发送信息
    $msg = "\nphp server 欢迎您\n".
        "'quit' 退出，'shutdown' 关闭服务\n";
    socket_write($msgsock, $msg, strlen($msg));

    //处理交互
    do {
        if (false === ($buf = @socket_read($msgsock, 2048, PHP_NORMAL_READ))) {
            echo 'socket_read() 失败原因'.socket_strerror(socket_last_error($msgsock)) . "\n";
            break 2;
        }

        if(!$buf = trim($buf)) {
            continue;
        }

        if($buf == 'quit') {
            break;
        }

        if( $buf == 'shutdown' ) {
            socket_close($msgsock);
            break 2;
        }

        $talkback = "php: you said '$buf' .\n";
        socket_write($msgsock, $talkback, strlen($talkback));
        echo "$buf\n";
    }while(true);
    socket_close($msgsock);
}while(true);

//关闭连接
socket_close($sock);
?>

