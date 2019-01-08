<?php
// 公用的配置，所有的模块都可以使用
// 惯例配置->应用配置->模式配置->调试配置->状态配置->模块配置->扩展配置->动态配置
return array(
	//'配置项'=>'配置值'
    'DEFAULT_C_LAYER'=>'Action', // 设置为3.1
    'SESSION_AUTO_START' => true, //是否开启session

    // 加载扩展配置文件
    'LOAD_EXT_CONFIG' => 'db,user',








);