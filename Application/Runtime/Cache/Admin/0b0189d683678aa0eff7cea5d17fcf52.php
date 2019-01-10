<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo ($admin_name); ?>管理系统</title>
    <!--<link href="/src/myreset.min.css" rel="stylesheet" />-->
    <!-- Bootstrap Core CSS -->
    <link href="/erbi/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugin/pages/pagination.css" media="all" />
    <!-- Custom CSS -->
    <link href="/erbi/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/erbi/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="/admin/css/common.css" rel="stylesheet" />
    <link rel="shortcut icon" href="/src/favicon.ico" />
    <!-- wangEditor CSS -->
    <script type="text/javascript" src="/plugin/wangEditor/release/wangEditor.js"></script>


    <style>
        #think_page_trace{
            margin-left: 200px !important;
        }
    </style>
</head>

<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="javascript:;"><?php echo ($admin_name); ?> 管理系统后台</a>
            <ul class="nav navbar-right top-nav erbi-menu-nav" style="height: 50px;">
                <?php if(is_array($c_action_result)): $i = 0; $__LIST__ = $c_action_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$as): $mod = ($i % 2 );++$i;?><li class="erbi-menu-nav-li <?php if($as['is_chose']) echo 'active'?>">
                        <a href="/admin.php<?php echo ($as['urls']); ?>" <?php if($as['is_chose']) echo 'style="color:#FFF"'?>">
                            <?php echo ($as["name"]); ?>
                        </a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>


                <!--<li class="erbi-menu-nav-li active">-->
                    <!--用户系统-->
                <!--</li>-->

                <!--<li class="erbi-menu-nav-li">-->
                    <!--商品系统-->
                <!--</li>-->

                <!--<li class="erbi-menu-nav-li">-->
                    <!--订单系统-->
                <!--</li>-->

                <!--<li class="erbi-menu-nav-li">-->
                    <!--促销系统-->
                <!--</li>-->

                <!--<li class="erbi-menu-nav-li">-->
                    <!--网站设置-->
                <!--</li>-->

                <!--<li class="erbi-menu-nav-li">-->
                    <!--权限设置-->
                <!--</li>-->
            </ul>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
           
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo (session('_admin_nick_name')); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/admin.php/Public/logout"><i class="fa fa-fw fa-power-off"></i>退出</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
       
        
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav" id="slideNav">
                <?php
 for($k=0;$k<count($c_left_menu);$k++){ if($c_left_menu[$k]['is_chose']==1){ ?>
                <li class="active">
                <?php
 }else{ ?>
                <li>
                <?php
 } ?>
                    <?php
 if($c_left_menu[$k]['t_menu']){ if($c_left_menu[$k]['is_chose']==0){ ?>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo_<?php echo ($c_left_menu[$k]['id']); ?>" class="collapsed" aria-expanded="true">
                    <i class="fa fa-fw fa-arrows-v"></i> <?php echo $c_left_menu[$k]['name']?>
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>

                <ul id="demo_<?php echo ($c_left_menu[$k]['id']); ?>" class="collapse" aria-expanded="false">
                        <?php
 for($h=0;$h<count($c_left_menu[$k]['t_menu']);$h++){ if($c_left_menu[$k]['t_menu'][$h]['is_chose']==1){ ?>
                    <li>
                        <a href="/admin.php<?php echo ($c_left_menu[$k]['t_menu'][$h]['urls']); ?>" style="background-color: #000 !important;"><?php echo ($c_left_menu[$k]['t_menu'][$h]['name']); ?></a>
                    </li>
                        <?php
 }else{ ?>
                    <li>
                        <a href="/admin.php<?php echo ($c_left_menu[$k]['t_menu'][$h]['urls']); ?>"><?php echo ($c_left_menu[$k]['t_menu'][$h]['name']); ?></a>
                    </li>
                    <?php
 } } ?>
                </ul>
                    <?php
 }else{ ?>
                <a href="javascript:;" data-toggle="collapse" data-target="#demo_<?php echo ($c_left_menu[$k]['id']); ?>" class="" aria-expanded="false">
                    <i class="fa fa-fw fa-arrows-v"></i> <?php echo $c_left_menu[$k]['name']?>
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>

                <ul id="demo_<?php echo ($c_left_menu[$k]['id']); ?>" class="" aria-expanded="false">
                    <?php
 for($h=0;$h<count($c_left_menu[$k]['t_menu']);$h++){ if($c_left_menu[$k]['t_menu'][$h]['is_chose']==1){ ?>
                    <li>
                        <a href="/admin.php<?php echo ($c_left_menu[$k]['t_menu'][$h]['urls']); ?>" style="background-color: #000 !important;"><?php echo ($c_left_menu[$k]['t_menu'][$h]['name']); ?></a>
                    </li>
                    <?php
 }else{ ?>
                    <li>
                        <a href="/admin.php<?php echo ($c_left_menu[$k]['t_menu'][$h]['urls']); ?>"><?php echo ($c_left_menu[$k]['t_menu'][$h]['name']); ?></a>
                    </li>
                    <?php
 } } ?>
                </ul>
                    <?php
 } ?>

                    <?php
 }else{ ?>
                    <a href="/admin.php<?php echo ($c_left_menu[$k]['urls']); ?>"><i class="fa fa-fw fa-dashboard"></i> <?php echo $c_left_menu[$k]['name']?></a>
                <?php
 } ?>
                    </li>
                <?php
 } ?>
            </ul>
        </div>
        
        <!-- /.navbar-collapse -->
    </nav>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/admin.php/Role/index"><?php echo ($model_name); ?>管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bar-chart-o"></i> 添加<?php echo ($model_name); ?>
                    </li>

                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        添加编辑<?php echo ($model_name); ?>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive col-lg-10">
                            <form class="form-horizontal addForm" method="post" action="editsave" name="form1" id="edit_form" enctype="multipart/form-data">
                                <input type="hidden" id="id" name="id" value="<?php echo ($result['id']); ?>">
                                <input type="hidden" name="page" id="page" value="<?php echo ($page); ?>" />
                                <div class="form-group col-lg-12">
                                    <label class="control-label  col-lg-3  text-right"><span class="control-label required-mark">*</span>名称:</label>
                                    <input class="form-control-erbi col-lg-3" type="text" name="name" id="name" value="<?php echo ($result['name']); ?>" />
                                </div>


                                <div class="form-group col-lg-12">
                                    <label class="control-label  col-lg-3  text-right">权限:</label><br/>
                                    <div class="col-lg-8" style="padding-left: 0;">
                                        <?php if(is_array($r_arr)): $i = 0; $__LIST__ = $r_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="priv_list">
                                                <div class="padd-top-7">
                                                    <b><?php echo ($vo["name"]); ?></b>
                                                </div>
                                                <?php if(is_array($vo["next"])): $i = 0; $__LIST__ = $vo["next"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$so): $mod = ($i % 2 );++$i;?><label class="checkbox-inline width100">
                                                        <?php
 if( in_array($so['id'],$role_result['powers'])){ ?>
                                                        <input type="checkbox" value="<?php echo ($so["id"]); ?>" checked name="power[]"> <?php echo ($so["name"]); ?>
                                                        <?php
 }else{ ?>
                                                        <input type="checkbox" value="<?php echo ($so["id"]); ?>" name="power[]"> <?php echo ($so["name"]); ?>
                                                        <?php
 } ?>

                                                    </label><?php endforeach; endif; else: echo "" ;endif; ?>

                                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </div>



                                <div class="form-group col-lg-12">
                                    <label class="control-label  col-lg-3  text-right">权重:</label>
                                    <input class="form-control-erbi col-lg-3" type="number" name="weight" id="weight" value="<?php echo ((isset($result['weight']) && ($result['weight'] !== ""))?($result['weight']):0); ?>" />
                                    <span class="col-lg-4 text-left erbi-form-right">（数字越大越靠前）</span>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-2 col-lg-offset-3">
                                        <button type="button" class="btn btn-primary col-lg-8" id="edit_btn">提交</button>
                                    </div>

                                    <div class="col-lg-2">
                                        <button type="button" class="btn btn-danger col-lg-8" id="cancel_btn">取消</button>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </form>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
    </div>
