
那么首先安装wine

sudo su
输入密码
sudo dpkg --add-architecture i386
wget -nc http://dl.winehq.org/wine-builds/Release.key
sudo apt-key add Release.key
sudo apt-add-repository 'deb http://dl.winehq.org/wine-builds/ubuntu/ xenial main'
sudo apt-get update
sudo apt-get install --install-recommends winehq-devel
等待装完就可以

wine --version
看wine的版本

然后

winecfg

###没有签名
sudo apt-key adv --recv-keys --keyserver keyserver.Ubuntu.com F987672F