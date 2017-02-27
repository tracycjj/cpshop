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
<style type="text/css">table tr,td,th{text-align: center;}#catename{background:#C5E1E4;margin-top:5px;display:block;width:100px;height:30px;border-radius:5px;text-align:center;line-height:30px;color:orange;}
	.search{width:100%;height:40px;border:0px solid red;margin-top:20px;}
	.search form select{float:left;width:200px;height:40px;border-radius:5px;color:black;margin-left:10px;}
	.search form p{float:left;height:40px;border-radius:5px;color:black;border:1px solid orange;margin-left:30px;}
	.search form p input{height:100%;border:0;margin-top:0px;border:0;border-radius:5px;}
	.search form p.submit{border:1px solid #e4e4e4;background: #2e6da4}
	.submit input{width:80px;background:white;color:white;background: #2e6da4;border:0;}
</style>
  <style type="text/css">
	table th{text-align:center;}
	table td{text-align:center;}
    </style>
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
                                    <a href="<?php echo U('Set/shopSet');?>">商城设置</a>
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
                       <!--  <li>
                           <a href="#"><i class="glyphicon glyphicon-bookmark"></i> 产品属性<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                               <li>
                                   <a href="<?php echo U('ShopAttr/index');?>">属性管理</a>
                                   <a href="<?php echo U('ShopAttr/addAttr');?>">新属性</a>
                               </li>
                           </ul>
                           /.nav-second-level
                       </li> -->
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-star-empty"></i> 商品管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo U('ShopAttr/index');?>">属性管理</a>
                                    
                                </li>
                                <li><a href="<?php echo U('ShopTag/index');?>">标签管理</a></li>
                                <li>
                                    <a href="<?php echo U('ShopGoods/index');?>">商品列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('ShopGoods/addGoods');?>">商品上架</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="glyphicon glyphicon-credit-card"></i> 卡券管理<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <!--  <li><a href="<?php echo U('Card/cardType');?>">卡券类型</a></li> -->
                                <li><a href="<?php echo U('ShopCard/cardList');?>">卡券列表</a></li>
                                <li><a href="<?php echo U('ShopCard/addCard');?>">添加卡券</a></li>
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
                                    <a href="<?php echo U('Article/artCateList');?>">文章分类</a>
                                    <a href="<?php echo U('Article/artList');?>">文章列表</a>
                                    <a href="<?php echo U('Article/artAdd');?>">添加文章</a>
                                </li>
                            </ul>
                        </li>
                       <li>
                            <a href="#"><i class="glyphicon glyphicon-picture"></i> 广告管理 <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="<?php echo U('AdsManager/adsCateList');?>">广告位管理</a>
                                    <a href="<?php echo U('AdsManager/adsList');?>">广告列表</a>
                                    <a href="<?php echo U('AdsManager/addAds');?>">添加广告</a>
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
                <div class="row" style="margin-top:-25px;">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="background:#D9E8A3;border-radius:5px;font-size:25px;">
                            <!-- 广告列表 -->
                        </h1>
                    </div>
                </div>
                 <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="glyphicon glyphicon-sort-by-attributes" style="color:orange;"></i> 广告列表</h3>
                            </div>
                            <div class="search">
								<form action="<?php echo U('adsList');?>" method='get'>
									<select name="cid">
										<?php if(is_array($adsCate)): foreach($adsCate as $key=>$cate): ?><option value="<?php echo ($cate["id"]); ?>"><?php echo ($cate["name"]); ?></option><?php endforeach; endif; ?>
									</select>
									<p class="submit"><input type="submit" value="搜索"></p>
								</form>
	                        </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:5px">ID</th>
                                                <th style="width:5px">广告位ID</th>
                                                <th style="width:5px">排序</th>
                                                <th style="width:50px">图片</th>
                                                <th style="width:50px">名称</th>
                                                <th style="width:50px">创建时间</th>
                                                <th style="width:10px">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($list)): foreach($list as $key=>$vo): ?><tr>
                                               	<td style="line-height:100px;"><?php echo ($vo["id"]); ?></td>
                                               	<td style="line-height:100px;"><?php echo ($vo["cid"]); ?></td>
                                                <td style="line-height:100px;"><input style="width:50px;border-radius:5px;height:34px;border:1px solid #e4e4e4;background:white;padding:0;margin:0;" type="text" data-id="<?php echo ($vo["id"]); ?>" name="paixu" value="<?php echo ($vo["paixu"]); ?>"></td>
                                                <td style="line-height:100px;"><img src="<?php echo ($vo["picimg"]); ?>" style="max-height:100px;width:auto;"></td>
                                                <td style="line-height:100px;"><?php echo ($vo["name"]); ?></td>
                                                <td style="line-height:100px;"><?php echo (date("Y-m-d",$vo["ctime"])); ?></td>
                                                <td style="line-height:100px;">
													<a class="btn btn-sm btn btn-primary" href="<?php echo U('AdsManager/editAds','id='.$vo['id']);?>">编辑</a>
                                                	<a class="btn btn-sm btn btn-danger" href="javascript:void(0);" onclick="del(<?php echo ($vo['id']); ?>)">删除</a>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
                                        <tr>
											<td colspan="8" align="center"><?php echo ($page); ?></td>
                                        </tr>
                                    </table>
                                </div>
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
           
           var paixu=$("input[name='paixu']");
            paixu.blur(function(){
                var id=$(this).data("id");
                var paixu=$(this).val();
                $.post("<?php echo U('AdsManager/setPaixu');?>",{"id":id,"paixu":paixu},function(e){
                     console.log(e.info);
                    if(e.status == 1){
                       
                    }
                })
            })
        });
        function del(id){
        	if(confirm("确定删除该广告？")){
        		window.location.href="/Admin/AdsManager/delAds/id/"+id;
        	}
        }
    </script>

</body>

</html>