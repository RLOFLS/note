### memcached
- 先安装 sudo apt-get install memcached libmemcached-dev libmemcached

- pecl 官网下载memcached 包 再 phpize 安装

### memcache （过时了）

- php 7 以上版本不能直接用 pecl 的包

```
git clone https://github.com/websupport-sk/pecl-memcache memcache
cd memcache
```
再进行 phpize 安装
- php7 以下版本不用