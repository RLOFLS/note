1.安装netbeans

从netbeans官网download安装包http://netbeans.org/downloads/index.html，解压安装，命令如下：

#sh ~/software/netbeans-7.0.1-ml-Linux.sh

2. 修改netbeans配置文件

命令如下：

# vim ~/netbeans-7.0.1/etc/netbeans.conf

在

netbeans_default_options="....."
里面添加参数

"-J-Dswing.aatext=true -J-Dawt.useSystemAAFontSettings=lcd"
代码如下

netbeans_default_options="-J-client -J-Xss2m -J-Xms32m -J-XX:PermSize=32m -J-Dapple.laf.useScreenMenuBar=true -J-Dapple.awt.graphics.UseQuartz=true -J-Dsun.java2d.noddraw=true -J-Dswing.aatext=true -J-Dawt.useSystemAAFontSettings=lcd"
(* 至于为什么要加这两个参数，大家可以去google下)

如此一来，代码锯齿的问题是解决了，但是netbeans界面字体也不是很好，比如菜单栏,dialog等界面自动都是默认的宋体,如何能跟ubuntu一样使用文泉驿正黑呢，遂研究了下netbeans和Zend Studio的不同之处, netbeans依赖于JVM，当我打开JVM的时候发现JVM的界面跟netbeans的界面十分相似，于是便着手解决JVM的字体优化。

3.更改JVM字体设置

命令如下：

# sudo vim /usr/lib/jvm/JAVA-6-sun/jre/lib/swing.properties

将第二行的注释符号去掉

代码如下：

swing.defaultlaf=com.sun.java.swing.plaf.gtk.GTKLookAndFeel
意思就是使JVM运行的时候继承GTK的风格外观等，将JVM默认的Ubuntu字体设置去掉

命令如下：

#sudo mv fontconfig.Ubuntu.properties.src fontconfig.Ubuntu.properties.src.bak #sudo mv fontconfig.Ubuntu.bfc fontconfig.Ubuntu.bfc.bak

编辑fontconfig.properties文件，命令如下：

# sudo gedit /usr/lib/jvm/java-6-sun/jre/lib/fontconfig.properties

找到Font file Names的地方,把前两行的字体路径替换成你想要的，代码如下：

filename.-arphic-ar_pl_shanheisun_uni-medium-r-normal--*-*-*-*-p-*-iso10646-1=/usr/share/fonts/truetype/wqy/wqy-microhei.ttcfilename.-arphic-ar_pl_uming_uni-medium-r-normal--*-*-*-*-p-*-iso10646-1=/usr/share/fonts/truetype/wqy/wqy-microhei.ttc