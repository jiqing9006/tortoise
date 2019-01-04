<?php
namespace Index\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        echo "Index";
        $action = M('action');
        dump($action->select());

    }
}