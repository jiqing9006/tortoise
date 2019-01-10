<?php
namespace Admin\Action;


class IndexAction extends CommonAction
{
    public function index()
    {
//        echo __ROOT__."</br>"; // 网站根目录地址
//        echo __APP__."</br>"; // 当前项目（入口文件）地址
//        echo __CONTROLLER__."</br>"; // 当前模块地址
//        echo __ACTION__."</br>"; // 当前操作地址
//        echo __SELF__."</br>"; // 当前 URL 地址
        $this->display();
    }
}