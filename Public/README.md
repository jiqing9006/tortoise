CBD（核心Core+行为Behavior+驱动Driver）

3.2版本全面采用命名空间方式定义和加载类库文件，有效的解决多个模块之间的冲突问题，并且实现了更加高效的类库自动加载机制。

根命名空间是一个关键的概念，以上面的Org\Util\File类为例，Org就是一个根命名空间，其对应的初始命名空间目录就是系统的类库目录（ThinkPHP/Library），Library目录下面的子目录会自动识别为根命名空间，这些命名空间无需注册即可使用。


### 手动引入
// 导入Org类库包 Library/Org/Util/Date.class.php类库
import("Org.Util.Date");
// 导入Home模块下面的 Application/Home/Util/UserUtil.class.php类库
import("Home.Util.UserUtil");
// 导入当前模块下面的类库 
import("@.Util.Array");
// 导入Vendor类库包 Library/Vendor/Zend/Server.class.php
import('Vendor.Zend.Server');

// 缓存机制
编译缓存的基础原理是第一次运行的时候把核心需要加载的文件去掉空白和注释后合并到一个文件中，第二次运行的时候就直接载入编译缓存而无需载入众多的核心文件。当第二次执行的时候就会根据当前的应用模式直接载入编译过的缓存文件，从而省去很多IO开销，加快执行速度。
项目编译机制对运行没有任何影响，预编译机制只会执行一次，因此无论在预编译过程中做了多少复杂的操作，对后面的执行没有任何效率的缺失。
编译缓存文件默认生成在应用目录的Runtime目录下面，我们可以在Application/Runtime目录下面看到有一个common~runtime.php文件，这个就是普通模式的编译缓存文件。如果你当前运行在其他的应用模式下面，那么编译缓存文件就是：应用模式~runtime.php

### 实例化模型
D方法实例化模型类的时候通常是实例化某个具体的模型类，如果你仅仅是对数据表进行基本的CURD操作的话，使用M方法实例化的话，由于不需要加载具体的模型类，所以性能会更高。

如果你仅仅是使用原生SQL查询的话，不需要使用额外的模型类，实例化一个空模型类即可进行操作了，例如：
//实例化空模型
$Model = new Model();
//或者使用M快捷方法是等效的
$Model = M();
//进行原生的SQL查询
$Model->query('SELECT * FROM think_user WHERE status = 1');

#### 常量输出
还可以输出常量
{$Think.const.MODULE_NAME}
或者直接使用
{$Think.MODULE_NAME}

#### 配置输出
输出配置参数使用：
{$Think.config.db_charset}
{$Think.config.url_model}

#### 配置语言
输出语言变量可以使用：
{$Think.lang.page_error}
{$Think.lang.var_error}

#### 模板替换
```
__ROOT__： 会替换成当前网站的地址（不含域名） 
__APP__： 会替换成当前应用的URL地址 （不含域名）
__MODULE__：会替换成当前模块的URL地址 （不含域名）
__CONTROLLER__（__或者__URL__ 兼容考虑）： 会替换成当前控制器的URL地址（不含域名）
__ACTION__：会替换成当前操作的URL地址 （不含域名）
__SELF__： 会替换成当前的页面URL
__PUBLIC__：会被替换成当前网站的公共目录 通常是 /Public/
```
