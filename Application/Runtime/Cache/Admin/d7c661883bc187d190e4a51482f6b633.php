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
                        <i class="fa fa-dashboard"></i>  <a href="/admin.php/Priv/priv_list">菜单管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bar-chart-o"></i> 菜单列表
                    </li>

                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        菜单列表
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>菜单名称</th>
                                    <th>菜单级别</th>
                                    <th>菜单地址</th>
                                    <th>是否隐藏</th>
                                    <!--<th>操作</th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
 for($i=0;$i<count($r_arr);$i++){ ?>
                                <tr>
                                    <td><?php echo ($i); ?></td>
                                    <td>
                                        <?php
 if($r_arr[$i]['level']==2){ ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo ($r_arr[$i]['name']); ?>
                                        <?php
 }elseif($r_arr[$i]['level']==3){ ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|--<?php echo ($r_arr[$i]['name']); ?>
                                        <?php
 }else{ ?>
                                        <b><?php echo ($r_arr[$i]['name']); ?></b>
                                        <?php
 } ?>

                                    </td>
                                    <td><?php echo ($r_arr[$i]['level']); ?></td>
                                    <td><?php echo ($r_arr[$i]['urls']); ?></td>
                                    <td>
                                        <?php
 if($r_arr[$i]['is_show']){ ?>
                                        <i class="fa fa-check erbi-color-green" aria-hidden="true"></i>

                                        <?php
 }else{ ?>
                                        <i class="fa fa-times erbi-color-red" aria-hidden="true"></i>

                                        <?php
 } ?>
                                        </td>
                                    <!--<td>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($r_arr[$i]['id']); ?>" class="order-edit">编辑</a>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($r_arr[$i]['id']); ?>" class="order-del">删除</a>-->
                                    <!--</td>-->
                                </tr>
                                <?php
 } ?>


                                <!--<tr>-->
                                    <!--<td>2</td>-->
                                    <!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&#45;&#45;用户列表</td>-->
                                    <!--<td>Otto</td>-->
                                    <!--<td>@mdo</td>-->
                                    <!--<td>-->
                                        <!--<i class="fa fa-check erbi-color-green" aria-hidden="true"></i>-->
                                    <!--</td>-->
                                    <!--<td>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="order-edit">编辑</a>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="order-del">删除</a>-->
                                    <!--</td>-->
                                <!--</tr>-->

                                <!--<tr>-->
                                    <!--<td>2</td>-->
                                    <!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&#45;&#45;用户管理1</td>-->
                                    <!--<td>Otto</td>-->
                                    <!--<td>@mdo</td>-->
                                    <!--<td>-->
                                        <!--<i class="fa fa-check erbi-color-green" aria-hidden="true"></i>-->
                                    <!--</td>-->
                                    <!--<td>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="order-edit">编辑</a>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="order-del">删除</a>-->
                                    <!--</td>-->
                                <!--</tr>-->
                                <!--<tr>-->
                                    <!--<td>2</td>-->
                                    <!--<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&#45;&#45;用户管理2</td>-->
                                    <!--<td>Otto</td>-->
                                    <!--<td>@mdo</td>-->
                                    <!--<td>-->
                                        <!--<i class="fa fa-check erbi-color-green" aria-hidden="true"></i>-->
                                    <!--</td>-->
                                    <!--<td>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="order-edit">编辑</a>-->
                                        <!--<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="order-del">删除</a>-->
                                    <!--</td>-->
                                <!--</tr>-->


                                </tbody>
                            </table>
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
</body>
</html>