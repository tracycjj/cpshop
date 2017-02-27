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
        <tquote from="Admin/index" name="navbar" />

        <div id="page-wrapper">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            修改管理员
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-edit fa-fw"></i> 修改管理员</h3>
                                <div class="text-right"><a href="<?php echo U('listAll');?>">管理员列表</a></div>
                            </div>
                            <div class="panel-body">
                                <div class="col-lg-6">
                                    <form action="<?php echo U('editHandler', 'id='.$id);?>" method="post">
                                        <div class="form-group">
                                            <label>账号</label>
                                            <input class="form-control" type="text" value="" name="username" placeholder="<?php echo ($item["username"]); ?>">
                                            <p class="help-block">管理员账号，英文或数字，留空表示不修改。</p>
                                        </div>
                                        <div class="form-group">
                                            <label>密码</label>
                                            <input class="form-control" type="password" name="password">
                                            <p class="help-block">管理员密码，六位以上数字、字母及字符，留空表示不修改。</p>
                                        </div>
                                        <div class="form-group">
                                            <label>密码确认</label>
                                            <input class="form-control" type="password" name="confirmpassword">
                                            <p class="help-block">请重复输入上面的密码。</p>
                                        </div>
                                        <div class="form-group">
                                            <label>所属角色组</label>
                                            <?php if(is_array($items)): foreach($items as $key=>$vo): ?><label class="checkbox-inline">
                                                    <?php if(in_array($vo[id], $roles)): ?><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="role[]" checked="checked"><?php echo ($vo["name"]); ?>
                                                    <?php else: ?>
                                                        <input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="role[]"><?php echo ($vo["name"]); endif; ?>
                                                </label><?php endforeach; endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label>管理员状态</label>
                                            <?php if($item["status"] == 1): ?><label class="radio-inline">
                                                    <input type="radio" name="status" value="0">禁用
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" checked="checked" >启用
                                                </label>
                                            <?php else: ?>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="0" checked="checked">禁用
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="status" value="1" >开启
                                                </label><?php endif; ?>
                                        </div>
                                        <button type="submit" class="btn btn-default">提交</button>
                                        <button type="reset" class="btn btn-default">重置</button>
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
        $(function () {
            CurrentUsername('<?php echo U("Ajax/userName");?>');
            messageList('<?php echo U("Ajax/message");?>');
        });
    </script>

</body>

</html>