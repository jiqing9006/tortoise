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

        <div class="row" style="margin-top: 20px;">
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-info-circle"></i>  &nbsp; <strong>欢迎登陆<?php echo ($admin_name); ?>管理系统</strong>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        关于智慧校园
                    </div>
                    <div class="panel-body">
                        <div style="margin:4px">
                            <p style="text-indent:28px">
                                服务校园
                            </p>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        客户支持中心
                    </div>
                    <div class="panel-body" style="height: 114px;">
                        江苏.宿迁
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-4 -->
        </div>

    </div>
    <!-- /.container-fluid -->

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
</body>
</html>
<script>

</script>