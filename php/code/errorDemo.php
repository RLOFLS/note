<?php
class Demo {

    /**
     * 自定义错误处理
     */
    public function handError($errno, $errstr, $errfile, $errline, $errtxt) {
        echo '错误errno:'.$errno.PHP_EOL;
        echo '错误信息:'.$errstr.PHP_EOL;
        echo '错误文件:'.$errfile.PHP_EOL;
        echo '错误行号:'.$errline.PHP_EOL;
    }

    /**
     * 自定义异常处理
     */
    public function handException($e) {
        echo $e->getMessage() .PHP_EOL;
    }

    /**
     * set
     */
    public function set() {
        set_error_handler([&$this,'handError']);
        set_exception_handler([&$this,'handException']);
    }

}

$deom = new Demo();
$deom->set();
//trigger_error('akjfksjf', E_USER_ERROR);

//throw new Exception('自定义异常');

//restore_error_handler(); //取消自定义处理
//restore_exception_handler();
trigger_error('akjfkasdsdasjf', E_USER_ERROR);
throw new Exception('自定义异常');


