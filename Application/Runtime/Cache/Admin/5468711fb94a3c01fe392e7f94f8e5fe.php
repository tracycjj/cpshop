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
	.menu .form-group{float:left;border:0px solid red;height:100px;width:50%;}
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
                                    <!-- <a href="<?php echo U('ShopAttr/addAttr');?>">新属性</a> -->
                                </li>
                                <li>
                                    <a href="<?php echo U('ShopGoods/index');?>">商品列表</a>
                                </li>
                                <li>
                                    <a href="<?php echo U('ShopGoods/addGoods');?>">商品上架</a>
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
                        <!-- 添加文章分类 -->
                    </h1>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="glyphicon glyphicon-plus" style="color:orange;"></i> 添加文章分类</h3>
                            <div class="text-right" ><a class="btn btn-info" href="<?php echo U('Article/artCateList');?>">文章分类列表</a></div>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-6">
                                <form action="<?php echo U('Article/editCateAddHandler', 'id='.$id);?>" method="post" onsubmit="return check()" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>分类名称</label>
                                        <input class="form-control" type="text" value="<?php echo ($artCate["name"]); ?>" name="name">
                                        <input class="form-control" type="hidden" value="<?php echo ($artCate["id"]); ?>" name="id">
                                        <p class="help-block"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>英文标记</label>
                                        <input class="form-control" type="text" value="<?php echo ($artCate["tag"]); ?>" name="tag">
                                        <p class="help-block"></p>
                                    </div>
									<div class="form-group" >
                                        <label>上级分类</label><br/>
                                        <select class="form-control" name="pid">
											<option value="0">顶级分类</option>
											<?php if(is_array($catelist)): foreach($catelist as $key=>$vo): ?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $artCate['pid']): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <label>栏目类型</label><br/>
                                        <select class="form-control" name="type">
                                            <option value="1" <?php if($artCate['type'] == 1): ?>selected="selected"<?php endif; ?> >单页栏目</option>
                                            <option value="2" <?php if($artCate['type'] == 2): ?>selected="selected"<?php endif; ?> >列表栏目</option>
                                            
                                        </select>
                                    </div>
                                    <div class="form-group" id="type" style="border:1xp solid red;height:400px;width:;">
                                        <label>栏目简介</label>
                                        <div style="height:450px;width:100%;">
                                             <textarea name="profile" id="editor-profile" type="text/plain" style="width:100%;height:200px;"><?php echo ($artCate["profile"]); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label>展示图片</label>
                                            <input class="form-control" type="file" value="" name="picimg"/>
                                            <p class="help-block">原图
                                            <img src="<?php echo ($artCate["picimg"]); ?>" /></p>
                                    </div>
                                    <div class="form-group" id="type" style="margin-top:00px;">
                                        <label>是否导航显示</label>
                                        <div style="height:30px;width:100%;">
                                        <input class="form-control" type="radio" value="1" name="show" checked="checked" <?php if($artCate['show'] == 1): ?>checked="checked"<?php endif; ?> /><span>是</span>
                                        <input class="form-control" type="radio" value="0" name="show" <?php if($artCate['show'] == 0): ?>checked="checked"<?php endif; ?> /><span>否</span>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-default" >提交</button>
                                    <button type="reset" class="btn btn-default"  >重置</button>
                                </form>
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
    var ue = UE.getEditor('editor-profile',{
        autoHeightEnabled: false
    });

    </script>
    <script type="text/javascript">
        $(function () {
        	var reset=$(":input[type='reset']");
        	reset.click(function(){
        		var obj=$(":input[type='text']");
        		$.each(obj,function(index,value){
        			value.value="";
        		})
        		return false;
        	})
        });

        function check(){
        	var i=true;
        	var name=$(":input[name='name']");
        	var pid=$("select[name='pid']");
        	if(!name.val()){ i=false;}
 			if(i){
  				return true;
  			}	
        	return false;
        }
    </script>

</body>

</html>