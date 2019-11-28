<?php
function gen() {
    yield 'foo';
    yield 'bar';
}
 
$gen = gen();
print_r($gen->current());
print_r($gen->send('something'));
print_r($gen->current());