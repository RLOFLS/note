#### http协议

- hyper text transfer protocol 超文本传输协议
- http通常承载与TCP协议上，有时页承载与TLS,SSL上也称为https 

##### http如何工作

- 客户端发起一个请求（request） 给服务器， 服务器在接受到这个请求将生成一个响应（response）给客户端

> 1. 客户端与服务端建立连接，如点击超链接，http协议开始工作
> 2. 建立连接后，客户机发起一个请求给服务器，格式：统一资源标识符（url），中间是协议版本号，后边是 mime信息（请求修饰符，客户机信息，等内容）
> 3. 服务器接到请求，给予相应的响应信息。 格式：首先是状态行（包括信息的协议版本号，一个成功或错误的代码），然后是mine信息（服务器信息，实体信息，等）
> 4. 客户端接收到服务器返回的信息并显示在屏幕上，然后客户机与服务器断开连接。

##### 请求

- 如果想支持长连接 request /response 任意一方 connection 值为close 将候补支持。

###### 请求
- http 请求三部分组成（请求行，消息报头，请求正文）
请求行：`Method Resquest-URL HTTP_Version CRLF`
> Method : 请求方法

>> -  GET: 请求获取Resquest URL 所标识的资源 
>> - POST:请求获取Resquest URL 所标识的资源 
>> - HEAD: 请求获取由Resquest Url所标识的资源的响应消息报头
>> - PUT:请求服务器存储一个资源，并用Resquest URL 作为其标识
>> - DELETE:请求服务器删除Resquest URL所标识的资源
>> - TRACE: 请求服务器回送收到的请求信息，主要用于测试或者诊断
>> - CONNECT: 保留以备将来使用
>> - OPTIONS: 请求查询服务器的性能，或者查询与资源相关的选项和需求

> Resquest-URL: 一个统一的资源标识符 

> HTTP Version: 请求的HTTP协议版本

> CRLF: 回车换行（除了作为结尾的CRLF ,不允许单独出现CR 或者LF）

###### 响应

- 状态行 消息报文，响应正文
` HTTP-Version Status-Code Reason-Rhrase CRLF`

> HTTP Version :服务器HTTP协议的版号

>> 1xx : 指示信息--请求已接收，继续处理

>> 2xx : 成功--请求已被成功接收，理解，接受
200 OK:客户端请求成功
>> 3xx : 重定向--完成请求必须进行更进一步的操作
>> 4xx : 客户端错误--请求由有语法错误或者请求无法实现
400 Bad Resquest :客户端请求错误，不能被服务器所理解
401 Unauthorize:请求未经授权
403 Forbidden: 服务器收到请求，但是拒绝服务
404 Not Found: 请求资源不存在，或输入错误的URl
>> 5xx : 服务端错误--服务器未能实现合法的请求
500 Internal Server Error: 服务器发生不可预期的错误
503 Server Unavailable: 服务器但前不能处理客户端的请求，一段时间后可能恢复正常

> Status Code: 服务器发挥的响应状态码

> Reason Rhrase ： 状态代码的文本描述

示例
```
Request URL: http://...
Request Method: GET
Status Code: 200 OK
Remote Address: 127.0.0.1:80
Referrer Policy: no-referrer-when-downgrade

Cache-Control: no-store, no-cache, must-revalidate
Connection: keep-alive
Content-Encoding: gzip
Content-Type: text/html; charset=utf-8
Date: Fri, 27 Sep 2019 02:54:54 GMT
Expires: Thu, 19 Nov 1981 08:52:00 GMT
Pragma: no-cache
Server: nginx/1.14.0 (Ubuntu)
Transfer-Encoding: chunked
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3

Accept-Encoding: gzip, deflate
Accept-Language: zh-CN,zh;q=0.9
Connection: keep-alive
Cookie: PHPSESSID=krp3d5hq233kq450gvmltk724b
Host: ...
Referer: http://.....
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36
```
