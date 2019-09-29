<?php
while (true) {
    $val = trim(fgets(STDIN));

    if($val == "quit") {
        fwrite(STDOUT, '已关闭'."\n");
        die();
    }
    fwrite(STDOUT, $val."\n");
}