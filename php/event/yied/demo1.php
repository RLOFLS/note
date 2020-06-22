<?php
function myGenerator(): Generator
{
    try {
        // 2. yield something back to the caller
        $twenty = yield 10;

// 4. Keep execution with new value
        var_dump($twenty);
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }

}

$gen = myGenerator();
// 1. Trigger execution
$ten = $gen->current();
$gen->throw(new Exception('exception !!!'));
// 3. Push back a value to generator
$gen->send($ten * 2);

// Output: int(20)
