<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>管理后台</title>

    <!-- Bootstrap Core CSS -->
    <link href="/Public/sb-admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/Public/sb-admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/Public/sb-admin/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/Public/sb-admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/Public/sb-admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/Public/sb-admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        

        <!-- Navigation -->
        <tblock name="navbar">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo U('Admin/index');?>">后台管理系统</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo U('Admin/detail','id='.session('id'));?>"><i class="fa fa-user fa-fw"></i> 个人信息</a>
                        </li>
                        <li><a href="<?php echo U('Admin/listAll');?>"><i class="fa fa-gear fa-fw"></i> 设置</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo U('Login/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-wrench"></i> 系统设置<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="<?php echo U('Wx/index');?>">微信设置</a>
                                </li> 
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> 管理员管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Role/listAll');?>">角色列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Admin/listAll');?>">管理员列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Node/listAll');?>">权限列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Admin/modifyPassword');?>">修改密码</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-asterisk"></i> 产品分类<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('ShopCate/index');?>">分类列表</a>
                                    <a href="<?php echo U('ShopCate/addCate');?>">添加分类</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-bookmark"></i> 产品属性<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('ShopAttr/index');?>">属性列表</a>
                                    <a href="<?php echo U('ShopAttr/addAttr');?>">新属性</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-star-empty"></i> 产品管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Bgmusic/musicList');?>">产品列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('Bgmusic/musicAdd');?>">产品上架</a>
                                </li>
                            </ul>
                        </li>
                        
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-leaf"></i> 订单管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Order/payment');?>">未支付订单</a>
                                    <a href="<?php echo U('Order/nopayment');?>">已支付订单</a>
                                    <a href="<?php echo U('Order/nopayment');?>">已发货订单</a>
                                    <a href="<?php echo U('Order/nopayment');?>">已完成订单</a>
                                    <a href="<?php echo U('Order/nopayment');?>">已关闭订单</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> 用户管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('User/userList');?>">用户列表</a>
                        
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-align-justify"></i> 文章管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('Article/artList');?>">文章列表</a>
                                    <a href="<?php echo U('Article/artAdd');?>">添加文章</a>
                                </li>
                            </ul>
                        </li>
                       <li>
                            <a href="#"><i class="glyphicon glyphicon-picture"></i> 广告管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="<?php echo U('Advertisement/adsList');?>">首页轮播图</a>
                                </li> 
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        </tblock>

        <div id="page-wrapper">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            配置应用
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-cog fa-fw"></i> 配置应用</h3>
                                <div class="text-right"><a href="<?php echo U('listAll');?>">配置权限节点列表</a></div>
                            </div>
                            <div class="panel-body">
                                <?php if(!empty($items)): ?><div class="panel panel-default">
                                    <div class="panel-heading">
                                       <i class="glyphicon glyphicon-plus"></i> 添加应用
                                    </div>
                                    <form action="<?php echo U('addAppHandler');?>" method="post">
                                    <div class="panel-body">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>应用</label>
                                                <select class="form-control" name="name">
                                                    <?php if(is_array($items)): foreach($items as $key=>$vo): ?><option value="<?php echo ($vo); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>备注名称</label>
                                                <input class="form-control" type="text" name="title">
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <input type="submit" class="form-control" value="添加">
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div><?php endif; ?>
                                <?php if(!empty($list)): ?><div class="panel panel-default">
                                    <div class="panel-heading">
                                       <i class="glyphicon glyphicon-pencil"></i> 已添加应用
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>应用</th>
                                                        <th>备注名称</th>
                                                        <th>配置</th>
                                                        <th>删除</th>
                                                        <th>保存备注</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(is_array($list)): foreach($list as $key=>$vo): ?><form action="<?php echo U('editAppHandler');?>" method="post">
                                                    <tr>
                                                        <td>
                                                            <?php echo ($vo["name"]); ?>
                                                            <input type="hidden" value="<?php echo ($vo["id"]); ?>" name="id" />
                                                        </td>
                                                        <td>
                                                            <input class="form-control" type="text" name="title" value="<?php echo ($vo["title"]); ?>">
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="<?php echo U('editController', 'id='.$vo['id']);?>">配置</a>
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-sm btn-primary" href="<?php echo U('delete', 'id='.$vo['id']);?>">删除</a>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-primary" type="submit">保存</button>
                                                        </td>
                                                    </tr>
                                                    </form><?php endforeach; endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div><?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/Public/sb-admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/Public/sb-admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/Public/sb-admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="/Public/sb-admin/bower_components/raphael/raphael-min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/Public/sb-admin/dist/js/sb-admin-2.js"></script>
    <script src="/Public/admin/js/common.min.js"></script>
    <!-- 首页数据 -->
    <script src="/Public/admin/js/index.min.js"></script>
    <script type="text/javascript">
        $(function () {
            CurrentUsername('<?php echo U("Ajax/userName");?>');
            messageList('<?php echo U("Ajax/message");?>');
        });
    </script>

</body>

</html>