<?php
namespace Admin\Action;

/**
 * Created by PhpStorm.
 * User: tankang
 * Date: 2017/1/24
 * Time: 下午7:13
 */
class PrivAction extends CommonAction
{
    public function index(){
        $admin_user = M('admin_user');
        $page = 1;
        if( !empty($_GET['page']) ) {
            $page = $_GET['page'];
        }
        $step = C('PAGE_NORMAL_COUNT');
        $model_page = D("Page");
        $start = ($page - 1) * $step;
        $result = $admin_user->order('id desc')->limit($start . ',' . $step )->select();
        $role = M('role');
        foreach ($result as $k=>&$v) {
            $role_name = $role->where(['id'=>$v['role_id']])->getField('name');
            $v['role_name'] = $role_name?$role_name:'';
            $v['associated_name'] = $this->getAssociatedName($v['role_id'],$v['associated_id']);
        }
        $all_page = $model_page->index('admin_user', $page);
        $this->assign('result', $result);
        $this->assign('allPage', $all_page);
        $this->assign('page',$page);


        $this->display();
    }

    public function priv_list(){
        $action = M('action');
        $result = $action->where(array('level'=>1))->select();
        $r_arr = array();
        for($i=0, $iMax = count($result); $i< $iMax; $i++){
            $r_arr[] = $result[$i];
            $t_result =  $action->where(array('pid'=>$result[$i]['id'],'level'=>2))->select();
            for($z=0, $zMax = count($t_result); $z< $zMax; $z++){
                $r_arr[] = $t_result[$z];
                $th_result = $action->where(array('pid'=>$t_result[$z]['id'],'level'=>3))->select();
                for($j=0, $jMax = count($th_result); $j< $jMax; $j++){
                    $r_arr[] = $th_result[$j];
                }
            }
        }
        $this->assign('r_arr',$r_arr);
        $this->display();
    }

    public function add(){
        // 获取角色列表
        $role = M('role');
        $role_id_name = $role->field('id,name')->select();
        $this->assign('role_id_name',$role_id_name);

        $this->display();
    }

    public function save(){
        $error = array('status' => 0, 'message' => '缺少必填项：');
        $success = array('status' => 1, 'message' => '添加成功');
        $nick_name = trim($_POST['nick_name']);
        if(!$nick_name){
            $error['parameter'] = '用户昵称';
            $this->say($error);
        }
        $password = trim($_POST['password']);
        if( empty($password) ) {
            $error['parameter'] = '密码';
            $this->say($error);
        }

        $re_password = trim($_POST['re_password']);
        if( empty($re_password) ) {
            $error['parameter'] = '再输入一次密码';
            $this->say($error);
        }

        if($password != $re_password){
            $error['message'] = '两次输入的密码不一致';
            $this->say($error);
        }

        $email = trim($_POST['email']);

        $role_id = trim($_POST['role_id']);
        if( empty($role_id) ) {
            $error['parameter'] = '角色';
            $this->say($error);
        }

        $associated_id = trim($_POST['associated_id']);
        if( empty($associated_id) ) {
            $error['parameter'] = '关联内容';
            $this->say($error);
        }

        $data = [
            'nick_name'     => $nick_name,
            'password'      => md5($password),
            'create_time'   => time(),
            'email'         => $email,
            'super'         => 0,
            'status'        => 0,
            'role_id'       => $role_id,
            'associated_id' => $associated_id
        ];
        $admin_user = M('admin_user');
        $flag = $admin_user->add($data);
        if(!$flag){
            $error['message'] = '添加失败';
            $this->say($error);
        }
        $this->say($success);
    }

    public function del(){
        $id = trim($_GET['id']);
        if(!$id){
            $this->error('请输入id');
        }
        $admin_user = M('admin_user');
        $result = $admin_user->where(array('id'=>$id))->find();
        if(!$result){
            $this->error('没有此用户,请重新输入');
        }else{
            $flag = $admin_user->where(array('id'=>$id))->delete();
            if($flag){
                $this->success('删除成功','index');
            }else{
                $this->error('删除失败','index');
            }
        }
    }

    public function edit(){

        $id = trim($_GET['id']);
        $admin_user = M('admin_user');
        $user_result = $admin_user->where(array('id'=>$id))->find();
        $this->assign('user_result',$user_result);

        $role = M('role');
        $role_id_name = $role->field('id,name')->select();
        $this->assign('role_id_name',$role_id_name);

        $this->display();
    }

