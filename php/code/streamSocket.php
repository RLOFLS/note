<?php
error_reporting(E_ALL);
//$fp = fsockopen('simpleoasys.com',80,$err);
$fp = stream_socket_client('tcp://simpleoasys.com:80',$err);
if (!$fp) {
    echo '连接失败'.$err.PHP_EOL;
    fclose($fp);
    die();
}
$post = ['title' => 'test22', 'content' => '测试1111222111'];
$data = http_build_query($post);
$out = "POST http://simpleoasys.com/admin/bulletinManage/addBulletion HTTP/1.1\r\n";
$out .= "Host: simpleoasys.com\r\n";
$out .= "Accept-Encoding: gzip, deflate\r\n";
$out .= "Accept-Language: zh-CN,zh\r\n";
$out .= "User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36\r\n";
$out .= "Content-Length: ".strlen($data)."\r\n";
$out .= "Cookie: PHPSESSID=krp3d5hq233kq450gvmltk724b\r\n";
$out .= "Content-Type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
$out .= "Connection: close\r\n\r\n";
$out .= $data."\r\n\r\n";
fwrite($fp, $out);

echo "response:content";
while(!feof($fp)) {
    echo fgets($fp);
}
echo "ok\n";
if(feof($fp)) {
    echo '读取完毕'.PHP_EOL;
}

//print_r(stream_get_meta_data($fp));

fclose($fp);

