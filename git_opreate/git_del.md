**2. 删除远程分支和Tag**

2.1 在Git v1.7.0之后

删除远程分支：

```
git push origin --delete <branchName>
```

删除Tag：

```
git push origin --delete tag <tagname>
```

2.2 在Git v1.7.0之前

删除远程分支（推送一个空分支到远程分支，其实相当于删除远程分支）：

```
git push origin :<branchName>
```

删除远程Tag（推送一个空tag到远程tag，其实相当于删除远程tag）：

```
git tag -d <tagname>``git push origin :refs``/tags/``<tagname>
```

**3. 重命名远程分支**

在Git中重命名远程分支，其实就是先删除远程分支，然后重命名本地分支，再重新提交一个远程分支。

```
xiaosi@Q:~``/code/qt``$ git branch -av``* dev           8d807de MOD`` ``master           f600e50 code change during build`` ``remotes``/origin/HEAD`       `-> origin``/master`` ``remotes``/origin/dev`        `8d807de MOD`` ``remotes``/origin/master`       `f600e50 code change during build
```

删除远程分支：

```
git push --delete origin dev
```

重命名本地分支：

```
git branch -m dev develop
```

推送本地分支：

```
git push origin develop
```