<?php
$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($sock, '127.0.0.1', '12346');
socket_listen($sock);
socket_set_nonblock($sock);
var_dump($sock);

$w = new EvIo($sock, Ev::READ, function ($w) use ($sock) {
    var_dump($w);
});

Ev::run();