<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    die('require PHP > 5.3.0 !');
}

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG', true);


// 定义应用目录
define('BIND_MODULE','Cron');
define('APP_PATH', '../Application/');
define('__APP__',$_SERVER["SCRIPT_NAME"]);

// 引入ThinkPHP入口文件
require("../ThinkPHP/Library/Vendor/Qiniu/autoload.php");
require '../ThinkPHP/ThinkPHP.php';

