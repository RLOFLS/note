#### 禁用ipv6

- 临时性

```
sudo sysctl -w net.ipv6.conf.all.disable_ipv6=1
sudo sysctl -w net.ipv6.conf.default.disable_ipv6=1
sudo sysctl -w net.ipv6.conf.lo.disable_ipv6=1
```

> 重启tim

- 方法二 

  ```
  sudo vim /etc/default/grub
  找到GRUB_CMDLINE_LINUX_DEFAULT="quiet spalsh"
  改为 GRUB_CMDLINE_LINUX_DEFAULT="ipv6.disable=1 quiet spalsh"
  sudo update-grub
  ```

  

