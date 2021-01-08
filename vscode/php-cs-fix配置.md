---

- 安装 php-cs-fixer

- 

  ```
  $ mkdir --p /opt/php/tools/php-cs-fixer
  $ composer require --working-dir=/opt/php/tools/php-cs-fixer friendsofphp/php-cs-fixer
  ```

-  配置 php-cs-fixer 扩展

  - 执行路径 /opt/php/tools/php-cs-fixer/vendor/bin/php-cs-fixer

  - ```json
    "php-cs-fixer.executablePath": "/opt/php/tools/php-cs-fixer/vendor/bin/php-cs-fixer",
    "php-cs-fixer.onsave": true,
    "php-cs-fixer.rules": "@PSR2",
    "[php]": {
        "editor.defaultFormatter": "junstyle.php-cs-fixer"
    },
    ```