### 面向对象编程 OOP (object oriented programming)

#### 魔术方法 

[demo](./code/MagicMethod.php)

```
__construct ([ mixed $args [, $... ]] ) : void //PHP 5 允行开发者在一个类中定义一个方法作为构造函数。具有构造函数的类会在每次创建新对象时先调用此方法，所以非常适合在使用对象之前做一些初始化工作。
__destruct ( void ) : void //PHP 5 引入了析构函数的概念，这类似于其它面向对象的语言，如 C++。析构函数会在到某个对象的所有引用都被删除或者当对象被显式销毁时执行。

public __set ( string $name , mixed $value ) : void //在给不可访问属性赋值时，__set() 会被调用。
public __get ( string $name ) : mixed //读取不可访问属性的值时，__get() 会被调用。
public __isset ( string $name ) : bool //当对不可访问属性调用 isset() 或 empty() 时，__isset() 会被调用。
public __unset ( string $name ) : void //当对不可访问属性调用 unset() 时，__unset() 会被调用。

public __call ( string $name , array $arguments ) : mixed //在对象中调用一个不可访问方法时，__call() 会被调用。
public static __callStatic ( string $name , array $arguments ) : mixed //在静态上下文中调用一个不可访问方法时，__callStatic() 会被调用。

__sleep ( void ) : array   //当序列化是会调用 返回对应需要序列化的属性， 如果不返回则不会被序列化
__wakeup ( void ) : void //当反序列化是会调用

__toString ( void ) : string //方法用于一个类被当成字符串时应怎样回应。例如 echo $obj; 应该显示些什么。此方法必须返回一个字符串，否则将发出一条 E_RECOVERABLE_ERROR 级别的致命错误。

__invoke ([ $... ] ) : mixed //当尝试以调用函数的方式调用一个对象时，__invoke() 方法会被自动调用。只接受第一个参数

static __set_state ( array $properties ) : object //自 PHP 5.1.0 起当调用 var_export() 导出类时，此静态 方法会被调用。
__debugInfo ( void ) : array //This method is called by var_dump() when dumping an object to get the properties that should be shown. If the method isn't defined on an object, then all public, protected and private properties will be shown.

__clone ( void ) : void //当复制完成时，如果定义了 __clone() 方法，则新创建的对象（复制生成的对象）中的 __clone() 方法会被调用，可用于修改属性的值（如果有必要的话）。
```

#### 继承 与组合
- 继承
```
class A {}
class B extends A {}
```
- 组合
```
class A {}
class B {

    public function useA() {
        $a = new A();
        ...
    }
}
```

#### 多态
[demo](./code/Polymorphic.php)
```
<?php

interface IEmployee {
    public function working();
}

class Teacher implements IEmployee {

    public function working()
    {
        echo '教书'.PHP_EOL;
    }
}

class Manager implements IEmployee {

    public function working()
    {
        echo '管理'.PHP_EOL;
    }
}

class Work {

    public static function doWork(IEmployee $employee) {
        $employee->working();
    }
}

$teacher = new Teacher();
$manager = new Manager();

Work::doWork($teacher);
Work::doWork($manager);
```

#### 面向接口编程

接口是一中契约，应该不能打破
- 不好的
```
interface A {
    public function run();
}

class C implements A {
    public function run(){
        ...
    }
}

class C2 implements A {
    public function run(){
        ...
    }

    public function work(){  //这样就破块的契约
        ...
    }
}
```

- 好的
```
interface A {
    public function run();
}

interface B {
    public function work();
}

class C implements A {
    public function run(){
        ...
    }
}

class C2 implements A, B{
    public function run(){
        ...
    }

    public function work(){  
        ...
    }
}
```

#### 反射

hook 插件扩展，动态代理

[demo](./code/ReflectProxy.php)

#### 异常

[demo](./code/Exceptiondemo.php)
Excetion

#### 错误级别

deprecated ,notice ,warning, fetal error 
[demo](./code/errorDemo.php)
- 设置显示错误

```
error_reporting = E_ALL | E_STRICT
display_errors = on 

log_errors = on
error_log = /

error_reporting(1);

//屏蔽 error_reporting(0)  / @

```