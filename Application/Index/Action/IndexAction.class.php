<?php
namespace Index\Action;

use Think\Action;
use Common\Model\ActionModel;
use Common\Service\UserService;
use Vendor\Func\Func;
use Vendor\Log\Clog;

class IndexAction extends Action
{
    public function index()
    {
        $this->display();
    }

    public function set_name() {
        session('name','value');  //设置session
    }

    public function get_name() {
        echo session('name');
    }

    public function _empty($name){
        echo 'action不存在';
    }
}