https://www.cnblogs.com/58top/p/7754410.html
1、切换到扩展模块目录
在php源码包被解压后的目录中有个ext子目录，这里有近70多个主流的php扩展模块安装包。
如现在要安装imap扩展，则切换到imap目录：
cd /software/php-5.5.3/ext/imap

2、在imap目录中执行phpize脚本
/usr/local/php/bin/phpize
执行成功会返回几行数据：
Configuring for:
PHP Api Version: 20041225
Zend Module Api No: 20060613
Zend Extension Api No: 220060519

3、开始编译(注意--with-php-config参数) 
若编译过程中报错,可以参考另外一篇文章解决报错 http://blog.csdn.net/haiqiao_2010/article/details/46005773
./configure --with-php-config=/usr/local/php/bin/php-config --with-kerberos --with-imap-ssl
 

4、make
5、make install
 

统提示信息截图如下:


这时在
/usr/local/php/lib/php/extensions/no-debug-non-zts-20121212/
目录会生成imap.so文件
 

6、在php.ini中找到extension_dir字段，把值修改成：
/usr/local/php/lib/php/extensions/no-debug-non-zts-20121212/

7、再在php.ini的Dynamic Extensions节位置下添加
extension = "imap.so"

 8、重启服务器
PHP 、NGINX 、APACHE，完成。
phpinfo() 看到如下模块扩展,即说明安装成功.


 sudo /usr/bin/phpize7.0

sudo ./configure --with-php-config=/usr/bin/php-config7.0

sudo make && sudo make install

make test

### 配置文件
```
eg: php.ini
sudo vim /etc/php/7.0/fpm/php.ini
sudo vim /etc/php/7.0/fpm/conf.d/20-redis.ini

添加 extension=redis.so
```

### pecl 安装
` pecl install swoole `
sudo apt-get update
sudo apt-get install php-pear -y
Running this command will install APCu.

sudo pecl install apcu


