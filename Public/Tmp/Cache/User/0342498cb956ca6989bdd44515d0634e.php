<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo C('WEB_SITE_TITLE');?></title>
    <meta name="viewport"
          content="width=device-width,height=device-height,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="/./Application/Home/Template/Public/css/bootstrap.css" rel="stylesheet">
    <link href="/./Application/Home/Template/Public/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="/./Application/Home/Template/Public/js/jquery-2.0.3.min.js" type="text/javascript" charset="utf-8"></script>
    <link href="/./Application/Home/Template/Public/css/style.css" rel="stylesheet">
    
    <!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
</head>
<body>
<!-- 头部 -->
<!-- 导航条
================================================== -->
<script type="text/javascript">
    $(function () {
        $(".navbar-toggle").click(function () {
            if ($(".navbar-collapse").hasClass("collapse")) {
                $(".navbar-collapse").removeClass("collapse");
            } else {
                $(".navbar-collapse").addClass("collapse");
            }
        })
    })
</script>
<div class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><?php echo C('WEB_NAME');?></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?php echo U('User/Center/index');?>" target="_self">投注</a>
                </li>
                <li><a href="<?php echo U('User/Win/index');?>" >中奖记录</a></li>
            </ul>
            <?php if(isset($_user_auth)): ?><ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle"
                           data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo ($_user_auth["nickname"]); ?> <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo U('User/Center/password');?>">修改密码</a></li>
                            <hr>
                            <li><a href="<?php echo U('User/User/logout');?>">退出</a></li>
                        </ul>
                    </li>
                </ul>
                <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo U('User/User/login');?>">登录</a>
                    </li>
                    <li>
                        <a href="<?php echo U('User/User/toregist');?>">注册</a>
                    </li>
                </ul><?php endif; ?>
        </div>
    </div>
</div>
<!-- /头部 -->

<!-- 主体 -->

<div id="main-container" class="container">
    <div class="row">


        <style type="text/css">
            body {
                background: url(/./Application/Home/Template/Public/images/bodybg.jpg) /*tpa=http://www.fafa8889.com/Public/Home/images/bodybg.jpg*/ no-repeat !important;
                background-size: cover !important;
            }
        </style>


    </div>
    
    <section>
        <div class="span12">

            <form class="login-form" action="<?php echo U('User/Recharge/add');?>" method="post">
                <h3 class="loginf_h3tt">在线充值 <a class=" pull-right" style="color: white;font-size: 12px;padding-top: 8px" href="#" id="showRechargeInfo">查看帐号</a></h3>
                <div class="control-group clearfix">
                    <label class="control-label pull-left" for="inputCardNo">积分</label>
                    <div class="controls pull-left">
                        <input type="text" id="inputCardNo" class="span3" placeholder="请输入充值积分"  nullmsg="请填写卡号"  name="money">
                    </div>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label pull-left" for="inputCardPwd">交易号</label>
                    <div class="controls pull-left">
                        <input type="text" id="inputCardPwd" class="span3" placeholder="请输入转账交易号"  nullmsg="请填写转账交易号" datatype="*6-20" name="water_number">
                    </div>
                </div>
                <div class="control-group clearfix">
                    <label class="control-label pull-left" for="inputCardPwd">备注</label>
                    <div class="controls pull-left">
                        <input type="text" id="inputWaterNumber" class="span3" placeholder="可以为空"  name="user_remark">
                    </div>
                </div>
                <div class="control-group1">
                    <div class="controls">
                        <div class="controls Validform_checktip text-warning"></div>
                        <button type="submit" class="btn btnsubmit">充 值</button>

                    </div>
                </div>
            </form>

            <div class="modal fade " id="rechargeInfo">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">充值帐号</h4>
                        </div>
                        <div class="modal-body">
                            <section>
                                <div class="span12">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td>支付方式: </td>
                                            <td>
                                                  <p>
                                                      <input type="radio" name="pay-type" id="weixin-pay" onclick="paytypeSelect(1)">
                                                      <label for="weixin-pay">
                                                          <img src="/./Application/Home/Template/Public/images/weixinpay_logo.jpg" alt="" height="30px" onclick="paytypeSelect(1)">
                                                      </label>
                                                  </p>
                                                <p>
                                                    <input type="radio" name="pay-type" id="ali-pay" onclick="paytypeSelect(2)">
                                                    <label for="ali-pay">
                                                        <img src="/./Application/Home/Template/Public/images/alipay_logo.jpg" alt="" height="30px" onclick="paytypeSelect(2)">
                                                    </label>
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>支付类型</td>
                                            <td>在线充值</td>
                                        </tr>
                                        <tr>
                                            <td>使用说明</td>
                                            <td>
                                                请长按二维码保存到相册或者截屏后使用对应支付端进行扫码支付，支付完成后一分钟内到账!
                                            </td>
                                        </tr>
                                        <tr id="weixin-account">
                                            <td></td>
                                            <td >
                                                <p>微信帐号：<?php echo C('GUESS_WEIXIN_ACCOUNT');?></p>
                                                <img width="80%" src="<?php echo ($weixinImg); ?>" alt="">
                                            </td>
                                        </tr>
                                        <tr id="ali-account">
                                            <td></td>
                                            <td >
                                                <p>支付宝帐号：<?php echo C('GUESS_ALI_ACCOUNT');?></p>
                                                <img width="80%" src="<?php echo ($aliImg); ?>" alt="">
                                            </td>
                                        </tr>
                                    </table>
                                    <!--<form class="login-form" action="<?php echo U('User/Recharge/add');?>" method="post">-->
                                        <!--<h4>-->
                                            <!--<label class="control-label pull-left" for="inputCardPwd">支付宝帐号<?php echo C('GUESS_ALI_ACCOUNT');?></label>-->
                                        <!--</h4>-->
                                            <!--<p>-->
                                                <!--<img src="<?php echo ($aliImg); ?>" alt="">-->
                                            <!--</p>-->
                                        <!--<hr>-->
                                        <!--<h4>-->
                                            <!--<label class="control-label pull-left" for="inputCardPwd">微信帐号：<?php echo C('GUESS_WEIXIN_ACCOUNT');?></label>-->
                                        <!--</h4>-->
                                        <!--<p>-->
                                            <!--<img src="<?php echo ($weixinImg); ?>" alt="">-->
                                        <!--</p>-->
                                    <!--</form>-->
                                </div>
                            </section>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">已完成支付提交充值</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </section>


