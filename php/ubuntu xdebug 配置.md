### 模块化配置

#### 配置文件

/etc/php/7.3/mods-available/xdebug.ini

```
#作为zend 可以启用
#xdebug extension
zend_extension=/usr/lib/php/20180731/xdebug.so
#extension=/usr/lib/php/20180731/xdebug.so
#
#xdebug.idekey = netbeans-xdebug
xdebug.remote_enable = 1
xdebug.remote_handler = dbgp
xdebug.remote_mode = req
xdebug.remote_host = 127.0.0.1
xdebug.remote_port = 9000
```

#### 建立软链接

`sudo ln -s /etc/php/7.3/mods-available/xdebug.ini /etc/php/7.3/cli/conf.d/20-xdebug.ini`

`sudo ln -s /etc/php/7.3/mods-available/xdebug.ini /etc/php/7.3/fpm/conf.d/20-xdebug.ini`

#### 重启服务