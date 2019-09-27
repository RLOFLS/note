<?php

// $html = file_get_contents('https://baidu.com');
// print_r($http_response_header);
// print_r($html);

$fp = fopen("https://www.baidu.com/", 'r');
print_r(stream_get_meta_data($fp));
/*
Array
(
    [crypto] => Array
        (
            [protocol] => TLSv1.2
            [cipher_name] => ECDHE-RSA-AES128-GCM-SHA256
            [cipher_bits] => 128
            [cipher_version] => TLSv1.2
        )

    [timed_out] => 
    [blocked] => 1
    [eof] => 
    [wrapper_data] => Array
        (
            [0] => HTTP/1.0 200 OK
            [1] => Accept-Ranges: bytes
            [2] => Cache-Control: no-cache
            [3] => Content-Length: 14722
            [4] => Content-Type: text/html
            [5] => Date: Fri, 27 Sep 2019 06:08:36 GMT
            [6] => Etag: "5d7f08a7-3982"
            [7] => Last-Modified: Mon, 16 Sep 2019 03:59:35 GMT
            [8] => P3p: CP=" OTI DSP COR IVA OUR IND COM "
            [9] => Pragma: no-cache
            [10] => Server: BWS/1.1
            [11] => Set-Cookie: BAIDUID=E643D0C7873756EA2E84A92094037401:FG=1; expires=Thu, 31-Dec-37 23:55:55 GMT; max-age=2147483647; path=/; domain=.baidu.com
            [12] => Set-Cookie: BIDUPSID=E643D0C7873756EA2E84A92094037401; expires=Thu, 31-Dec-37 23:55:55 GMT; max-age=2147483647; path=/; domain=.baidu.com
            [13] => Set-Cookie: PSTM=1569564516; expires=Thu, 31-Dec-37 23:55:55 GMT; max-age=2147483647; path=/; domain=.baidu.com
            [14] => Vary: Accept-Encoding
            [15] => X-Ua-Compatible: IE=Edge,chrome=1
        )

    [wrapper_type] => http
    [stream_type] => tcp_socket/ssl
    [mode] => r
    [unread_bytes] => 3251
    [seekable] => 
    [uri] => https://www.baidu.com/
)
*/
fclose($fp);
