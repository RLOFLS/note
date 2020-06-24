<?php

spl_autoload_register(function ($class_name) {
    require_once $class_name . '.php';
});

error_reporting(E_ALL);

//$service = new UdpService(9508);
$service = new TcpService(9507, 9508);

$service->run();
