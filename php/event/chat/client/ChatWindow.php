<?php

use UI\Window;
use UI\Control;
use UI\Size;
use UI\Executor;

/**
 * 主窗口
 * create on 2020/6/22
 * Class ChatWindow
 */
class ChatWindow extends Window
{
    protected $executors = [];

    protected function onUncaughtException(Control $control, Throwable $ex) {
        $this->error(sprintf(
            "Uncaught Exception from %s",
            get_class($control)
        ), (string) $ex);
    }

    protected function onResized() {
        $this->setSize(new Size(840, 680)); # not working
    }

    public function addExecutor(Executor $executor) {
        $this->executors[] = $executor;
    }

    protected function onClosing() {
        foreach ($this->executors as $executor) {
            $executor->kill();
        }

        $this->destroy();

        UI\quit();
    }
}