</div>

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="/src/jquery-1.9.1.min.js"></script>

<!-- Layer 弹出层 -->
<script src="/plugin/layer/layer.js"></script>

<!-- Lay日期 -->
<script src="/plugin/laydate/laydate.js"></script>

<!-- Bootstrap Core JavaScript -->

<script src="/erbi/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/plugin/ajaxUpload/ajaxfileupload.js"></script>
<script type="text/javascript" src="/plugin/jquery.form.new.js"></script>
<script src="/plugin/My97DatePicker/WdatePicker.js"></script>

<script type="text/javascript" src="/admin/js/common.js"></script>
<script>
    $(function () {
        // 定义全局锁
        var lock_flag = false;

        var page = $('#page').val();
        $("#cancel_btn").on('click',function () {
            window.location.href = 'index';
        });

        $("#edit_form").ajaxForm({
            dataType: "json",
            success : function(obj){
                if(obj.errno == 0){
                    layer.msg(obj.errdesc);
                    setTimeout(function() {
                        window.location.href='index?page=' + page;
                    },2000);
                }else{
                    // 解锁
                    lock_flag = false;
                    layer.msg(obj.errdesc);
                }
                return false;
            }
        });

        $("#edit_btn").on("click", function(){
            // 获取并判断各个值是否填写并正确
            var name =$("#name").val();
            if(!name){
                alert('名称不能为空');
                return;
            }

            // 上锁
            if (!lock_flag) {
                lock_flag = true;
                $("#edit_form").submit();
            }
            return false;
        });

    })
</script>
</body>
</html>