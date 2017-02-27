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
    <script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
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
	*{padding:0;margin:0;}
	a{text-decoration: none;}
	li{list-style: none;}
	.clear{clear:both;}
	.attr{width:100%;min-height:150px;border:0px solid red;}
	.attr_mess{width:100%;height:40px;border-bottom:1px solid #e4e4e4;margin-top:10px;}
	.attr_mess h3{float:left;width:100px;text-align:center;max-width:100px;height:30px;line-height:30px;font-size:15px;border-radius: 5px;border:1px solid orange;margin-top:0;margin-left:10px;}
	.attr_mess ul{float:left;width:70%;text-align:center;height:30px;line-height:30px;font-size:15px;margin-left:10px;}
	.attr_mess ul li{width:auto;float:left;margin-right:10px;font-weight:bold;color:#5db2ff;}

	.baocun{width:100%;height:60px;}
	.baocun input{width:100px;height:40px;margin-top:10px;margin-left:10px;}
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
                           <h3 style="width:50%;float:left;" class="panel-title"><i class="glyphicon glyphicon-star-empty" style="color:orange;"></i> 商品属性管理&nbsp;&nbsp;&nbsp;&nbsp;<b style="color:red;">[<?php echo ($goods["name"]); ?>]</b>
                           <b style="margin-left:10px;font-size:13px;color:red;">请勿重复添加属性!</b></h3> 
                        	<div class="text-right" style="width:40%;float:right;"><a class="btn btn-info" href="<?php echo U('ShopGoods/index');?>">商品列表</a></div>
                        </div>
                        <form action="<?php echo U('ShopGoods/addGoodsAttrHandler',array('gid'=>$goods['id']));?>" method="post">
							<div class="attr">
								<?php if(is_array($shopAttr)): foreach($shopAttr as $key=>$at): ?><div class="attr_mess">
									<h3><?php echo ($at["name"]); ?></h3>
									<ul>
										<?php if(is_array($at["son"])): foreach($at["son"] as $key=>$son): ?><li style="color:<?php echo ($son["color"]); ?>;">
											<input data-pid='' type="checkbox" name="sonattr[]" value="<?php echo ($at["id"]); ?>-<?php echo ($son["id"]); ?>" <?php if(in_array($son['id'],$attrdb)): ?>checked="checked" disabled<?php endif; ?> /><?php echo ($son["name"]); ?></li><?php endforeach; endif; ?>
									</ul>
									<div class="clear"></div>
								</div><?php endforeach; endif; ?>
								<div class="baocun">
									<input type="hidden" name="attr" value="" />
									<input type="hidden" name="gid" value="<?php echo ($goods["id"]); ?>" />
									<input class="btn btn-sm btn btn-danger" type="submit" value="保存属性"/>
								</div>
							</div>
						</form>
						<script type="text/javascript">
						/*$(function(){
							$("input[type='checkbox']").click(function(){
								var pid=$(this).data("pid");
								var attr=$("input[name='attr']").val();
								if(attr!=''){
									attrArr=attr.split(",");

								}else{
									$("input[name='attr']").val(pid+",");
								}
							})
						})*/
						</script>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               <i class="glyphicon glyphicon-pencil"></i> 已添加属性(<font color='red'>价格可为负，在商品价格的基础上加减所选属性价格，默认0则该属性不加减价格！</font>)
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" style="width:50%;">
                                        <thead>
                                            <tr>
                                                <th style="width:100px;">属性ID</th>
                                                <th style="width:100px;">属性值</th>
                                                <th style="width:100px;">显示色</th>
                                                <th style="width:100px;">价格</th>
                                                <th style="width:100px;">删除</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(is_array($gattr)): foreach($gattr as $key=>$vo): ?><tr>
                                                <td><?php echo ($vo["attrpid"]); ?>-<?php echo ($vo["attrid"]); ?></td>
                                                <td><?php echo ($vo["attrname"]); ?></td>
                                                <td><span style="background:<?php echo ($vo["color"]); ?>;color:black;border:1px solid orange;display:block;padding:5px;border-radius:5px;width:100px;text-align:center;"><?php echo ($vo["color"]); ?></span></td>
                                                <td> 
                                                	<input class="form-control" type="text" data-id="<?php echo ($vo["id"]); ?>" name="attrprice" value="<?php echo ($vo["price"]); ?>"></td>
                                                <td>
                                                	<a class="btn btn-sm btn-primary" href="javascript:;">保存</a>
                                                	<a class="btn btn-sm btn-primary" href="<?php echo U('delGoodsAttr', 'id='.$vo['id']);?>">删除</a>
                                                </td>
                                            </tr><?php endforeach; endif; ?>
                                        </tbody>
                                    </table>
                                </div>
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
        	$("input[name='attrprice']").blur(function(){
        		var id=$(this).data('id');
        		var price=$(this).val();
        		$.get("<?php echo U('ShopGoods/saveAttrPrice');?>",{"id":id,"price":price},function(){

        		})
        	})
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