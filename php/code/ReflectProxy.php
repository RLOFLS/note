<?php
error_reporting(1);
/**
 * 代理例子
 */
class Mysql {
    public function connect($params) {
        echo '1111';
        echo 'connect -'. implode(',', $params[0]) .PHP_EOL;
    }
}

 class SqlProxy {

    private $targets = [];
    public function __construct($target)
    {   
        $this->targets[] = $target;
    }

    /**
     * 代理
     */
    public function __call($name, $params) {
        foreach ($this->targets as $obj) {
            $db = new ReflectionClass($obj);
            if ($method = $db->getMethod($name)) {
                if($method->isPublic() && !$method->isAbstract()) {
                    echo '拦截前' .$method->name .PHP_EOL;
                    $method->invoke(new $obj, $params);
                    echo '拦截后' . PHP_EOL;
                }
            } 
        }
    }

 }

 $sqlProxy = new SqlProxy('Mysql');
 $sqlProxy->connect(['root','123456']);

