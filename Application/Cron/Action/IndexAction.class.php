<?php
namespace Cron\Action;

use Think\Action;

class IndexAction extends Action
{
    public function index()
    {
        echo "Cron";
    }
}