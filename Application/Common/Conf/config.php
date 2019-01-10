<?php
// 公用的配置，所有的模块都可以使用
// 惯例配置->应用配置->模式配置->调试配置->状态配置->模块配置->扩展配置->动态配置
return array(
	//'配置项'=>'配置值'
    'DEFAULT_C_LAYER'=>'Action', // 设置为3.1
    'SESSION_AUTO_START' => true, //是否开启session

    // 加载扩展配置文件
    'LOAD_EXT_CONFIG' => 'db,user',

    // 伪静态后缀
    'URL_HTML_SUFFIX'=>'',

    //默认错误跳转对应的模板文件
    'TMPL_ACTION_ERROR' => THINK_PATH . 'Tpl/dispatch_jump.tpl',
    //默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => THINK_PATH . 'Tpl/dispatch_jump.tpl',

    'DEFAULT_V_LAYER'       =>  'Tpl', // 设置默认的视图层名称

    'TMPL_L_DELIM'=>'{',
    'TMPL_R_DELIM'=>'}',

    // 显示页面Trace信息
    'SHOW_PAGE_TRACE' =>true,

    'LANG_SWITCH_ON' => true,   // 开启语言包功能
    'DEFAULT_LANG'      => 'zh-cn',              // 默认语言
    'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
    'LANG_LIST'        => 'zh-cn,en-us', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE'     => 'l', // 默认语言切换变量





);