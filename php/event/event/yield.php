<?php

function G1()
{
    $i = 3;
    while ($i--)
    {
        var_dump($i);
        yield $i;
    }

    return 110;
}

function G2()
{
    $return = yield from G1();
    var_dump($return);
}

foreach (G2() as $item)
{

}
