<?php

class Demo {

    public static $str = 'td{font-size:9pt;line-height:18px}
    em{font-style:normal;color:#c00}
    a em{text-decoration:underline}
    cite{font-style:normal;color:green}
    .m,a.m{color:#666}
    a.m:visited{color:#606}
    .g,a.g{color:green}
    .c{color:#77c}';
    public static function test($pattern){
        preg_match($pattern, static::$str,$matchs);
        print_r($matchs);
        echo PHP_EOL.'-----------------preg_match_all-----'.PHP_EOL;
        preg_match_all($pattern, static::$str,$matchs2);
        print_r($matchs2);
    }

}

$pattern = '/\{.*\}/';
// Array
// (
//     [0] => {font-size:9pt;line-height:18px}
// )

// -----------------preg_match_all-----
// Array
// (
//     [0] => Array
//         (
//             [0] => {font-size:9pt;line-height:18px}
//             [1] => {font-style:normal;color:#c00}
//             [2] => {text-decoration:underline}
//             [3] => {font-style:normal;color:green}
//             [4] => {color:#666}
//             [5] => {color:#606}
//             [6] => {color:green}
//             [7] => {color:#77c}
//         )

// )
//分组
$pattern = '/em{(\w+)-(?1)/';
/*   
 Array
(
    [0] => em{font-style
    [1] => font
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => em{font-style
            [1] => em{text-decoration
        )

    [1] => Array
        (
            [0] => font
            [1] => text
        )

)
*/
//组命名
$pattern = '/em{(?<group>\w+)-(?P>group)/';
/* 
Array
(
    [0] => em{font-style
    [group] => font
    [1] => font
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => em{font-style
            [1] => em{text-decoration
        )

    [group] => Array
        (
            [0] => font
            [1] => text
        )

    [1] => Array
        (
            [0] => font
            [1] => text
        )

)
  */ 

//print_r(preg_replace('/{(.*?)}/','<$1>',Demo::$str));

/*
td<font-size:9pt;line-height:18px>
em<font-style:normal;color:#c00>
a em<text-decoration:underline>
cite<font-style:normal;color:green>
.m,a.m<color:#666>
a.m:visited<color:#606>
.g,a.g<color:green>
.c<color:#77c>
*/
//环视
$pattern = '/[a-z]+(?=\-style)/';
/*
Array
(
    [0] => font
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => font
            [1] => font
        )

)
*/

//每三位家一个，
/*
$str = 1234567890;
$pattern = '/(\d{3})/';
preg_match($pattern,$str,$matchs);
print_r($matchs);
print_r(preg_replace($pattern,'$1,',$str));
echo PHP_EOL;
print_r(preg_replace_callback($pattern,function ($matchs){
    return $matchs[1].',';
},$str));

Array
(
    [0] => 123
    [1] => 123
)
123,456,789,0
123,456,789,0

*/
//逆序否定环视  注意 exp
$pattern = '/(?<!font-)\b[a-z]+\b:/';
/*
Array
(
    [0] => height:
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => height:
            [1] => color:
            [2] => decoration:
            [3] => color:
            [4] => color:
            [5] => m:
            [6] => color:
            [7] => color:
            [8] => color:
        )


*/

//贪婪匹配
//$pattern = '/\-[a-z]+?/';
/*
Array
(
    [0] => -s
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => -s
            [1] => -h
            [2] => -s
            [3] => -d
            [4] => -s
        )

)
*/

//懒惰匹配
//$pattern = '/\-[a-z]+/';
/*
Array
(
    [0] => -size
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => -size
            [1] => -height
            [2] => -style
            [3] => -decoration
            [4] => -style
        )

)
*/

//匹配属性名称 排除color
//$pattern = '/[a-z\-0-9]+(?<!color)(?=:)/';
/*
Array
(
    [0] => font-size
)

-----------------preg_match_all-----
Array
(
    [0] => Array
        (
            [0] => font-size
            [1] => line-height
            [2] => font-style
            [3] => text-decoration
            [4] => font-style
            [5] => m
        )

)
*/
/*
$str = 'copy2003';
$pattern = '/\w*?(\d+)/';
preg_match($pattern, $str, $matchs);
preg_match_all($pattern, $str, $matchs2);
/*
$pattern = '/\w*(\d+)/'; 结果
$matchs=>
Array
(
    [0] => copy2003
    [1] => 3
)
$matchs2=>
Array
(
    [0] => Array
        (
            [0] => copy2003
        )

    [1] => Array
        (
            [0] => 3
        )

)
$pattern = '/\w*?(\d+)/'; 结果
$matchs=>
Array
(
    [0] => copy2003
    [1] => 2003
)
Array
(
    [0] => Array
        (
            [0] => copy2003
        )

    [1] => Array
        (
            [0] => 2003
        )

)




print_r($matchs);
print_r($matchs2);
*/
Demo::test($pattern);
/*
$str = 'sfsfsf
sfsfs 
sfsfsfsf
sfsfsf';
*/
//$pattern = '/.*/m';
/*
preg_match($pattern,$str,$matchs);
print_r($matchs);
preg_match_all($pattern,$str,$matchs);
print_r($matchs);

*/