<?php

$address = '127.0.0.1';
$port = 9508;

$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

$ret = socket_connect($sock, $address, $port);

if (! $ret) {
    socket_close($sock);
    die('socket_connect failed ' . socket_strerror(socket_last_error()));
}
$str = 'hello';
$ret = socket_send($sock, $str, strlen($str), 0);


$ret = socket_recv($sock, $msg, 1024, MSG_WAITALL);
var_dump($msg);
var_dump(socket_strerror(socket_last_error($sock)));
//socket_recv($sock, $msg, 1024, MSG_WAITALL);
//var_dump($msg);
//var_dump(socket_strerror(socket_last_error($sock)));

socket_close($sock);