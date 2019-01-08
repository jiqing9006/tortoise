<?php
// 数据层

namespace Common\Model;

use Think\Model;

class ActionModel extends Model{
    // 获取列表
    public function getList() {
        return $this->select();
    }
}