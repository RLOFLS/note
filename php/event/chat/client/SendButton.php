<?php

use UI\Controls\Button;
use UI\Controls\MultilineEntry;

class SendButton extends Button
{
    /** @var MultilineEntry $sendEntry */
    private $sendEntry;

    /** @var TcpClient $tcpClient */
    private $tcpClient;

    public function __construct(string $text, MultilineEntry $entry, $tcpClient)
    {
        parent::__construct($text);
        $this->sendEntry = $entry;
        $this->tcpClient = $tcpClient;
    }

    public function onClick() {
        $msg = $this->sendEntry->getText();
        $this->sendEntry->setText('');
        $ret = $this->tcpClient->send($msg);
    }
}