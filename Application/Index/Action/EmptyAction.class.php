<?php
/**
 * Created by PhpStorm.
 * User: jiqing
 * Date: 19-1-9
 * Time: 上午12:45
 */

namespace Index\Action;


use Think\Action;

class EmptyAction extends Action
{
    public function _empty(){
        echo '这是一个空控制器';
    }
}