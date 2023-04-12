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
        <h2 class="text-center ">第<?php echo ($termInfo["id"]); ?>期投资情况
            <?php if($termInfo['hit_num'] != ''): ?><small class="text-right text-info">(开奖号码:<?php echo ($termInfo["hit_num"]); ?>)</small>
                <?php elseif($termInfo['set_hit_num']): ?><small class="text-right text-info">(预设开奖号码:<?php echo ($termInfo["set_hit_num"]); ?>)</small><?php endif; ?>
        </h2>
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
                                    <th>ID/投注人</th>
                                    <th>投注时间</th>
                                    <th>投注金额</th>
                                    <th>投注号码</th>
                                    <th>号码赔率</th>
                                    <th>预计奖励金额</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($betList)): foreach($betList as $key=>$term): ?><tr>
                                        <td>
                                            <input type="checkbox" name="ids[]" value="<?php echo ($term["id"]); ?>" class="ids">
                                        </td>
                                        <td>
                                            <?php echo ($term["id"]); ?>
                                        </td>
                                        <td>
                                            <?php $username = get_user_info($term['user_id'],'username'); ?>
                                            <?php echo ($term["user_id"]); ?> / <span class="text-danger"><?php echo ($username); ?></span>
                                        </td>
                                        <td>
                                            <?php echo (date("Y-m-d H:i:s",$term["addtime"])); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["money"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["bet_num"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["award_scale"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["can_award_money"]); ?>
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
                        <?php echo ($page); ?>
                    </div>
                </div>
                <!--赔率情况-->
                <h2 class="text-center ">投注与奖励情况</h2>
                <div class="col-md-12 text-center">
                    <div class="builder-table col-md-6 col-md-offset-3" >
                        <div class="panel panel-default table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>

                                    <th>投注号码</th>
                                    <th>发放奖励</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($awardList)): foreach($awardList as $key=>$term): ?><tr>

                                        <td>
                                            <?php echo ($term["bet_num"]); ?>
                                        </td>
                                        <td>
                                            <?php echo ($term["money"]); ?>
                                        </td>
                                        <td>
                                            <?php if($termInfo['hit_num']): ?><button class="btb btn-info" disabled="disabled">已开奖</button>
                                                <?php else: ?>
                                                <button class="btn btn-info set-hit-num" data-num="<?php echo ($term["bet_num"]); ?>" href="<?php echo U('Admin/Term/setHitNum',array('num'=>$term['bet_num'],'term_id'=>$termInfo['id']));?>">设置为开奖号码</button><?php endif; ?>

                                        </td>

                                    </tr><?php endforeach; endif; ?>


                                </tbody>
                            </table>
                        </div>
                        <?php echo ($page); ?>
                    </div>
                </div>
                <!--设定开奖号码-->
                <h2 class="text-center ">设置开奖号码</h2>
                <div class="col-md-12 text-center">
                    <div class="builder-table col-md-6 col-md-offset-3" >
                        <div class="panel panel-default table-responsive">
                            <form action="<?php echo U('Admin/Term/setHitNum');?>" method="post">
                                <p>
                                    <select name="num" id="" class="form-control col-md-2">
                                        <?php if(is_array($hitnums)): foreach($hitnums as $key=>$num): ?><option value="<?php echo ($num["hitnum"]); ?>"><img src="<?php echo get_hit_num_img($num['hitnum']);?>" width="50px" alt=""><?php echo ($num["hitnum"]); ?></option><?php endforeach; endif; ?>
                                    </select>
                                    <input type="hidden" name="term_id" value="<?php echo ($termInfo['id']); ?>">
                                    <button class="submit btn btn-info" >设置为开奖号码</button>
                                </p>
                            </form>
                        </div>

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
        <script type="text/javascript">
            $(function () {
                function set_hit_num(url,hit_num) {

                    var sure = window.confirm("确定要将开奖号码设置为"+hit_num+"?")
                    if (sure) {
                        window.location.href = url;
                    }
                }
                $('.set-hit-num').click(function (event) {
                    event.preventDefault();
                    var url = $(this).attr('href');
                    var hit_num = $(this).attr('data-num');
                    set_hit_num(url,hit_num);
                });


            });
        </script>


    </div>
</div>

</body>
</html>