    public function save_edit(){
        $error = array('status' => 0, 'message' => '缺少必填项：');
        $success = array('status' => 1, 'message' => '保存成功');
        $user_id = trim($_POST['user_id']);
        if(!$user_id){
            $error['message'] = '输入非法';
            $this->say($error);
        }

        $nick_name = trim($_POST['nick_name']);
        if(!$nick_name){
            $error['parameter'] = '用户昵称';
            $this->say($error);
        }

        $email = trim($_POST['email']);

        $role_id = trim($_POST['role_id']);
        if( empty($role_id) ) {
            $error['parameter'] = '角色';
            $this->say($error);
        }

        $associated_id = trim($_POST['associated_id']);
        if( empty($associated_id) ) {
            $error['parameter'] = '关联内容';
            $this->say($error);
        }


        $data = [
            'nick_name'     => $nick_name,
            'email'         => $email,
            'super'         => 0,
            'status'        => 0,
            'role_id'       => $role_id,
            'associated_id' => $associated_id
        ];
        $admin_user = M('admin_user');
        $flag = $admin_user->where(array('id'=>$user_id))->save($data);
        if(!$flag){
            $error['message'] = '保存失败';
            $this->say($error);
        }
        $this->say($success);
    }

    public function pass_reset(){
        $id = trim($_GET['id']);
        if(!$id){
            $this->error('请输入id');
        }

        $admin_user = M('admin_user');
        $result = $admin_user->where(array('id'=>$id))->find();
        if(!$result){
            $this->error('没有此用户,请重新输入');
        }else{
            $result['password'] = md5('123456');
            $admin_user->where(array('id'=>$id))->save($result);
            $this->success('重置成功','index');
        }
    }

    // 获取名称
    public function getAssociatedName($role_id,$associated_id) {
        switch ($role_id) {
            case 1:
                // 区域
                $area = M('area');
                $area_info = $area->where(['id'=>$associated_id])->find();
                return $area_info['name'];
                break;
            case 2:
                // 学校
                $school = M('school');
                $school_info = $school->where(['id'=>$associated_id])->find();
                return $school_info['name'];
                break;
            case 3:
                // 年级
                $grade = M('grade');
                $grade_info = $grade->where(['id'=>$associated_id])->find();

                $school = M('school');
                $school_name = $school->where(['id'=>$grade_info['school_id']])->getField('name');
                $grade_info['name'] = $school_name.'-'.$grade_info['name'];
                return $grade_info['name'];
                break;
            case 4:
                // 班级
                $class = M('class');
                $class_info = $class->where(['id'=>$associated_id])->find();

                $school = M('school');
                $school_name = $school->where(['id'=>$class_info['school_id']])->getField('name');
                $grade = M('grade');
                $grade_name = $grade->where(['id'=>$class_info['grade_id']])->getField('name');
                $class_info['name'] = $school_name.'-'.$grade_name.'-'.$class_info['name'];
                return $class_info['name'];
                break;
        }
    }

    // 获取数据
    public function getRoleIdName() {
        $role_id = trim($_POST['role_id']);
        switch ($role_id) {
            case 1:
                // 区域
                $this->getAreaIdName();
                break;
            case 2:
                // 学校
                $this->getSchoolIdName();
                break;
            case 3:
                // 年级
                $this->getGradeIdName();
                break;
            case 4:
                // 班级
                $this->getClassIdName();
                break;
        }
    }

    protected function getAreaIdName() {
        $area = M('area');
        $data_id_name = $area->where(['is_show'=>1,'is_del'=>0])
            ->order('weight desc,id asc')
            ->field('id,name')
            ->select();

        $this->json->setAttr('data',$data_id_name);
        $this->json->Send();
    }

    protected function getSchoolIdName() {
        $school = M('school');
        $data_id_name = $school->where(['is_show'=>1,'is_del'=>0])
            ->order('weight desc,id asc')
            ->field('id,name')
            ->select();

        $this->json->setAttr('data',$data_id_name);
        $this->json->Send();
    }

    protected function getGradeIdName() {
        $grade = M('grade');
        $data_id_name = $grade->where(['is_show'=>1,'is_del'=>0])
            ->order('weight desc,id asc')
            ->field('id,school_id,name')
            ->select();
        $school = M('school');
        foreach ($data_id_name as $k=>&$v) {
            $school_name = $school->where(['id'=>$v['school_id']])->getField('name');
            $v['name'] = $school_name.'-'.$v['name'];
        }

        $this->json->setAttr('data',$data_id_name);
        $this->json->Send();
    }

    protected function getClassIdName() {
        $class = M('class');
        $data_id_name = $class->where(['is_show'=>1,'is_del'=>0])
            ->order('weight desc,id asc')
            ->field('id,school_id,grade_id,name')
            ->select();
        $school = M('school');
        $grade = M('grade');
        foreach ($data_id_name as $k=>&$v) {
            $school_name = $school->where(['id'=>$v['school_id']])->getField('name');
            $grade_name = $grade->where(['id'=>$v['grade_id']])->getField('name');
            $v['name'] = $school_name.'-'.$grade_name.'-'.$v['name'];
        }

        $this->json->setAttr('data',$data_id_name);
        $this->json->Send();
    }
}