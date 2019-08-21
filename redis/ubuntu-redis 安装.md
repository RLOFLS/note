Ubuntu18.04中安装Redis
准备工作

    先对系统的依赖环境进行更新

    $ sudo apt-get update
    $ sudo apt-get upgrade

    安装Redis

    $ sudo apt-get install redis-server

    # 如果需要安装成服务的话执行
    $ sudo systemctl enable redis-server.service

    # 确认安装的版本
    $ redis-server -v

启动和停止

默认情况下直接在终端输入redis-server即可临时性启动Redis服务，再新开终端输入redis-cli启动客户端连接。

```
$ redis-server       # 启动服务
$ redis-cli          # 启动客户端
$ redis-cli shutdown # 关闭服务
```

如果出现以上命令无法关闭redis-server的情况下解决办法如下：

    使用以下命令启动重启和关闭

    $ /etc/init.d/redis-server stop     # 停止
    $ /etc/init.d/redis-server start    # 启动
    $ /etc/init.d/redis-server restart  # 重启

    我的安装情况是默认安装后保护模式和后台启动模式均为开启状态，根据需要配置为关闭。
    查看下面的简单配置。

查看进程状态以及强制停止

Linux命令来查看和杀掉进程来强制关闭服务。

$ ps aux | grep "redis"
$ sudo pkill pid

连接测试

直接输入redis-cli通过默认客户端来测试连接，正常情况下返回ping的对应值PONG。

$ redis-cli

$ 127.0.0.1:6379> ping
PONG
$ 127.0.0.1:6379>

简单配置

通过编辑默认配置文件来初步简单配置，推荐copy并重命名配置文件。

$ sudo vim /etc/redis/redis.conf

打开远程连接并关闭保护模式，否则只允许本地连接：

# 把以下注释掉（前面加#）
bind 127.0.0.1 ::1
# 以下改为 yes → no
protected-mode no

# 如果需要，设置验证密码
requirepass YOURPASSPHRASE

以上设置也可以通过客户端设置：

redis 127.0.0.1:6379> CONFIG SET requirepass YOURPASSPHRASE
OK
redis 127.0.0.1:6379> AUTH YOURPASSPHRASE
Ok

设置密码后的连接方式：

$ redis-cli -h 127.0.0.1 -p 6379 -a YOURPASSPHRASE  #其他参数如未改动则可省略

保存后重启服务：

$ sudo service redis-server restart

如果需要更改内存的限制可以进行以下设置。

maxmemory 256mb
maxmemory-policy allkeys-lru

设置后需要重启redis服务：

$ sudo systemctl restart redis-server.service
