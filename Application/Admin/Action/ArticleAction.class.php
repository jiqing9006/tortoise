<?php
namespace Admin\Action;


class ArticleAction extends CommonAction
{
    public function _initialize()
    {
        parent::_initialize();
        $model_name = "文章";
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

        if (isset($_GET['s_title'])) {
            $s_title = $_GET['s_title'];
        }
        if ($s_title) {
            $this->assign('s_title', $s_title);
        }

        $where['is_del'] = self::NOT_DEL; // 未删除

        $article = M('article');
        $result_list = $article->where($where)->limit($start.','.$step)->order('id desc')->select();

        $this->assign('result', $result_list);
        $model_flag = $model->index('article',$page,$where);
        $this->assign('allPage',$model_flag);
        $this->display();
    }

    public function edit() {
        $id=$_GET['id'];
        $page = (int)$_GET['page'];
        $this->assign('page', $page);
        $article = M('article');
        $result=$article->where(array('id'=>$id))->find();

        $this->assign('result',$result);
        $this->display();
    }

    public function editsave(){
        $article = M('article');
        $id = (int)$_POST['id'];
        if($id){
            $result = $article->where(array('id'=>$id))->find();
            if(!$result){
                $this->json->setErr(10001, '数据不存在');
                $this->json->Send();
            }

            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'is_show' =>  (int)$_POST['is_show'],
            ];

            $temp_file = $_FILES;
            $data['title_img'] = $this->_check_img('title_img',210,210,false,$temp_file);
            if (!$data['title_img']) {
                unset($data['title_img']);
            }

            $flag = $article->where(['id'=>$id])->save($data);
            if($flag || $flag ===0 ){
                $this->json->setErr(0, '修改成功!!');
                $this->json->Send();
            }else{
                $this->json->setErr(10099, '修改失败!!');
                $this->json->Send();
            }
        } else {
            $data = [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'is_show' =>  (int)$_POST['is_show'],
                'add_time'=> time()
            ];

            $temp_file = $_FILES;
            $data['title_img'] = $this->_check_img('title_img',210,210,true,$temp_file);

            $flag = $article->add($data);
            if($flag){
                $this->json->setErr(0, '添加成功');
                $this->json->Send();
            }else{
                $this->json->setErr(10099, '添加失败');
                $this->json->Send();
            }
        }

    }

    public function del() {
        $id = $_POST['id'];
        if (!$id){
            $this->json->setErr(10001,'缺少参数');
            $this->json->Send();
        }

        $article = M('article');
        $flag = $article->where(['id'=>$id])->save(['is_del'=>self::IS_DEL]);
        if($flag){
            $this->json->setErr(0, '删除成功');
            $this->json->Send();
        }else{
            $this->json->setErr(10099, '删除失败');
            $this->json->Send();
        }
    }


}
