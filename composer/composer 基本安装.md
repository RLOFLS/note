composer 是一个项目依赖管理

全局安装
####安装
```
curl -sS https://getcomposer.org/installer | php
or 
php -r "readfile('https://getcomposer.org/installer');" | php

全局：
mv composer.phar /usr/local/bin/composer
```

###更换本地源
```
composer.phar config repo.packagist composer https://packagist.phpcomposer.com
```