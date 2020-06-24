<?php
$address = '127.0.0.1';
$port = 9507;

$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

$ret = socket_connect($sock, $address, $port);
if (! $ret) {
    die("connect failed " . socket_strerror(socket_last_error()));
}

$str = 'hello';
$ret = socket_send($sock, $str, strlen($str), 0);
var_dump($ret);

$eventBase = new EventBase();
$event = new Event($eventBase, $sock, Event::READ | Event::PERSIST, function ($sock, $event) {
   $ret = socket_recv($sock, $buf, 1024, MSG_DONTWAIT);
   var_dump('接受数据');
   var_dump($ret);
   var_dump($buf);
});
$event->add();

//$sendBuf = '';
//$event2 = new Event($eventBase, $sock, Event::WRITE | Event::PERSIST, function ($sock, $event) {
//    var_dump('发送了一些东西');
//});
//$event2->add();

$event3 = new Event($eventBase, STDIN, Event::READ | Event::PERSIST, function ($in, $event) use ($sock) {
    $str = fgets($in);
    var_dump('STDIN');
    var_dump($str);
    var_dump('STDIN send');
    $ret = socket_send($sock, $str, strlen($str), 0);
    var_dump($ret);

});
$event3->add();
$eventBase->loop();


