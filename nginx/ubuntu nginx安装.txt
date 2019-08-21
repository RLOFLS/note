
. 启动Nginx 服务。


sudo systemctl start nginx


--------------------------------+

. 开机自动启动nginx 服务

sudo systemctl enable nginx


. 关闭开机自动启动nginx 服务

sudo systemctl disable nginx

--------------------------------+


打开浏览器， 在地址栏输入127.0.0.1 or localhost， 出现Nginx 经典网页即表示成功。


. 也可以用Nginx 命令去测试


sudo nginx -t


Tip: 当每次修改完nginx 配置后, 也可使用此语句先查看配置是否正确.


. 查看端口


sudo lsof -i:80


三. Nginx 目录介绍


若Apache 的目录稍稍看懂， 那么Nginx 的目录也大同小异。 常用到的两个主目录：

/etc/nginx, /var/log/nginx.


. /etc/nginx, Nginx 配置目录

------------------------------------------------------------------------------+

drwxr-xr-x conf.d/ # 包含一般性的配置文件， 里面默认没有东西...

-rw-r--r-- fastcgi.conf # fastcgi 的配置

-rw-r--r-- fastcgi_params # fastcgi 参数的配置

-rw-r--r-- koi-utf

-rw-r--r-- koi-win

-rw-r--r-- mime.types # 资源的媒体类型相关配置

drwxr-xr-x modules-available/ # 模块区

drwxr-xr-x modules-enabled/

-rw-r--r-- nginx.conf # nginx 主配置文件

-rw-r--r-- proxy_params

-rw-r--r-- scgi_params

drwxr-xr-x sites-available/ # 虚拟主机配置文件夹

drwxr-xr-x sites-enabled/ # 虚拟主机配置文件夹， 生效区

drwxr-xr-x snippets/

-rw-r--r-- uwsgi_params

-rw-r--r-- win-utf

--------------------------------------------------------------------+


其他的都默认不动就好了， 主要有三个地方， nginx.conf ，sites-available/， sites-enabled/。


四. 配置


从亲手配置到理解配置。


a) 首先， 让Nginx 解析PHP 文件。


. 让Nginx 解析PHP 文件， 需要安装php7.1-fpm.


sudo apt install php7.1-fpm


b) 编辑Nginx 文件


. 进入到Nginx 配置文件夹下, 并打开Nginx 配置文件


cd /etc/nginx


sudo vim nginx/conf


Tip： 里面有许多东西是注释掉的， 需要你自己配置。


------------------------------------------------+

# 运行Nginx 服务的身份, 默认是www-data， 我给注释掉了。 经过一系列配置后， 我发现注释掉也是可以的， 没影响。 可能和以后服务器正式环境有些相关吧。

#user root;


worker_processes 4; # 进程数量， CPU 有几核， 就设置几， 我设置4.

pid /run/nginx.pid; # Nginx PID 值保存的文件


# 引入模块的各种配置

