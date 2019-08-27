####语法
```
 location [=|~|~*|^~|@] /uri/ { … } 
```
####两种分类
```
location 可分两大类，分别是：“普通 location ”-location using   literal strings 和
“正则 location - location using regular expressions 。
其中“普通 location ”是以“ = ”或“ ^~ ”为前缀或者没有任何前缀的 /uri/ ；
“正则 location ”是以“ ~ ”或“ ~* ”为前缀的 /uri/ 。

~  大小写不敏感
~* 大小写敏感
=  则表达的是普通 location 不允许“最大前缀”匹配结果，必须严格等于，严格精确匹配。
^~ 的意思是“非正则，不需要继续正则匹配”

```

####注意
```
先 普通匹配 ，在正则 匹配，精准匹配最高
location 的指令与编辑顺序无关，这句话不全对。对于普通 location 指令，匹配规则是：最大前缀匹配（与顺序无关），
如果恰好是严格精确匹配结果或者加有前缀“ ^~ ”或“ = ”（符号“ = ”只能严格匹配，不能前缀匹配），则停止搜索正则 location ；
但对于正则 location 的匹配规则是：按编辑顺序逐个匹配（与顺序有关），只要匹配上，就立即停止后面的搜索。
```
#####@
```
REFER:  http://wiki.nginx.org/HttpCoreModule#error_page

假设配置如下：
       #error_page 404 http://www.baidu.com # 直接这样是不允许的
       error_page 404 = @fallback;

       location @fallback {
           proxy_pass http://www.baidu.com;
       }

}

上述配置文件的意思是：如果请求的 URI 存在，则本 nginx 返回对应的页面；
如果不存在，则把请求代理到baidu.com 上去做个弥补（注： nginx 当发现 URI 对应的页面不存在，
 HTTP_StatusCode 会是 404 ，此时error_page 404 指令能捕获它）
```
