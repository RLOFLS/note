#### 安装

- [学习地址](https://symfonycasts.com/tracks/symfony)
- composer require doctrine
- config/packages/doctrine.yaml 配置相关文件
-  php bin/console doctrine:database:create 创建数据库

#### 创建实体

- bin/console make:entity

##### 创建已有数据库

- bin/console doctrine:mapping:import "App\Entity" yml --path=src/Entity/Doctrine
- bin/console make:entity --regenerate App

#### 插入

- persist() 
- flush()