include /etc/nginx/modules-enabled/*.conf;


# Nginx 事件

events {

worker_connections 1024; # 单个worker process 进程的最大并发链接数

# multi_accept on;

}


http {


##

# Basic Settings

##


sendfile on;

tcp_nopush on;

tcp_nodelay on;

keepalive_timeout 65;

types_hash_max_size 2048;

# server_tokens off;


# server_names_hash_bucket_size 64;

# server_name_in_redirect off;


include /etc/nginx/mime.types;

default_type application/octet-stream;


##

# SSL Settings

##


ssl_protocols TLSv1 TLSv1.1 TLSv1.2; # Dropping SSLv3, ref: POODLE

ssl_prefer_server_ciphers on;


##

# Logging Settings

##


access_log /var/log/nginx/access.log; # 访问日志

error_log /var/log/nginx/error.log; # 错误日志


##

# Gzip Settings

##

# gzip 设置， 使用gizp压缩提高网站的传输速度。 之前的是注释掉的， 我给开启了， 默认就好。


gzip on;

gzip_disable "msie6";


gzip_vary on;

gzip_proxied any;

gzip_comp_level 6;

gzip_buffers 16 8k;

gzip_http_version 1.1;

gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;


##

# Virtual Host Configs

##

# 虚拟配置引入

include /etc/nginx/conf.d/*.conf;

include /etc/nginx/sites-enabled/*;

}


# Nginx 还可以做邮箱服务器和反向代理服务器。 默认是注释。


#mail {

# # See sample authentication script at:

# # http://wiki.nginx.org/ImapAuthenticateWithApachePhpScript

#

# # auth_http localhost/auth.php;

# # pop3_capabilities "TOP" "USER";

# # imap_capabilities "IMAP4rev1" "UIDPLUS";

#

# server {

# listen localhost:110;

# protocol pop3;

# proxy on;

# }

#

# server {

# listen localhost:143;

# protocol imap;

# proxy on;

# }

#}


------------------------------------------------+


. 看完了Nginx 配置， 发现没什么要修改的。 于是开始着手让Nginx 开始解析PHP。 首先打开虚拟机配置文件， 还是同一个目录下操作。 先给配置文件做一个备份， 以防万一。


sudo cp sites-available/default sites-available/default.bak


sudo vim sites-available/default


. 其他注释的地方我就没复制

----------------------------------------------------------+

server {

listen 80 default_server;　　　　　　　　# IPv4 端口号

listen [::]:80 default_server;　　　　　# IPv6 端口号

 

root /var/www/html; 　　　　　　　　　　  # Nginx 服务器根目录


# Add index.php to the list if you are using PHP

# 默认有好多类型的， 在这我添加了PHP 的index 索引文件， 然后把其他的都删掉了。

# 开头的index， 告诉Nginx 要添加的index 索引文件， 不可少。

index index.php; 　　　　　　　　　　　　 # 添加自动索引文件

 

server_name localhost; 　　　　　　　　  # 域名

 

# location / 通用匹配，任何请求都会匹配到。

# 我在这里只开启了可以浏览文件夹。

location / {

# First attempt to serve request as file, then

# as directory, then fall back to displaying a 404.

try_files $uri $uri/ =404;

autoindex on;

autoindex_exact_size off;

autoindex_localtime on;


}


# pass PHP scripts to FastCGI server

# 访问带.php 后缀的文件的地址， 需要走这里， 比如localhost/test.php。 就是让Nginx 去解析PHP 文件。

location ~ \.php$ {

include snippets/fastcgi-php.conf;

#

# # With php-fpm (or other unix sockets):

  fastcgi_pass unix:/var/run/php/php7.1-fpm.sock;　　　　^ 注释一

# # With php-cgi (or other tcp sockets):

# fastcgi_pass 127.0.0.1:9000;　　　　　　　　　　　　　　　 ^ 注释二

}


# deny access to .htaccess files, if Apache's document root

# concurs with nginx's one

# 禁止htaccess 文件

# location ~ /\.ht {

# deny all;

#}

}


# 下面还有提供的虚拟主机配置的模板。 意思是你可以再新建一个文件， 用此模板， 放在sites-available/ 中， 链接到sites-enabled/ 启用就可以。

# Virtual Host configuration for example.com

#

# You can move that to a different file under sites-available/ and symlink that

# to sites-enabled/ to enable it.

#

#server {

# listen 80;

# listen [::]:80;

#

# server_name example.com;

#

# root /var/www/example.com;

# index index.html;

#

# location / {

# try_files $uri $uri/ =404;

# }

#}

--------------------------------------------------+


Tip: 注释一, 二详解


注释一: fastcgi_pass unix:/var/run/php/php7.1-fpm.sock

注释二: fastcgi_pass 127.0.0.1:9000。

 

这两句不能同时开启, 只能开启一个.

1. 若开启注释一, 出现报错, 那么就走下面, 若没有错误, 服务正常开启, 那么就成功了

 

. 进入到php目录下, 并查看

 

cd /etc/php/7.1


ls


. 会看到这四个文件夹


apache2 cgi fpm mods-available


若使用nginx 服务器, 那么以后fpm 中的php.ini 文件会成为php 的配置文件, 开启个扩展, 或debug 调试, 都要从这里面修改. 同理若使用apache 服务器, 那么会使用apache2 目录下的配置文件.

若出现了报错, 则需要更改fpm/pool.d/www.conf 配置文件


sudo vim fpm/pool.d/www.conf


vim 一般模式下, /listen 找到如下三行


listen.owner = www-data

listen.group = www-data

;listen.mode = 0660


把最后一个去掉注释. 保存退出.


2. 若开启注释二, 则


. 首先查看Fastcgi 的端口， 查看是否有127.0.0.1:9000。


netstat -antp


. 若没有, 则开启


php-cgi -b 127.0.0.1:9000 &


这时, 他会提醒你安装php-cgi, 你就安装你的php 版本的cgi


sudo apt install php7.1-cgi


. 再重复一次, 开启


php-cgi -b 127.0.0.1:9000 &

 

这样基本配置就完成了， 首先测试一下， 是否能解析PHP 文件。 在/var/www/html 目录下， 创建一个index.php 文件。


sudo vim /var/www/html/index.php


i, 进入编辑模式


<?php

phpinfo();

?>


Esc, :wq 保存退出。


. 开启服务


sudo systemctl start nginx php7.1-fpm


Tip： 编辑配置配置文件若出现错误时， 往往开启不了服务， 这时则需要去Nginx 日志目录下查看错误日志，错误一看便知， 它会告诉你错误出现在哪个配置文件的哪一行。 日志文件在/var/log/nginx 目录下， 可more error.log 查看。


. 打开浏览器， 在地址栏输入127.0.0.1 or localhost


若出现php 的信息， 则成功。


五. 问题


1. 若出现403 Forbiddn, 则不是你的配置的事情， 应该是你的该根目录权限的问题。 首先查看根目录


ll /var/www

 

若不是这样, 权限不足的话， 则改一下权限。


sudo chmod 777 /var/www/html


然后再去浏览器刷新， 看是否成功. 若还是禁止， 则该转向另一个问题了. 使用者是否正确


. 首先


查看用户www-data 是否存在。 若不存在， 则添加该用户和用户组。


// 创建用户


sudo useradd www-data


// 把该用户添加到sudo 组中, 以后就可以使用sudo 来提升权限


sudo usermod -a -G sudo www-data


. 或者去Nginx 的配置文件中， 把第一行的用户的注释去掉， 改成root。

 

sudo vim /etc/nginx/nginx.conf



去掉注释。 这时重启Nginx 服务。


nginx -s reload


or


sudo systemctl restart nginx


再去浏览器刷新一下， 看是否有效果。 若有效果， 则进入下一步。


2. 若出现502 Bad Gateway


502 Bad Gateway, 连接超时 我们向服务器发送请求 由于服务器当前链接太多，导致服务器方面无法给于正常的响应，产生此类报错。

 

回到上面的两个注释上去解决.



六. 更改根目录


. 按上面所说， 编辑虚拟主机默认配置文件


进入到Nginx 配置目录。


cd /etc/nginx/


编辑配置文件。


sudo vim sites-enabled/default


把里面的root 更换你自己的目录。


比如我的是home/loseself/www。 别忘了创建那个文件夹。

然后更改根目录权限。


sudo chmod 777 home/loseself/www


. 重启Nginx 服务


sudo systemctl restart nginx



七. 配置虚拟主机


. 进入到Nginx 配置目录。


cd /etc/nginx/


. 在sites-available 下新建一个文件， 复制其下的default 的文件即可， 然后进行配置， 再链接到sites-enabled 文件夹下。（和Apache 配置步骤差不多， 且default 文件下还有提供的虚拟主机配置模板， 上面提到过！）


. 给文件起你想要的名字， 在这就叫做april， 然后编辑april 文件， 修改端口设置， 域名和根目录。


cp sites-available/default sites-available/april

 

 

端口像这样， 去掉default， 下面有模板。


然后更改域名和根目录。 完成后保存退出。 Esc, :wq


. 创建链接文件到site-enabled文件夹下， 这次链接的路径也和Apache不一样， 按他的来。


su ln -s /etc/nginx/sites-available/april sites-enabled/april


. 查看一下


ll sites-available


成功后， 去hosts 文件添加你修改的域名。


. 添加域名


sudo vim /etc/hosts


. 新添一个你的域名， 我的叫loseself.im


127.0.0.1 loseself.im


保存退出。


. 在根目录下添加一个测试文件index.php


sudo vim 你的根目录/index.php


<?php

phpinfo();

?>


保存退出。 重启Nginx 服务。


sudo systemctl restart nginx


. 打开浏览器， 输入你的新添域名。 看到效果即可。


八. 开启Nginx 服务器PHP 的调试


1. 前往属于Nginx 的php配置文件的目录下


cd /etc/php/7.1/fpm


2. 打开php.ini


sudo vim php.ini


/ERROR


找到error_reporting, display_errors 并改为以下.


error_reporting = E_ALL & ~E_ERROR


display_errors = On


3. 重启nginx, php7.1-fpm 服务


sudo systemctl restart nginx php7.1-fpm


4. 若还不行, 则打开php-fpm.conf


sudo vim php-fpm.conf


在最后一行复制上下面这句话


php_flag[display_errors] = on


再重启nginx, php7.1-fpm 服务.