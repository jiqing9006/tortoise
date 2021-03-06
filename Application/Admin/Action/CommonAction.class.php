<?php
namespace Admin\Action;

use Org\Net\UploadFile;
use Think\Action;
use Vendor\Func\Func;
use Vendor\Func\Json;
use Vendor\Func\Uploader;
use Vendor\Log\Clog;
use Vendor\Qiniu\Qiniu;

// 本类由系统自动生成，仅供测试用途
class CommonAction extends Action {
    // 未删除
    const NOT_DEL = 0;
    // 已删除
    const IS_DEL  = 1;
    protected $json;
    public function _initialize() {
        header("Content-type: text/html; charset=utf-8");
        if(!$_SESSION['_admin_nick_name'] && !$_SESSION['_admin_user_id']){
            $this->redirect(__ROOT__.'/Public/login');
        }

        // 定义公用的json
        $this->json = new Json();

        $this->assign('hostname',Func::getHostName());
        $action = M('action');
        $c_left_act_result = $this->_get_left_menu();   //查询url

        if($c_left_act_result['level']==3){
            $r_result = $action->where(array('id'=>$c_left_act_result['pid']))->find();
            $first_result = $action->where(array('id'=>$r_result['pid']))->find();
        }else{
            $first_result = $action->where(array('id'=>$c_left_act_result['pid']))->find(); //找出所属的一级分类
            $r_result = $first_result;
        }


        if(!$_SESSION['_admin_super']){
            $power = explode('-',$_SESSION['_admin_power']);
            $c_action_result = array();
            for($i=0, $iMax = count($power); $i< $iMax; $i++){
                $result = $action->where(array('id'=>$power[$i]))->find();

                if($result['pid']==0){
                    if($result['id'] ==  $first_result['id']){
                        $result['is_chose'] = 1;
                    }else{
                        $result['is_chose'] = 0;
                    }
                    $c_action_result[] = $result;
                }
            }

            $this->assign('c_action_result',$c_action_result);

            $c_left_menus = $action->where(array('pid'=>$first_result['id'],'is_show'=>1))->select();  //找二级

            $c_left_menu = array();
            for($j=0, $jMax = count($c_left_menus); $j< $jMax; $j++){
                if(in_array($c_left_menus[$j]['id'],$power)){

                    $t_menu = $action->where(array('pid'=>$c_left_menus[$j]['id'],'is_show'=>1))->select();
                    if($t_menu){
                        for($k=0, $kMax = count($t_menu); $k< $kMax; $k++){
                            if($t_menu[$k]['id'] ==  $c_left_act_result['id']){
                                $t_menu[$k]['is_chose'] = 1;
                            }else{
                                $t_menu[$k]['is_chose'] = 0;
                            }

                            if(in_array($t_menu[$k]['id'],$power)){
                                $c_left_menus[$j]['t_menu'][] = $t_menu[$k];
                            }
                        }
                    }
                    if($c_left_act_result['level']==2) {
                        if ($c_left_menus[$j]['id'] == $c_left_act_result['id']) {
                            $c_left_menus[$j]['is_chose'] = 1;
                        } else {
                            $c_left_menus[$j]['is_chose'] = 0;
                        }
                    }elseif($c_left_act_result['level']==3) {
                        if($c_left_menus[$j]['id'] == $r_result['id']){
                            $c_left_menus[$j]['is_chose'] = 1;
                        }else{
                            $c_left_menus[$j]['is_chose'] = 0;
                        }
                    }

                    $c_left_menu[] = $c_left_menus[$j];
                }
            }

            $this->assign('c_left_menu',$c_left_menu);


        }else{
            //搜索出一级列表
            $c_action_result = $action->where(array('pid'=>0,'level'=>1,'is_show'=>1))->order('weight desc,id asc')->select();
            for($i=0, $iMax = count($c_action_result); $i< $iMax; $i++){
                if($c_action_result[$i]['id'] == $r_result['id']){
                    $c_action_result[$i]['is_chose'] = 1;
                }else{
                    $c_action_result[$i]['is_chose'] = 0;
                }
            }
            if($c_left_act_result['level']==2){
                $c_left_menu = $action->where(array('pid'=>$first_result['id'],'is_show'=>1))->order('weight desc,id asc')->select();  //找二级
            }elseif($c_left_act_result['level']==3){
                $c_left_menu = $action->where(array('pid'=>$r_result['pid'],'is_show'=>1))->order('weight desc,id asc')->select();  //找三级
            }

            for($j=0, $jMax = count($c_left_menu); $j< $jMax; $j++){
                $t_menu = $action->where(array('pid'=>$c_left_menu[$j]['id'],'is_show'=>1))->select();

                if($t_menu){
                    for($t=0, $tMax = count($t_menu); $t< $tMax; $t++){
                        if($c_left_act_result['id']==$t_menu[$t]['id']){
                            $t_menu[$t]['is_chose'] = 1;
                        }else{
                            $t_menu[$t]['is_chose'] = 0;
                        }
                    }
                    $c_left_menu[$j]['t_menu'] = $t_menu;
                }
                if($c_left_act_result['level']==2) {
                    if ($c_left_menu[$j]['id'] == $c_left_act_result['id']) {
                        $c_left_menu[$j]['is_chose'] = 1;
                    } else {
                        $c_left_menu[$j]['is_chose'] = 0;
                    }
                }elseif($c_left_act_result['level']==3){

                    if ($c_left_menu[$j]['id'] == $r_result['id']) {
                        $c_left_menu[$j]['is_chose'] = 1;
                    } else {
                        $c_left_menu[$j]['is_chose'] = 0;
                    }
                }
            }


            $this->assign('c_left_menu',$c_left_menu);
            $this->assign('c_action_result',$c_action_result);
            $this->assign('fe_host',C('FE_HOST'));
            $this->assign('admin_name',C('ADMIN_NAME'));
            $this->assign('admin_logo',C('ADMIN_LOGO'));
        }
    }

