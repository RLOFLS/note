
- get_headers() 获取服务器响应头 判断状态吗是否为200
> [filegetcontents](./code/filegetcontents.php)
> [测试模拟发送公告](./code/SendRequest.php)
> [curl库函数demo](./code/curldemo.php)
- file系列函数 fopen, file_get_contents 
- stream_* 系列函数：发送请求 不限于HTTP 协议
- socket 函数：通过Socket 发送和请求数据
- cURL 扩展库 可以模拟浏览器和服务器进行交互，功能强大
- header函数: 发送原始的HTTP 头， 这个函数之前不能有输出 以及空格等


###### 垃圾信息防御措施
- ip 限制
- 添加验证码
- Token 和表单欺骗
- 审核机制