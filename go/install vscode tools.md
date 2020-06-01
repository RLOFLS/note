###

## 手动安装

```
  gocode
  gopkgs
  go-outline
  go-symbols
  guru
  gorename
  gotests
  gomodifytags
  impl
  fillstruct
  goplay
  godoctor
  dlv
  gocode-gomod
  godef
  golint
```

#### 克隆工具包 .. (未有安装包 就上github上找)

##### 在 $GOPATH/src/golang.org/x/ 克隆工具包

- git clone https://github.com/golang/tools.git
```

```

- git clone https://github.com/golang/mod.git
- git clone https://github.com/golang/xerrors.git

```
go install golang.org/x/tools/cmd/guru
go install github.com/cweill/gotests/...
go install github.com/josharian/impl
```



```
go install github.com/davidrjenni/reftools/cmd/fillstruct
```



```
go install github.com/haya14busa/goplay/cmd/goplay 
-> go get -u github.com/haya14busa/goplay
```

- (cd $GOPATH/src/github.com) 再 git clone https://github.com/godoctor/godoctor.git godoctor/

```
go install github.com/godoctor/godoctor
```

- (cd $GOPATH/src/github.com) 再 git clone https://github.com/go-delve/delve.git go-delve/
```
go install github.com/go-delve/delve/cmd/dlv
-> go get -u github.com/go-delve/delve

```

go install github.com/stamblerre/gocode

- git clone https://github.com/rogpeppe/godef.git
```
go install github.com/rogpeppe/godef
```
