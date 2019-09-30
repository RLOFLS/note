<?php
echo "hell\n";
echo "helllalasld\n";
//ob_end_flush();
print_r(ob_get_status());
print_r(ob_get_length());

print_r(ob_get_contents());
print_r(ob_get_flush());
print_r(ob_get_clean());
echo "--------------------------------\n";
ob_start();
echo "hell\n";
echo "helllalasld\n";
// print_r(ob_get_status());
// print_r(ob_get_length());

//print_r(ob_get_contents());
//ob_clean();
//ob_end_clean();
ob_end_flush();
//ob_flush();
echo "22------------\n";
//print_r(ob_get_clean());
//print_r(ob_get_flush());
