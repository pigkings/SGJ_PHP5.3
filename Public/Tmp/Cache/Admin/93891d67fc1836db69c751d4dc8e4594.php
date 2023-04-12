<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <title><?php echo ($meta_title); ?>｜<?php echo C('WEB_SITE_TITLE');?>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta name="author" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="keywords" content="<?php echo ($meta_keywords); ?>">
    <meta name="description" content="<?php echo ($meta_description); ?>">
    <meta name="generator" content="CoreThink">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="<?php echo C('WEB_SITE_TITLE');?>">
    <meta name="format-detection" content="telephone=no,email=no">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="apple-touch-icon" type="image/x-icon" href="/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="/logo.png">
    <link rel="stylesheet" type="text/css" href="/Public/libs/cui/css/cui.min.css">
    <link rel="stylesheet" type="text/css" href="/./Application/Admin/View/Public/css/admin.css">
    <link rel="stylesheet" type="text/css" href="/./Application/Admin/View/Public/css/theme/<?php echo C('ADMIN_THEME');?>.css">
    <link rel="stylesheet" type="text/css" href="/Public/libs/animate/animate.min.css">
    
    <!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/Public/libs/jquery/1.x/jquery.min.js"></script>
</head>
<body class="admin_account_index">
<div class="clearfix full-header">


</div>

<div class="clearfix full-container">


    <div class="builder listbuilder-box panel-body">
        <!-- Tab导航 -->

        <!-- 顶部工具栏按钮 -->
        <div class="builder-toolbar">
            <div class="row">
                <!-- 工具栏按钮 -->
                <div class="col-xs-12 col-sm-9 button-list clearfix">
                    <div class="form-group">

                    </div>
                </div>
                <!-- 搜索框 -->
                <div class="col-xs-12 col-sm-3 clearfix">
                    <form action="<?php echo U('Admin/Term/index');?>" method="get" class="form">
                        <div class="form-group">
                            <div class="input-group search-form">
                                <input type="text" placeholder="请输入ID/用户名" value="" class="search-input form-control"
                                       name="keyword">
                                <span class="input-group-btn"><a class="btn btn-default search-btn"><i
                                        class="fa fa-search"></i></a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- 数据列表 -->
        <div class="builder-container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="builder-table">
                        <div class="panel panel-default table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" class="check-all"></th>
                                    <th>ID</th>
                                    <th>中奖号码</th>
                                    <th>开始时间</th>
                                    <th>结束时间</th>
                                    <th>投注人数</th>
                                    <th>投注金额</th>
                                    <th>奖励金额</th>
                                    <th>投注情况</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($list)): foreach($list as $key=>$term): ?><tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="<?php echo ($term["id"]); ?>" class="ids">
                                        </td>
                                        <td>
                                            <?php echo ($term["id"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["hit_num"]); ?>
                                        </td>
                                        <td>
                                            <?php echo (date("Y-m-d H:i:s",$term["start_time"])); ?>
                                        </td>
                                        <td>
                                            <?php echo (date("Y-m-d H:i:s",$term["end_time"])); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["all_bet"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["all_bet_money"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["all_award"]); ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo U('Admin/Term/betInfo',array('term_id'=>$term['id']));?>">投注情况</a>
                                        </td>
                                        <td>
                                            <a href="/admin.php?s=/admin/account/setstatus/status/delete/ids/23/model/Account.html"
                                               model="Account" class="label label-danger ajax-get confirm" title="删除"
                                               name="delete">删除</a>
                                        </td>
                                    </tr><?php endforeach; endif; ?>


                                </tbody>
                            </table>
                        </div>
                        <ul class="pagination"><?php echo ($page); ?></ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- 额外功能代码 -->
    </div>


</div>

<div class="clearfix full-footer">

</div>

<div class="clearfix full-script">
    <div class="container-fluid">
        <input type="hidden" value="/./Application/Home/View/Public/img" id="corethink_home_img">
        <script src="/Public/libs/cui/js/cui.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            (function () {
                var OpenCMF = window.OpenCMF = {
                    "ROOT": "", //当前网站地址
                    "APP": "/admin.php?s=", //当前项目地址
                    "PUBLIC": "/Public", //项目公共目录地址
                    "DEEP": "/", //PATHINFO分割符
                    "MODEL": ["2", "1", "html"],
                    "VAR": ["m", "c", "a"]
                }
            })();
        </script>
        <script src="/./Application/Admin/View/Public/js/admin.js" type="text/javascript"></script>


        <script src="/Public/libs/cui/js/cui.extend.min.js" type="text/javascript"></script>




    </div>
</div>

</body>
</html>