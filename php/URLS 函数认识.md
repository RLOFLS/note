[demo](./code/urlFunctions.php)
#### 预定义常量
```
PHP_URL_SCHEME (integer)
PHP_URL_HOST (integer)
PHP_URL_PORT (integer)
PHP_URL_USER (integer)
PHP_URL_PASS (integer)
PHP_URL_PATH (integer)
PHP_URL_QUERY (integer)
PHP_URL_FRAGMENT (integer)
PHP_QUERY_RFC1738 (integer)
PHP_QUERY_RFC3986 (integer)
```

- base64_decode ( string $data [, bool $strict = false ] ) : string
> data
编码过的数据。
strict
当设置 strict 为 TRUE 时，一旦输入的数据超出了 base64 字母表，将返回 FALSE。 否则会静默丢弃无效的字符。
- base64_encode ( string $data ) : string
- get_headers ( string $url [, int $format = 0 ] ) : array

```
url
目标 URL。
format
如果将可选的 format 参数设为 1，则 get_headers() 会解析相应的信息并设定数组的键名。
返回包含有服务器响应一个 HTTP 请求所发送标头的索引或关联数组，如果失败则返回 FALSE。
```

- get_meta_tags ( string $filename [, bool $use_include_path = false ] ) : array


```
filename
HTML 文件的路径字符串。 此参数可以是本地文件也可以是一个 URL。

Example #1 get_meta_tags() 解析了什么

<meta name="author" content="name">
<meta name="keywords" content="php documentation">
<meta name="DESCRIPTION" content="a php manual">
<meta name="geo.position" content="49.33;-86.59">
</head> <!-- 解析工作在此处停止 -->
（注意回车换行 － PHP 使用一个本地函数来解析输入，所以 Mac 上的文件将不能在 Unix 上正常工作）。
use_include_path
将 use_include_path 设置为 TRUE 将使 PHP 尝试按照 include_path 标准包含路径中的每个指向去打开文件。这只用于本地文件，不适用于 URL。
Note:
只有包含 name 属性的 meta 标签才会被解析
```
- http_build_query ( mixed $query_data [, string $numeric_prefix [, string $arg_separator [, int $enc_type = PHP_QUERY_RFC1738 ]]] ) : string

```
返回一个 URL 编码后的字符串。
```

- parse_url ( string $url [, int $component = -1 ] ) : mixed

```
url
要解析的 URL。无效字符将使用 _ 来替换。
component
指定 PHP_URL_SCHEME、 PHP_URL_HOST、 PHP_URL_PORT、 PHP_URL_USER、 PHP_URL_PASS、 PHP_URL_PATH、 PHP_URL_QUERY 或 PHP_URL_FRAGMENT 的其中一个来获取 URL 中指定的部分的 string。 （除了指定为 PHP_URL_PORT 后，将返回一个 integer 的值）。

对严重不合格的 URL，parse_url() 可能会返回 FALSE。

如果省略了 component 参数，将返回一个关联数组 array，在目前至少会有一个元素在该数组中。数组中可能的键有以下几种：

scheme - 如 http
host
port
user
pass
path
query - 在问号 ? 之后
fragment - 在散列符号 # 之后
如果指定了 component 参数， parse_url() 返回一个 string （或在指定为 PHP_URL_PORT 时返回一个 integer）而不是 array。如果 URL 中指定的组成部分不存在，将会返回 NULL。
```

- rawurldecode ( string $str ) : string

```
返回解码后的 URL 字符串。
rawurldecode() 不会把加号（'+'）解码为空格，而 urldecode() 可以。
```
- rawurlencode ( string $str ) : string

```
返回字符串，此字符串中除了 -_. 之外的所有非字母数字字符都将被替换成百分号（%）后跟两位十六进制数。这是在 » RFC 3986 中描述的编码，是为了保护原义字符以免其被解释为特殊的 URL 定界符，同时保护 URL 格式以免其被传输媒体（像一些邮件系统）使用字符转换时弄乱。
```

- urldecode ( string $str ) : string 

```
解码给出的已编码字符串中的任何 %##。 加号（'+'）被解码成一个空格字符。
```

- urlencode ( string $str ) : string

```
返回字符串，此字符串中除了 -_. 之外的所有非字母数字字符都将被替换成百分号（%）后跟两位十六进制数，空格则编码为加号（+）。此编码与 WWW 表单 POST 数据的编码方式是一样的，同时与 application/x-www-form-urlencoded 的媒体类型编码方式一样。由于历史原因，此编码在将空格编码为加号（+）方面与 » RFC3986 编码（参见 rawurlencode()）不同。
```