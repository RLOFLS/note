<?php

echo '开始连接tcp/ip'.PHP_EOL;

$serverHost = '127.0.0.1';
$serverPort = 15656;

//创建socket
if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
    echo 'socket_creat() 失败原因'.socket_strerror(socket_last_error()) . "\n";
} else {
    echo "socket_creat() OK \n";
}

//连接
$result = socket_connect($sock, $serverHost, $serverPort);
if ($result === false) {
    echo 'socket_connect() 失败原因'.socket_strerror(socket_last_error($sock)) . "\n";
} else {
    echo "socket_connect() OK \n";
}

$in = "hi\r\nhi\r\n";
$in .= "我叫tom\r\n";
$in .= "quit\r\n";
$out = '';

echo "Sending ...";
socket_write($sock, $in, strlen($in));
echo "OK.\n";

echo "Reading response:\n\n";
while ($out = @socket_read($sock, 2048,PHP_NORMAL_READ)) {
    echo $out;
}
echo "关闭socket";
socket_close($sock);
echo "OK.\n\n";
?>