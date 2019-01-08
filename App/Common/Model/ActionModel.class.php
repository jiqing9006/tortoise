<?php
// 数据层

namespace Common\Model;

use Think\Model;

class ActionModel extends Model{
    protected $tablePrefix = 'tf_';
    protected $pk     = 'id';
    // 获取列表
    public function getList() {
        return $this->select();
    }
}