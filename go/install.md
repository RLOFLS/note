### ubuntu
#### 网址

```
https://golang.google.cn/dl/
https://gomirrors.org/

```

#### 安装

```
//解压目的安装目录
tar -C /usr/local -xzf go1.14.4.linux-amd64.tar.gz

```

#### 环境变量
```
export GOROOT=/usr/local/go              # 安装目录。
export GOPATH=$HOME/go     # 工作环境
export GOBIN=$GOPATH/bin           # 可执行文件存放
export PATH=$GOPATH:$GOBIN:$GOROOT/bin:$PATH       # 添加PATH路径
export PATH=$PATH:/usr/local/go/bin

//重启生效 或者立即生效
source ~/.profile
source /etc/profile
```


#### 修改配置文件
```
go env -w GO111MODULE=on
//设置代理
//七牛 CDN
go env -w  GOPROXY=https://goproxy.cn,direct
//阿里云
go env -w GOPROXY=https://mirrors.aliyun.com/goproxy/
//其他基础配置
go env -w GOROOT=/usr/local/go              # 安装目录。
go env -w GOPATH=$HOME/go     # 工作环境
go env -w GOBIN=$GOPATH/bin           # 可执行文件存放
```