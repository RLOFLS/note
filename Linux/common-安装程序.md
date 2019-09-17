你的味道是什么？

几年前流行的是将不同的Linux发行版称为Linux的“风味”。虽然有一个标准化Linux安装的运动，但市场上的主要发行版之间存在重大差异。不太知名的发行版通常从较大的玩家那里获得他们的安装程序。每个都有自己的“包”安装系统。让我们看看最着名的：



>>http://www.slackware.com）传统上一直是纯粹主义者的选择。尽管这位作者可以衡量，但它正逐渐被Gentoo Linux所取代。（稍后有关于Gentoo的更多信息）Slackware依赖于一个安装带有* .tgz扩展名的tarball的系统。打字：
- 安装 （如果要了解要安装的新文件，请使用-warn）
`installpkg program.tgz`
- 删除应用程序和任何其他补充文件，如文档。
`removepkg program.tgz`
- 升级到较新版本：
`upgradepkg new_version.tgz`

### Debian GNU / Linux

Debian（http://www.debian.org）一直是另一种纯粹主义者的首选发行版：许可纯粹主义者。只有真正的开源软件包才能进入官方Debian版本。这并不意味着其他人无法创建非官方套餐。他们经常这样做。无论其状态如何，如果您获得新包，可以采用传统方式安装：
`dpkg -i package.deb`
或者：
`apt-get install new_package.deb`
- 移除
`apt-get remove unwanted_package.deb`
- 更新多个软件包甚至更新整个系统
`apt-get update`
`apt-get upgrade`
### Red Hat和其他基于RPM的发行版

- 要在任何基于RPM的分发上安装程序，请键入：
`rpm -i new_program.rpm`
>（-i选项表示安装）。这应该只是在您的系统上安装程序及其附带的任何文档。如果您不确定是否已安装该程序，则可能需要使用-qa（查询/所有）选项检出已安装RPM的清单，并将输出汇总到grep。
`rpm -qa | grep mod_`
你可能得到这样的输出：
```
mod_php4-4.0.4pl1-90
mod_perl-1.25-30
mod_python-2.7.2-27
```
>如果您听说过某些与某些软件包有关的安全警报，这会派上用场。您可以准确地看到系统上的软件包和版本。如果您的版本号属于易受攻击的版本号，您可以在公司的FTP站点获取新的RPM并进行更新：

`rpm -F new_improved_package.rpm`
- RPM系统提供了一种方法来验证您下载的软件包是否真实且未被篡改。

`rpm -v -checksig some_package.rpm`


### Gentoo Linux

在Gentoo Linux发行版中，安装和更新方法称为Portage。这项工作是通过emerge命令完成的。

- 要获取最新的Gentoo包，请键入
`emerge rsync`然后
- 可以安装新包。最好
`emerge -up system`
- 使用-p选项。这将检查依赖性。
`emerge -p PACKAGE-NAME`
- 使用-u选项更新已安装的软件包。
`emerge -u PACKAGE-NAME`
有关管理Gentoo Linux系统的更多信息，您可以访问其网页的文档部分：http：// http://www.gentoo.org/main/en/docs.xml 

### 压缩包安装

- 解压
`tar -zxvpf nice_network_monitor_app.tar.gz`
`./configure`
`./make`
`./make install`

