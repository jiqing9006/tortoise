<?php
namespace Admin\Action;


use Vendor\Func\Json;

/**
 * Created by PhpStorm.
 * User: jiqing
 * Date: 18-8-10
 * Time: 上午9:24
 */

class RoleAction extends CommonAction
{
    // 未删除
    const NOT_DEL = 0;
    // 已删除
    const IS_DEL  = 1;

    public function _initialize() {
        parent::_initialize();
        $model_name = "角色";
        $this->assign('model_name',$model_name);
    }
    public function index() {
        $page = 1;
        if(!empty($_GET['page'])){
            $page=(int)$_GET['page'];
        }

        $this->assign('page',$page);

        $step = C('PAGE_NORMAL_COUNT');
        $model = D('Page');
        $start = ($page-1)*$step;
        $s_name = $_GET['s_name'];

        if ($s_name) {
            $where['name'] = $s_name;
            $this->assign('s_name', $s_name);
        }
        $where['is_del'] = self::NOT_DEL; // 未删除

        $role_model = M('role');
        $action = M('action');
        $result_list = $role_model->where($where)->limit($start.','.$step)->order('weight desc,id asc')->select();
        foreach ($result_list as $k=>&$v) {
            // 获取权限详情
            $powers = explode('-',$v['power']);
            $powers_name = [];
            foreach ($powers as $aid) {
                $name = $action->where(['id'=>$aid,'level'=>2])->getField('name');
                if ($name) {
                    $powers_name[] = $name;
                }
            }
            $v['power'] = implode('-',$powers_name);
        }
        $this->assign('result', $result_list);
        $model_flag = $model->index('role',$page,$where);
        $this->assign('allPage',$model_flag);
        $this->display();
    }

    public function edit() {
        $id=$_GET['id'];
        $page = (int)$_GET['page'];
        $this->assign('page', $page);
        $role_model = M('role');
        $role_result =$role_model->where(array('id'=>$id))->find();
        $role_result['powers'] = explode('-',$role_result['power']);

        $r_arr = array();
        $action = M('action');
        $result = $action->where(array('level'=>1))->order('weight desc')->select();
        for($i=0, $iMax = count($result); $i< $iMax; $i++){
            $r_arr[$i] = $result[$i];
            $t_result =  $action->where(array('pid'=>$result[$i]['id'],'level'=>2,'is_show'=>1))->select();
            for($z=0, $zMax = count($t_result); $z< $zMax; $z++){
                $th_result = $action->where(array('pid'=>$t_result[$z]['id'],'level'=>3,'is_show'=>1))->select();
                if($th_result){
                    for($j=0, $jMax = count($th_result); $j< $jMax; $j++){
                        $th_result[$j]['name'] =  $t_result[$z]['name'].'-'.$th_result[$j]['name'];
                        $r_arr[$i]['next'][] = $th_result[$j];
                    }
                }else{
                    $r_arr[$i]['next'][] = $t_result[$z];
                }

            }
        }
        $this->assign('r_arr',$r_arr);

        $this->assign('role_result',$role_result);
        $this->display();
    }

    public function editsave() {
        $json = new Json();
        $role_model = M('role');
        $name = trim($_POST['name']);
        if(!$name){
            $json->setErr(10001,'请填写名称');
            $json->Send();
        }

        $id = (int)$_POST['id'];
        $weight = (int)$_POST['weight'];
        $data=[
            'name'     => $name,
            'weight'   => $weight,
        ];


        // 避免名字重复
        if ($id) { // 编辑
            $count = $role_model->where(['name'=>$name,'id'=>['neq',$id],'is_del'=>0])->count();
            if ($count >0) {
                $json->setErr(10002,'名称已存在');
                $json->Send();
            }
        } else { // 添加
            $data['add_time'] = time();
            $count = $role_model->where(['name'=>$name,'is_del'=>0])->count();
            if ($count >0) {
                $json->setErr(10002,'名称已存在');
                $json->Send();
            }
        }

        $power = $_POST['power'];
        $action = M('action');
        $arr = array();
        for($i=0, $iMax = count($power); $i< $iMax; $i++){
            $result = $action->where(array('id'=>$power[$i]))->find();
            if($result['pid']!=0){
                $arr[] = $result['id'];
                $th_result = $action->where(array('id'=>$result['pid']))->find();
                if($th_result['pid']!=0){
                    $arr[] = $th_result['id'];
                    $fo_result = $action->where(array('id'=>$th_result['pid']))->find();
                    if(!$fo_result['id']){
                        $arr[] = $fo_result['id'];
                    }
                }else{
                    $arr[] = $th_result['id'];
                }
            }else{
                $arr[] = $result['id'];
            }
        }
        $arr = array_unique($arr);
        sort($arr);
        $powers = '';
        foreach($arr as $key => $value){
            $powers .= $value;
            $powers .= '-';
        }
        $powers = trim($powers,'-');
        $data['power'] = $powers;

        if ($id) {
            $role_model->where(['id'=>$id])->find();
            $role_model->where(array('id'=>$id))->save($data);
        } else {
            $res = $role_model->add($data);
            if (!$res) {
                $json->setErr(10099,'添加失败');
                $json->Send();
            }
        }

        $json->setErr(0,'操作成功');
        $json->Send();

    }

    public function del() {
        $id = $_POST['id'];
        if (!$id){
            $this->json->setErr(10001,'缺少参数');
            $this->json->Send();
        }

        // 检查是否有使用的数据，如果有则不让删除
        $this->_check_del($id);

        $role_model = M('role');
        $flag = $role_model->where('id='.$id)->save(['is_del'=>self::IS_DEL]);
        if($flag){
            $this->json->setErr(0, '删除成功');
            $this->json->Send();
        }else{
            $this->json->setErr(10099, '删除失败');
            $this->json->Send();
        }
    }


    // 检查删除
    protected function _check_del($id)
    {
        $admin_user = M('admin_user');
        $count = $admin_user->where(['role_id' => $id, 'status' => 0])->count();
        if ($count > 0) {
            $this->json->setErr(10002, '存在相应角色的管理员，不可删除');
            $this->json->Send();
        }
    }

}