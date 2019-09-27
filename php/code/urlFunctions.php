<?php

/**获取头部 */
print_r(get_headers('https://www.baidu.com'));
/*
 Array
(
    [0] => HTTP/1.0 200 OK
    [1] => Accept-Ranges: bytes
    [2] => Cache-Control: no-cache
    [3] => Content-Length: 14722
    [4] => Content-Type: text/html
    [5] => Date: Fri, 27 Sep 2019 03:17:57 GMT
    [6] => Etag: "5d7f08a7-3982"
    [7] => Last-Modified: Mon, 16 Sep 2019 03:59:35 GMT
    [8] => P3p: CP=" OTI DSP COR IVA OUR IND COM "
    [9] => Pragma: no-cache
    [10] => Server: BWS/1.1
    [11] => Set-Cookie: BAIDUID=15E543B98BF763A530E238B1066B3B57:FG=1; expires=Thu, 31-Dec-37 23:55:55 GMT; max-age=2147483647; path=/; domain=.baidu.com
    [12] => Set-Cookie: BIDUPSID=15E543B98BF763A530E238B1066B3B57; expires=Thu, 31-Dec-37 23:55:55 GMT; max-age=2147483647; path=/; domain=.baidu.com
    [13] => Set-Cookie: PSTM=1569554277; expires=Thu, 31-Dec-37 23:55:55 GMT; max-age=2147483647; path=/; domain=.baidu.com
    [14] => Vary: Accept-Encoding
    [15] => X-Ua-Compatible: IE=Edge,chrome=1
)
 */

 //获取文件meta信息
 print_r(get_meta_tags('https://baidu.com'));

 //拼接query

 $data = array('foo'=>'bar',
              'baz'=>'boom',
              'cow'=>'阿的萨milk',
              'php'=>'hypertext processor');

echo http_build_query($data)  .PHP_EOL; 

//解析rul

$url = 'http://baidu.com/index?arg=value&name=titui#anchor';
/*
Array
(
    [scheme] => http
    [host] => baidu.com
    [path] => /index
    [query] => arg=value&name=titui
    [fragment] => anchor
)
*/
print_r(parse_url($url));
echo parse_url($url, PHP_URL_PATH); ///index

$url = 'http://simpleoasys.com/admin/leaveApply/showList';
echo parse_url($url, PHP_URL_PATH); ///index/admin/leaveApply/showList