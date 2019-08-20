###1.复制源文件备份，以防万一
```
sudo cp /etc/apt/sources.list /etc/apt/sources.list.bak
```

###2.编辑源列表文件

命令如下：
```
sudo vim /etc/apt/sources.list
```


###3.查看新版本信息

####查看系统代号
```
lsb_release -c
````



### resource
```
deb http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse

deb-src http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse

deb http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse

deb-src http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse

deb http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse

deb-src http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse

deb http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse

deb-src http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse

deb http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse

deb-src http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse
```

###5.更新软件列表
```
运行如下命令：
sudo apt-get update
```
###6.更新软件包
````
运行如下命令：
sudo apt-get upgrade
````
