<?php
namespace Index\Action;

use Common\Model\ActionModel;
use Common\Service\UserService;
use My\Test;
use Think\Action;
use Vendor\Func\Func;

class IndexAction extends Action
{
    public function index()
    {
        echo "Index";
//        $action = new ActionModel();
//        $data_list = $action->getList();
//        dump($data_list);

//        $userService = new UserService();
//        $data_list = $userService->getList();
//        dump($data_list);

        $test = new Test();
        $test->sayHello();

//        vendor('Func.Func');
        echo Func::getHostName();

        echo C('APP_NAME');
    }
}