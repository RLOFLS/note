<?php
namespace Db;
use Db\Database\Mysql;
/**
 * db 工厂类
 */
class DbFactory{
    
    private static $intance = [];

    private static $config;

    public function __construct()
    {
           $this->loadConfig();
    }

    public static function factory($name) {
        if (!self::$intance[$name]) {
            $namePath = 'Db\Database\\'.$name;
            self::$intance[$name] = new $namePath(self::$config[$name]);
        }
        return self::$intance[$name];
    }

    /**
     * 加载配置
     */
    private function loadConfig() {
        $config = require_once(ROOT_URL.'/Db/dbconfig.php');
        self::$config = $config;
    }

}