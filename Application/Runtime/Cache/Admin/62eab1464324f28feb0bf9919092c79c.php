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
    <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style type="text/css">
	#type span{float:left;margin-top:10px;padding:0px 20px 0 0; }
	#type input{width:20px;float:left;border:0px;}
    #img{border:0px solid red;height:auto;}
    #img input{margin-bottom:10px;}
    #img input,span{float:left;}
    #img span{margin-left:10px;}
	.menu .form-group{float:left;border:0px solid red;height:auto;width:60%;}

	.menu1 .form-group{float:left;border:0px solid red;height:60px;width:20%;margin-right: 5%;}
	table tr,th,td{text-align: center;}
	.first{display:block;float:left;padding:5px;}
	.num{display:block;float:left;padding:5px;}
	.prev{display:block;float:left;padding:5px;}
	.next{display:block;float:left;padding:5px;}
	.current{display:block;float:left;padding:5px;color:red;}
	.search{width:100%;height:40px;border:0px solid red;margin-top:20px;}
	.search form select{float:left;width:200px;height:40px;border-radius:5px;color:black;margin-left:10px;}
	.search form p{float:left;height:40px;border-radius:5px;color:black;border:1px solid orange;margin-left:30px;}
	.search form p input{height:100%;border:0;margin-top:0px;border:0;border-radius:5px;}
	.search form p.submit{border:1px solid #e4e4e4;background: #2e6da4}
	.submit input{width:80px;background:white;color:white;background: #2e6da4;border:0;}
	</style>

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
            <div class="row">
                <div class="col-lg-12">
                	<h1 class="page-header" style="background:#D9E8A3;border-radius:5px;font-size:0px;">
                      <!--   属性列表--[<?php echo ($attr["0"]["name"]); ?>] -->
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                       
                        <div class="panel-heading" style="height:50px;">
                           <h3 style="width:50%;float:left;" class="panel-title"><i class="glyphicon glyphicon-star-empty" style="color:orange;"></i> 卡券列表</h3> 
                        	<div class="text-right" style="width:40%;float:right;"><a class="btn btn-info" href="<?php echo U('Card/addCard');?>">添加卡券</a></div>
                        </div>
						
						<div class="search">
							<form action="<?php echo U('cardList');?>" method='get'>
								<select name="cid">
									<option value='0'>请选择分类</option>
									<?php if(is_array($cateList)): foreach($cateList as $key=>$cate): ?><option value="<?php echo ($cate["id"]); ?>"><?php echo ($cate["name"]); ?></option><?php endforeach; endif; ?>
								</select>
								<p><input type="text" name="keyword" placeholder="<?php if($keyword): echo ($keyword); else: ?>请输入搜索关键词：标题<?php endif; ?> "></p>
								<p class="submit"><input type="submit" value="搜索"></p>
							</form>
                        </div>

						<div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:2px">ID</th>
                                            <th style="width:5px">类型</th>
                                            <th style="width:50px">卡券名</th>
                                            <th style="width:20px">规则</th>
                                            <th style="width:20px">数值</th>
                                            <th style="width:20px">发放码</th>
                                            <th style="width:20px">创建时间</th>
 
                                            <th style="width:80px">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(is_array($cardList)): foreach($cardList as $key=>$vo): ?><tr>
                                           	<td><?php echo ($vo["id"]); ?></td>
                                           	<td>
                                            <?php if($vo['type'] == 1): ?><span style="color:#5CB85C;">代金券</span><?php elseif($vo['type'] == 2): ?><span style="color:#5BC0DE;">优惠券</span><?php endif; ?>
                                            </td>
                                           	<td><?php echo ($vo["name"]); ?></td>
                                           	<td><?php echo ($vo["rule"]); ?></td>
                                            <td><?php echo ($vo["value"]); ?></td>
                                            <td><?php echo (date("Y-m-d H:i:s",$vo["ctime"])); ?></td>
                                            <td><?php echo ($vo["code"]); ?></td>
                                            <td>
											
                                            	<a class="btn btn-sm btn btn-danger" href="javascript:void(0);" onclick="del(<?php echo ($vo['id']); ?>)">删除</a>
                                            </td>
                                        </tr><?php endforeach; endif; ?>
                                    </tbody>
                                    <tr>
										<td colspan="9" align="center"><?php echo ($page); ?></td>
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
    var ue = UE.getEditor('editor-application',{
        autoHeightEnabled: false
    });
     var ue = UE.getEditor('editor-content',{
        autoHeightEnabled: false
    });
    </script>
    <script type="text/javascript">
        $(function () {
        
        });
        function xiajia(id,zt){
        	$.get("<?php echo U('ShopGoods/xiajia');?>",{"id":id,"zt":zt},function(e){
        		window.location.href=window.location.href;
        	})
        }
       function del(id){
        	$.get("<?php echo U('ShopGoods/delGoods');?>",{"id":id},function(e){
        		window.location.href=window.location.href;
        	})
        }
    </script>

</body>

</html>