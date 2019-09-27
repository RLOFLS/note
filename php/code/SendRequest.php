<?php

class demo {

    private $context;
    private $url;
    private $query;
    private $method;
    private $stream = null; //请求流
    private $responseHeader; 

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * 生成上下文
     * @param array $context
     * @return demo
     */
    public function setContext($context) {
        $this->context = stream_context_create($context);
        return $this;
    }

    /**
     * 设置query数据
     * @param array $query
     * @return demo
     */
    public function setQuery($query) {
        $this->query = http_build_query($query);
    }

    /**
     * 发送请求
     */
    public function sendRequestByFGC() {
        $html = file_get_contents($this->url,false, $this->context);
        $this->responseHeader = $http_response_header;
       return $html;
    }

    /**
     * 发送请求
     */
    public function sendRequestByFO() {
        $this->stream = @fopen($this->url,'r',false, $this->context);
        $this->responseHeader = stream_get_meta_data($this->stream);
        return $this;
    }

    /**
     * 获取文件流细腻县
     */
    public function getStreamInfo() {
        if ($this->stream) {
            while(($buffer = fgets($this->stream)) !== false) {
                echo $buffer .PHP_EOL;
            }
            if(feof($this->stream)) {
                echo "已到末尾".PHP_EOL;
            }
        }
    }

    /**
     * 获取响应头
     */
    public function getResponseHeader(){
        if (! $this->responseHeader) {
            $this->responseHeader = stream_get_meta_data($this->stream);
        }
        return $this->responseHeader;
    }

    /**
     * 获取context
     */
    public function printContext() {
        print_r(stream_context_get_default());
        echo '----option---'.PHP_EOL;
        print_r(stream_context_get_options($this->context));
        echo  '----params---'.PHP_EOL;
        print_r(stream_context_get_params($this->context));
    }

    /**
     * 获取头
     */
    public function getHeader() {
        return get_headers($this->url,null, $this->context);
    }

    /**
     * 
     */
    public function __get($name) {
        return isset($this->$name)?$this->$name:'null';
    }

    public function __destruct()
    {
        if ($this->stream != null) {
            fclose($this->stream);
        }
    }
}

/**
 * 测试发送公告
 */
$url = 'http://simpleoasys.com/admin/bulletinManage/addBulletion';

$post = ['title' => 'test', 'content' => '测试11111111111'];
$context = [
    'http'=> [
        'method'=>"POST",
        'header'=>"Accept-Encoding: gzip, deflate\r\n" .
                  "Accept-Language: zh-CN,zh\r\n" .
                  "Cookie: PHPSESSID=krp3d5hq233kq450gvmltk724b\r\n",
        'content' => http_build_query($post),
      ]
];

$demo = new demo($url);

//file_get_contents 测试
/*
$html = $demo->setContext($context)->sendRequestByFGC();
print_r($demo->responseHeader);
print_r($html);
*/

//fopen 测试

$demo->setContext($context)->sendRequestByFO()->getStreamInfo();
print_r($demo->responseHeader);


//测试打印context
//$demo->setContext($context)->printContext();

//测试头
//print_r($demo->setContext($context)->getHeader());