</div>
<!-- /主体 -->

<!-- 底部 -->
<!-- 底部
================================================== -->
<nav class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
        <ul class="nav navbar-nav navbar-navreset">
            <li><a href="<?php echo U('User/Bet/index');?>" >下注记录</a></li>
            <li><a href="<?php echo U('User/Account/index');?>" >积分记录</a></li>

        </ul>
    </div>
</nav>

<script type="text/javascript">
    (function () {
        var ThinkPHP = window.Think = {
            "ROOT": "", //当前网站地址
            "APP": "", //当前项目地址
            "PUBLIC": "/Public/Home", //项目公共目录地址
            "DEEP": "/", //PATHINFO分割符
            "MODEL": ["2", "", "html"],
            "VAR": ["m", "c", "a"]
        }
    })();
</script>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->

<!--[if lt IE 9]>
<script type="text/javascript" src="/./Application/Home/Template/Public/js/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/./Application/Home/Template/Public/js/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/./Application/Home/Template/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/./Application/Home/Template/Public/js/soundmanager2-jsmin.js"></script>
<script src="/Public/libs/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<!--<![endif]-->

<script type="text/javascript">
    $(document)
/*            .ajaxStart(function () {
                $("button:submit").addClass("log-in").attr("disabled", true);
            })
            .ajaxStop(function () {
                $("button:submit").removeClass("log-in").attr("disabled", false);
            });
*/

    $("form").submit(function () {
        var self = $(this);
        $.post(self.attr("action"), self.serialize(), success, "json");
        return false;

        function success(data) {
            if (data.status) {
                layer.msg(data.info);
                window.location.href = data.url;
            } else {
//                self.find(".Validform_checktip").text(data.info);
                layer.msg(data.info);
                //刷新验证码
                $(".reload-verify").click();
            }
        }
    });

    $(function () {
        // 刷新验证码
        $(".reload-verify").on('click', function () {
            var verifyimg = $(this).attr("src");
            if (verifyimg.indexOf('?') > 0) {
                $(this).attr("src", verifyimg + '&random=' + Math.random());
            } else {
                $(this).attr("src", verifyimg.replace(/\?.*$/, '') + '?' + Math.random());
            }
        });
    });
</script>
<!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->

</div>

    <script type="text/javascript">
        $('#rechargeInfo').modal();
        $('#showRechargeInfo').click(function (event) {
            event.preventDefault();
            $('#rechargeInfo').modal();
        });
        $('#weixin-pay').click();
        function paytypeSelect($type) {
            if ($type==1){
                $('#weixin-account').show();
                $('#ali-account').hide();
            } else{
                $('#weixin-account').hide();
                $('#ali-account').show();
            }
        }
    </script>


<!-- /底部 -->
</body>
</html>