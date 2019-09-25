<?php
namespace Db\Database;

use Db\Database\IDatabase;
use PDO;

class Mysql implements IDatabase {

    /**
     * pdo 连接实例
     */
    private $pdo;

    /**
     * 数据表
     */
    private $table;

    /**
     * 配置
     */
    private $config = [];

    public function __construct($config)
    {
        $this->config = $config;
        $this->connect();
    }

    public function connect()
    {
        $dsn = 'mysql:dbname='.$this->config['database'].';host='.$this->config['host'].';port='.$this->config['port'];
        $user =$this->config['user'];
        $password = $this->config['password'];

        try {
            $this->pdo = new \PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo '数据库连接失败:',$e->getMessage().PHP_EOL;
        }
    }

    /**
     * 查询
     * @param string $sql
     * @return array
     */
    public function query($sql)
    {
        if ($stmt = $this->pdo->query($sql) ) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
        
    }
}