<?php

class P {
    public static function echoClassNmae() {
        echo get_called_class() . PHP_EOL; //后期静态绑定
        echo get_class() . PHP_EOL; 
    }
}

class C extends P {
    public static function echoClassNmae2() {
        echo get_called_class() . PHP_EOL;
        echo get_class() . PHP_EOL; 
    }
}

$c  = new C();
C::echoClassNmae();
// C
// P
C::echoClassNmae2();
// C
// C