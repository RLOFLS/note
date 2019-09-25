<?php
class Demo {

    public function hello($name) {
        echo 'hi : '.$name. PHP_EOL;
        var_dump(debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT));
    }
}

$demo = new Demo();
$demo -> hello('tom');