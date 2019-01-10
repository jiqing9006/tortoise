<?php
namespace Admin\Action;

use Think\Action;
use Vendor\Func\Json;

// 本类由系统自动生成，仅供测试用途
class PublicAction extends Action {
    public function _initialize() {
        $this->assign('admin_name',C('ADMIN_NAME'));
        $this->assign('admin_logo',C('ADMIN_LOGO'));
    }
	public function login(){
		$this->display();
	}

	public function checklogin(){
		$json = new Json();
		$users=M('admin_user');
		$arr['nick_name']=trim(strtolower($_POST['nickname']));
		$arr['password']=MD5(trim($_POST['password'])); 
		$flag=$users->where($arr)->find();

		if($flag){
		    // 获取power
            $role = M('role');
            $role_info = $role->where(['id'=>$flag['role_id']])->find();

			$_SESSION['_admin_nick_name']       = $flag['nick_name'];
			$_SESSION['_admin_user_id']         = $flag['id'];
            $_SESSION['_admin_power']           = $role_info['power'];
            $_SESSION['_admin_super']           = $flag['super'];
            $_SESSION['_admin_role_id']         = $flag['role_id'];
            $_SESSION['_admin_associated_id']   = $flag['associated_id'];
			$json->setErr(10000, 'success');
			$json->Send();
			exit;
		}else{
			$this->error('登陆失败',__CONTROLLER__.'/login');
		}
	}
	
	// 用户登出
	public function logout() {
		if(isset($_SESSION['_admin_nick_name'])){
			unset($_SESSION);
			session_destroy();
			$this->success('登出成功',__CONTROLLER__.'/login');
		}else{
			$this->error('已经登出！',__CONTROLLER__.'/login');
		}
	}




}
