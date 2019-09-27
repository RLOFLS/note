<?php
class Demo {
    private $ch = null;
    private $info;
    private $body;

    public function __construct($url)
    {
        $this->ch = curl_init($url);
    }
    /**
     * 设置选项信息
     */
    public function setOptions($array) {
        curl_setopt_array($this->ch,$array);
        return $this;
    }
    /**
     * 设置选项信息
     */
    public function setOption($op,$val) {
        curl_setopt_array($this->ch,$op,$val);
        return $this;
    }

    /**
     * 执行
     */
    public function execute() {
        if ($this->body = curl_exec($this->ch) ) {
            $this->info = curl_getinfo($this->ch);
        }else {
            echo curl_error($this->ch);
        }
    }

    public function __get($name) {
        return isset($this->$name) ? $this->$name:'没有'.$name.PHP_EOL ;
    }

    public function __destruct()
    {
        @fclose($this->ch);
    }
}

$url = 'http://simpleoasys.com/admin/bulletinManage/addBulletion';

$post = ['title' => 'test', 'content' => '测试11111111111'];
$options = [
    CURLOPT_POST => true,
    CURLOPT_HEADER => false, //不显示头ixanxi
    CURLOPT_FOLLOWLOCATION => false, 
    CURLOPT_RETURNTRANSFER => true, //curl_exec 返回结果 而不是直接输出
    CURLOPT_REFERER => 'http://simpleoasys.com/admin/bulletinManage/showList',
    CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36',
    CURLOPT_HTTPHEADER => [ //设置头信息
        'Accept-Encoding:gzip, deflate',
        'Accept-Language:zh-CN,zh',
        'Cookie:PHPSESSID=krp3d5hq233kq450gvmltk724b',
    ],
    CURLOPT_POSTFIELDS => http_build_query($post),
    
];

$demo = new Demo($url);
$demo->setOptions($options)->execute();
print_r($demo->info);
// echo '------'.PHP_EOL;
print_r($demo->body).PHP_EOL;