    public function say($data) {
        $json = new Json();
        $json->setAttrArray($data);
        $json->send();
    }


    /**
     * @param $ksize
     * @param $widths
     * @param $heights
     * @param $folders
     * @return mixed
     * 上传方法    大小,宽度,高度,文件夹
     */
    public function upload($ksize, $widths, $heights, $folders, $name = 'file',$type='cdn'){
        // 大小校验
        if($_FILES[$name]['size'] > 1024000){
            $res['error'] = '图片质量大小不能超过1M！';
            return $res;
        }

        // 尺寸校验
        if($ksize == 1){ // 宽高都限制
            $size = getimagesize($_FILES[$name]['tmp_name']);
            $width = $size[0];
            $height = $size[1];
            if((int)$width != (int)$widths || (int)$height != (int)$heights){
                $res['error']='尺寸不合要求!';
                return $res;
            }
        }elseif($ksize == 2){ // 只限制高度
            $size = getimagesize($_FILES[$name]['tmp_name']);
            $height = $size[1];
            if($height != $heights){
                $res['error']='尺寸不合要求!';
                return $res;
            }
        }

        $upload = new UploadFile();								// 实例化上传类
        $upload->maxSize  = 314572800;						// 设置附件上传大小 3*1024*1024 3M
        $upload->saveRule = time().'_'.mt_rand(); // uniqid
        $upload->savePath =  "site_upload/".$folders.'/'.date('Ymd',time()).'/';// 设置附件上传目录
        if (!is_dir($upload->savePath)){
            if (!mkdir($concurrentDirectory = './' . $upload->savePath, 0777, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
        $upload->upload();
        $info = $upload->getUploadFileInfo();//取得成功上传的文件信息
        if($info){
            if ($type == 'cdn') {
                $qiniu = new Qiniu();
                $img =  C('SF_HOST'). $upload->savePath . $info[0]['savename'];
                $ext = pathinfo($img, PATHINFO_EXTENSION);
                $name = time() . mt_rand() . '.' . $ext;
                $s = $qiniu->up($img, $name, C('QINIU.BUCKET'));
                if($s){
                    @unlink('./' .$info[0]['savepath'] . $info[0]['savename']);
                    $res['msg']='ok';
                    $res['save_name'] = C('CDN_HOST') . $name;
                }else{
                    @unlink('./' .$info[0]['savepath'] . $info[0]['savename']);
                    $res['error'] = '上传失败!!';
                }
            } else {
                $res['msg']='ok';
                $res['save_name'] = $upload->savePath . $info[0]['savename'];
                $res['ext']       = pathinfo($res['save_name'], PATHINFO_EXTENSION);
            }
        }else{
            $res['error']=$upload->getErrorMsg();
        }
        return $res;
    }


    /**
     * @param $folders 文件夹名称
     * @param string $name 文件名称
     * @param array $allowExts 允许上传的类型
     * @return mixed
     */
    public function upload_file($folders, $name = 'file' ,$allowExts = ['pdf'] ,$max_size = 51200000 ){
        if($_FILES[$name]['size'] > $max_size){
            $res['error'] = '文件大小不能超过50M！';
            return $res;
        }
        $upload = new UploadFile();								// 实例化上传类
        $upload->allowExts = $allowExts;                        // 允许上传的文件格式
        $upload->maxSize  = $max_size;						    // 设置附件上传大小
        $upload->saveRule = time().'_'.mt_rand(); // 'uniqid'
        $date_folders = date('Ymd',time());
        $upload->savePath =  "site_upload/".$folders.'/'.$date_folders.'/';// 设置附件上传目录
        if (!is_dir($upload->savePath)){
            if (!mkdir($concurrentDirectory = './' . $upload->savePath, 0777, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }
        $upload->upload();
        $info = $upload->getUploadFileInfo();//取得成功上传的文件信息
        if($info){
            $qiniu = new Qiniu();
            $file =  C('SF_HOST'). $upload->savePath . $info[0]['savename'];
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $name = time() . mt_rand() . '.' . $ext;
            $success = $qiniu->up($file, $name, C('QINIU.BUCKET'));
            if($success){
                @unlink('./' .$info[0]['savepath'] . $info[0]['savename']);
                $res['msg']='ok';
                $res['save_name'] = C('CDN_HOST') . $name;
            }else{
                @unlink('./' .$info[0]['savepath'] . $info[0]['savename']);
                $res['error'] = '上传失败!!';
            }
        }else{
            $res['error']=$upload->getErrorMsg();
        }
        return $res;
    }


    public function wang_editor(){
        $config = array(
            "savePath" => "./site_upload/wang_editor/" ,             //存储文件夹
            "maxSize" => 1000000 ,                   //允许的文件最大尺寸，单位KB
            "allowFiles" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" )  //允许的文件格式
        );

        if (!is_dir($config['savePath'])){
            if (!mkdir($concurrentDirectory = $config['savePath'], 0777, true) && !is_dir($concurrentDirectory)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
            }
        }

        $up = new Uploader( "editor_img" , $config );
        $info = $up->getFileInfo();

        $info['url'] = substr($info['url'],1);
        $host_name = Func::getHostName();
        $url = 'http://' . $host_name . $info['url'];
        $qiniu = new Qiniu();
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $name = time() . mt_rand() . '.' . $ext;
        $s = $qiniu->up($url, $name, C('QINIU.BUCKET'));
        if($s){
            @unlink('.'.$info['url']);
            $info['url'] = C('CDN_HOST').$name;
        }
        if ($info) {
            $this->json->setAttr('data',[$info['url']]);
            $this->json->Send();
        } else {
            $this->json->setErr(10099,'上传失败');
            $this->json->Send();
        }
    }

    public function ck_editor(){
        $config = array(
            "savePath" => "./site_upload/ck_editor/" ,             //存储文件夹
            "maxSize" => 1000000 ,                   //允许的文件最大尺寸，单位KB
            "allowFiles" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" )  //允许的文件格式
        );

        $up = new Uploader( "upload" , $config );
        $info = $up->getFileInfo();
        $info['url'] = substr($info['url'],1);
        $host_name = Func::getHostName();
        $url = 'http://' . $host_name . $info['url'];
        $qiniu = new Qiniu();
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $name = time() . mt_rand() . '.' . $ext;
        $s = $qiniu->up($url, $name, C('QINIU.BUCKET'));
        if($s){
            @unlink('.'.$info['url']);
            $info['url'] = C('CDN_HOST').$name;
        }
        if ($info) {
            $this->json->setAttr('uploaded',true);
            $this->json->setAttr('url',[$info['url']]);
            $this->json->Send();
        } else {
            $this->json->setAttr('uploaded',false);
            $this->json->setErr(10099,'上传失败');
            $this->json->Send();
        }
    }



    public function send_message($type, $uid){
        //type=1:发货消息   type=2:宝贝有新动态  type=3:收到优惠券
        $add = [];
        $add['message_id'] = $type;
        $add['uid'] = $uid;
        $add['create_time'] = time();
        $user_message = M('user_message');
        $user_message->add($add);
    }


    public function set(){
        $json = new Json();
        $id = (int)$_POST['id'];
        $type = trim($_POST['type']);
        $set_val = (int)$_POST['set_val'];
        $table = trim($_POST['table']);

        if (!$id || !$type){
            $json->setErr('10001','缺少参数');
            $json->Send();
        }
        $model_table = M($table);
        if(!$model_table->find()){
            $json->setErr('10002','缺少正确的表格信息');
            $json->Send();
        }
        $flag = $model_table->where(array('id'=>$id))->find();
        if (!$flag){
            $json->setErr('10003','没有该选项');
            $json->Send();
        }
        $data[$type] = $set_val;
        $save_flag = $model_table->where(array('id'=>$id))->save($data);
        if ($save_flag || $save_flag === 0){
            $json->setErr(0,'更新成功');
            $json->Send();
        }else{
            $json->setErr('10004','编辑失败');
            $json->Send();
        }
    }


    public function __call($name, $arguments)
    {
        echo '<html><head><title>404 Not Found</title></head><body bgcolor="white"><center><h1>404 Not Found</h1></center><hr><center>nginx/1.10.1</center></body></html>';exit;
    }

    protected function _check_file($file_name,$required,$temp_file,$file_type) {
        // 操作好全局变量，模拟一次上传一张的数据效果
        unset($_FILES);
        $_FILES[$file_name] = $temp_file[$file_name];

        if ($required) {
            if(!$_FILES[$file_name]){
                $this->json->setErr(10001,'请上传文件');
                $this->json->Send();
            }
            if($_FILES[$file_name]['tmp_name']){
                $file=$this->upload_file('home_banner',$file_name,$file_type);
                $file_flag=1;
            }else{
                $file_flag=0;
            }
            if($file_flag){
                if($file['save_name']){
                    $file_link=$file['save_name'];
                }else{
                    $this->json->setErr(10002,$file['error']);
                    $this->json->Send();
                }
            }
            if(!$file_link){
                $this->json->setErr(10003,'上传有误');
                $this->json->Send();
            } else {
                return $file_link;
            }
        } else {
            if ($_FILES[$file_name]) {
                if ($_FILES[$file_name]['tmp_name']) {
                    $file_flag = 1;
                    $file = $this->upload_file('home_banner', $file_name,$file_type);
                } else {
                    $file_flag = 0;
                }
                if ($file_flag) {
                    if ($file['save_name']) {
                        $file_link = $file['save_name'];
                    } else {
                        $this->json->setErr(10004,$file['error']);
                        $this->json->Send();
                    }
                }
                if (!$file_link) {
                    $this->json->setErr(10005, '图片上传失败');
                    $this->json->Send();
                } else {
                    return $file_link;
                }
            } else {
                return false;
            }
        }
    }

    protected function _check_img($file_name,$width,$height,$required,$temp_file) {
        // 操作好全局变量，模拟一次上传一张的数据效果
        unset($_FILES);
        $_FILES[$file_name] = $temp_file[$file_name];

        if ($required) {
            if(!$_FILES[$file_name]){
                $this->json->setErr(10001,'请上传图片');
                $this->json->Send();
            }
            if($_FILES[$file_name]['tmp_name']){
                $file=$this->upload(1,$width,$height,'banner',$file_name);
                $file_flag=1;
            }else{
                $file_flag=0;
            }
            if($file_flag){
                if($file['save_name']){
                    $img=$file['save_name'];
                }else{
                    $this->json->setErr(10002,$file['error']);
                    $this->json->Send();
                }
            }
            if(!$img){
                $this->json->setErr(10003,'图片上传有误');
                $this->json->Send();
            } else {
                return $img;
            }
        } else {
            if ($_FILES[$file_name]) {
                if ($_FILES[$file_name]['tmp_name']) {
                    $file_flag = 1;
                    $file = $this->upload(1, $width, $height, 'banner', $file_name);
                } else {
                    $file_flag = 0;
                }
                if ($file_flag) {
                    if ($file['save_name']) {
                        $img = $file['save_name'];
                    } else {
                        $this->json->setErr(10004,$file['error']);
                        $this->json->Send();
                    }
                }
                if (!$img) {
                    $this->json->setErr(10005, '图片上传失败');
                    $this->json->Send();
                } else {
                    return $img;
                }
            } else {
                return false;
            }
        }
    }


    private function _get_path_info(){
        $c_path_info = $_SERVER['PATH_INFO'];       //找出当前的url
        $first_char = substr( $c_path_info, 0, 1 );
        if ($first_char != '/') {
            $c_path_info = '/'.$c_path_info;
        }

        if(!$c_path_info) $c_path_info = '/';
        if($c_path_info=='/Index/index' || $c_path_info== '/Index' || $c_path_info== '/Index/') $c_path_info = '/';
        if($c_path_info!='/'){
            $c_path_info_arr = explode('/',$c_path_info);
            if(!$c_path_info_arr[2]){
                $c_path_info = rtrim($c_path_info,'/');
                $c_path_info .= '/index';
            }
        }
        return $c_path_info;
    }

    private function _get_left_menu(){
        $c_path_info = $this->_get_path_info();
        $action = M('action');
        $c_left_act_result = $action->where('urls="'.$c_path_info.'" and level in(2,3)')->find();   //查询url

        if($c_left_act_result['is_show']!=1) { //再往上找一级
            $c_left_act_result = $action->where(array('id'=>$c_left_act_result['pid']))->find();   //查询url
        }
        //判断是否属于3级菜单的第一个。
        $k = $action->where(array('pid'=>$c_left_act_result['id'],'urls'=>$c_left_act_result['urls']))->find();   //查询url
        if($k){
            $c_left_act_result = $k;
        }

        return $c_left_act_result;
    }

}
