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
<style>
    #tbody img {
        width:300px;
    }

    .on {
        cursor: pointer;
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="/admin.php/Role/index"><?php echo ($model_name); ?>管理</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-table"></i> <?php echo ($model_name); ?>列表
                    </li>
                    <button type="button" class="btn btn-sm btn-danger btn-erbi-danger" id="info_add">添加<?php echo ($model_name); ?></button>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="row">
                        <div class="col-lg-2" style="margin-left: 20px;margin-top: 10px;">
                                <span class="input-group input-group-sm">
                                    <span class="input-group-addon" ><b>名称:</b></span>
                                    <input type="text" class="form-control-erbi" id="s_name" value="<?php echo ($s_name); ?>" aria-describedby="base" placeholder="请输入名称">
                                </span>
                        </div>

                        <button type="button" class="btn btn-sm btn-primary" style="float: right; margin-right: 35px;margin-top: 10px;" id="search">
                            <i class="fa fa-search" aria-hidden="true"></i> 搜索
                        </button>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body" style="padding-top: 10px;">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>角色权限</th>
                                    <th>权重</th>
                                    <th>添加时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                        <td><?php echo ($vo["id"]); ?></td>
                                        <td><?php echo ($vo["name"]); ?></td>
                                        <td><?php echo ($vo["power"]); ?></td>
                                        <td><?php echo ($vo["weight"]); ?></td>
                                        <td><?php echo (date('Y-m-d H:i',$vo["add_time"])); ?></td>
                                        <td>
                                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="info_edit">编辑</a>
                                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="info_del">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                </tbody>
                            </table>
                            <div class="pagination" id="pages" style="float:right;">
    <ul>
        <li><a href="/admin.php/Role/index?page=1<?php echo ($allPage['prefix_page']); echo ($allPage["tail"]); ?>">首页</a></li>
        <li><a href="/admin.php/Role/index?page=<?php echo ($allPage['prev_page']); echo ($allPage['prefix_page']); echo ($allPage["tail"]); ?>">上一页</a></li>
        <?php for ($i = $allPage['page_start']; $i <= $allPage['page_end']; $i++) { if ($i == $allPage['page']) { ?>
        <li class="active"> <a href="/admin.php/Role/index?page=<?php echo $i; echo ($allPage['prefix_page']); echo ($allPage["tail"]); ?>">
            <?php echo $i; ?>
        </a> </li>
        <?php } else { ?>
        <li><a href="/admin.php/Role/index?page=<?php echo $i; echo ($allPage['prefix_page']); echo ($allPage["tail"]); ?>">
            <?php echo $i; ?>
        </a></li>
        <?php
 } } ?>
        <li><a href="/admin.php/Role/index?page=<?php echo ($allPage['next_page']); echo ($allPage['prefix_page']); echo ($allPage["tail"]); ?>">下一页</a></li>
        <li><a href="/admin.php/Role/index?page=<?php echo ($allPage['page_all']); echo ($allPage['prefix_page']); echo ($allPage["tail"]); ?>">尾页</a></li>
    </ul>
</div>
                            <input type="hidden" name="page" id="page" value="<?php echo ($page); ?>" />
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
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
<script>
    $("#search").on('click', function () {
        var s_name = $("#s_name").val();
        var tail = '?search=1';
        if(s_name){
            tail += '&s_name=' + s_name;
        }
        window.location.href= '/admin.php/Role/index' + tail;
    });
    $(function () {
        $("#info_add").on('click',function () {
            window.location.href= '/admin.php/Role/edit';
        });

        $(".info_edit").on('click',function () {
            var id = $(this).data('id');
            var page = $("#page").val();
            if(page){
                var str = '&page='+page;
            }else{
                var str = '';
            }
            window.location.href= '/admin.php/Role/edit?id='+id+str;
        });


        $(".info_del").on('click',function () {
            if(confirm('确定要删除吗')){
                var id = $(this).data('id');
                $.ajax({
                    type:'POST',
                    url:'del',
                    data: {id: id},
                    dataType:'json',
                    success:function(data){
                        if(data.errno == 0){
                            alert(data.errdesc);
                            window.location.reload();
                        }else{
                            alert(data.errdesc);
                            return false;
                        }
                    }
                });
            }
        });

        $('.change_status').on('click',function(){
            var _this = $(this);
            var id = $(this).parent().data('id');
            var type = $(this).data('type');
            var q = $(this).data('q');
            var table = 'role';
            var set_val;

            if(q == '1'){
                set_val = 0;
            }
            if(q == '0'){
                set_val = 1;
            }
            $.ajax({
                type:'POST',
                url:'/admin.php/Common/set',
                data:{'id':id,'type':type,'set_val':set_val,'table':table},
                dataType:'json',
                success:function(data){
                    if(data.errno == 0){
                        if (type == 'is_top') {
                            window.location.reload();
                        } else {
                            _this.data('q',set_val);
                            if(set_val ==1){
                                _this.html('<i class="fa fa-check erbi-color-green"></i>');
                            }else{
                                _this.html('<i class="fa fa-times erbi-color-red"></i>');
                            }
                        }
                    }
                },
                error:function(data){
                    alert("网络错误");
                }
            });
        });
    })
</script>
</body>
</html>