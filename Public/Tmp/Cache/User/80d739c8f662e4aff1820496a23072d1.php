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
    
    <style>
        .bet-header {
            margin-bottom: 1em;
            box-shadow: 0 1px 5px rgba(0, 0, 0, .3);
        }

        .qiShu {
            font-size: 18px;
            font-weight: 700;
            color: #f50b0b;
        }

        .bet-m,
        .bet-s {
            color: #d70101;
            font-size: 18px;
        }

        .bet-state {
            color: #000;
            text-align: center;
        }

        .bet-list {
            font-size: 15px;
            text-align: center;
        }

        .bet-list li {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .btn-betNow {
            background-color: #fff;
            text-align: center;
            width: 10em;
        }

        #tipContent {
            color: red;
        }

        .bet-logs-table th {
            border-right: 1px solid #f5e79e;
            border-left: 1px solid #f5e79e;
        }

        .input-lg {
            background: #fff;
            border: none;
            box-shadow: 1px 1px 5px #aaa inset;
            -webkit-appearance:none;
            outline: none;
        }
    </style>

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
    
    <!-- 左侧 nav
            ================================================== -->
    <div class="span3 bs-docs-sidebar">

        <ul class="nav nav-list bs-docs-sidenav">

        </ul>
    </div>

    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-11 main_set">
            <div class="text-center bet-header">
                <h4 class="cur_time">
                    当前时间: <span id="serverTime">2016-08-02&nbsp;&nbsp;16:11:54&nbsp;&nbsp;星期二</span>
                </h4>
                <div style="height: 1em;"></div>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td width="48%">
                            <?php $userAccount = get_user_account($user_info['id']); ?>
                            <div class="ucinfo_box">
                                <p class="u_score"><?php echo ((isset($userAccount["account"]) && ($userAccount["account"] !== ""))?($userAccount["account"]):0.00); ?><i>分</i></p>
                                <p class="u_namep"><?php echo ($user_info["nickname"]); ?></p>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <!--获取最后一期尚未开奖的信息-->
                                <?php $lastUnopenTerm = get_last_unopen_term(); $lastUnopenTerm['start'] = date('H:i:s',$lastUnopenTerm['start_time']); $lastUnopenTerm['end'] = date('H:i:s',$lastUnopenTerm['end_time']); ?>
                                <h4 class="timer_h4">
                                    当前 <span class="qiShu" id="qiShu"><?php echo ($lastUnopenTerm["id"]); ?></span> 期,竞猜倒计时：
                                    <div class="timer_box">
                                        <em>
                                            <p>分</p>
                                            <span class="bet-m" id="min">3</span>
                                        </em>
                                        <em>
                                            <p>秒</p>
                                            <span class="bet-s" id="second">6</span>
                                        </em>
                                    </div>
                                </h4>

                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <!--获取最后一期开奖结果-->
                <?php $lastOpenTerm = get_last_opened_term(); ?>
                <div class="last_opened">
                    <span>上次开奖:</span>
                    <img width="30px;" src="<?php echo get_hit_num_img($lastOpenTerm['hit_num']);?>">
                    今日已下注<span> <?php echo ($todayInfo["bet_money"]); ?></span>，今日已中奖<span><?php echo ($todayInfo["award_money"]); ?> </span>
                </div>
            </div>
            <form id="bet-form" action="<?php echo U('Home/Bet/doBet');?>" method="post">
                <h5 class="bet-state">最低下注<?php echo (C("GUESS_LIMIT_SCORE")); ?>分，输入分数后提交下注</h5>
                <ul class="list list-unstyled bet-list">
                    <input type="hidden" name="periods" value="195" id="periodsValue">
                    <?php if(is_array($sliders)): foreach($sliders as $key=>$slider): ?><li>
                            <img width="30px" src="<?php echo ($slider["cover_url"]); ?>">
                            <span><?php echo ($slider["title"]); ?>：</span>
                            <input  id="amount_<?php echo ($slider["hithum"]); ?>" type="text" placeholder="请输入投注金额" min="0" class="input-lg" name="betdata[<?php echo ($slider["hitnum"]); ?>]"
                                   onblur="setScore(this)">
                            <span>分</span>
                        </li><?php endforeach; endif; ?>
                    <li class="text-center">
                        <h5 class="bet-state" id="tipContent"></h5>
                        <input type="hidden" name="term_id" value="<?php echo ($lastUnopenTerm["id"]); ?>">
                        <button type="submit" class="btn btn-default btn-lg btn-betNow">立即下注</button>
                    </li>
                </ul>
            </form>
        </div>
    </div>

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
    var minprice =<?php echo (C("GUESS_LIMIT_SCORE")); ?>;
        var qishu = [];
        qishu.push(<?php echo json_encode($lastUnopenTerm);?>);
        syncGame();

        var now = "<?php echo time();?>";

        var week = '<?php echo get_now_week();?>';
        function getLocalTime(nS) {
            var t = new Date(parseInt(nS) * 1000)
            var h = t.getHours();
            var m = t.getMinutes();
            var s = t.getSeconds();

            if (h.toString().length == 1) {
                h = "0" + h.toString();
            }
            if (m.toString().length == 1) {
                m = "0" + m.toString();
            }
            if (s.toString().length == 1) {
                s = "0" + s.toString();
            }
            return h + ":" + m + ":" + s;
        }
        /*倒计时*/
        function setDaojishi() {

            var now_time = getLocalTime(now);
            var t = new Date(parseInt(now) * 1000)
            var d = t.getDate();
            if (d.toString().length == 1) {
                d = "0" + d.toString();
            }
            var m = new Date(parseInt(now) * 1000)
            var m = t.getMonth() + 1
            if (m.toString().length == 1) {
                m = "0" + m.toString();
            }
            document.getElementById("serverTime").innerHTML = t.getFullYear() + "-" + m + "-" + d + "&nbsp;&nbsp;" + now_time + "&nbsp;&nbsp;" + week;

            for (var i = 0; i < qishu.length; i++) {
                if (now_time == '12:00:00') {
                    window.location.reload();
                }
                if (now_time >= qishu[i].start && now_time <= qishu[i].end) {

                    $('#periodsValue').val(qishu[i].qishu);
                    //计算倒计时
                    var now_time_arr = now_time.split(":");
                    var now_time_sec = parseInt(now_time_arr[0]) * 60 * 60 + parseInt(now_time_arr[1]) * 60 + parseInt(now_time_arr[2]);
                    var end_arr = qishu[i].end.split(":");
                    var end_sec = parseInt(end_arr[0]) * 60 * 60 + parseInt(end_arr[1]) * 60 + parseInt(end_arr[2]);
                    var cha_sec = end_sec - now_time_sec;
                    var cha_min = Math.floor(cha_sec / 60);
                    var cha_second = cha_sec - Math.floor(cha_sec / 60) * 60;
                    document.getElementById('min').innerHTML = cha_min;
                    document.getElementById('second').innerHTML = cha_second;
                    //倒计时22秒
                    if (cha_sec == 10) {
                        soundManager.play('msgSound');
                    }
                    //禁止下注
                    if (cha_sec <= 5) {
                        document.getElementById('tipContent').innerHTML = "现在禁止投注！";
                        $("input[name^='fruit']").each(function () {
                            $(this).attr('disabled', 'true');
                        });
                        $("textarea[name='mark']").attr('disabled', 'true');
                        $('.btn-betNow').attr('disabled', "true");
                    } else {
                        $("input[name^='fruit']").each(function () {
                            $(this).removeAttr('disabled', 'true');
                        });
                        $("textarea[name='mark']").removeAttr('disabled');
                        $('.btn-betNow').removeAttr('disabled');
                    }
                    //开奖
                    if (cha_sec == 0) {
                        syncGame();
                        setTimeout(function () {
                            window.location.reload();

                        }, 1500);
                    }
                    //每五秒获取一次系统时间
                    if (now % 5 == 0) {
                        updateTime();
                    }
                }
            }

            now = parseInt(now) + 1;
        }
        function syncGame() {
            var url = "<?php echo U('Home/Index/index');?>";
            $.get(url,'',function(){

            });
        }
        //定时更新
        setInterval("setDaojishi()", 1000);

        /*更新服务器时间*/
        function updateTime() {
            $.getJSON("<?php echo U('Home/Index/getTime');?>", function (data) {
                now = data.time;
            });
        }
    </script>
    <script type="text/javascript">
        //检查现在是否可以提交
        function checkShortSubmit() {
            var now_time = getLocalTime(now);
            for (var i = 0; i < qishu.length; i++) {
                if (now_time >= qishu[i].start && now_time <= qishu[i].end) {
                    //计算倒计时
                    var now_time_arr = now_time.split(":");
                    var now_time_sec = parseInt(now_time_arr[0]) * 60 * 60 + parseInt(now_time_arr[1]) * 60 + parseInt(now_time_arr[2]);
                    var end_arr = qishu[i].end.split(":");
                    var end_sec = parseInt(end_arr[0]) * 60 * 60 + parseInt(end_arr[1]) * 60 + parseInt(end_arr[2]);
                    var cha_sec = end_sec - now_time_sec;
                    var cha_min = Math.floor(cha_sec / 60);
                    var cha_second = cha_sec - Math.floor(cha_sec / 60) * 60;
                    document.getElementById('min').innerHTML = cha_min;
                    document.getElementById('second').innerHTML = cha_second;
                    if (cha_sec >= 60) {
                        return true;
                    }
                }
            }
            return false;
        }

        function doCheck() {
            var flag = false;
            var total_fruit = 0;
            //计算现在是否可以提交
            var can_submit = checkShortSubmit();
            if (!can_submit) {
//                alert('本期提交时间已结束,请等待...');
                return false;
            }
            var amount = 0;
            amount = $("#amount_1").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('苹果积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_2").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('葡萄积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_3").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('菠萝积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_4").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('草莓积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_5").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('西瓜积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_6").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('香蕉积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_7").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('买大积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_8").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('买小积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_9").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('买单积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            amount = $("#amount_10").val();
            if (amount != '') {
                if (!/^\d+$/.test(amount)) {
//                    alert('买双积分错误');
                    return;
                }
                total_fruit += parseInt(amount);
                flag = true;
            }
            if (parseInt(total_fruit) < minprice) {
                alert('请至少选择一项下注');
                flag = true;
                return;
            }
            return flag;
        }
        function setScore(o) {
            var value = o.value;
            if (value < minprice && value > 0) {
                value = minprice;
            }
            o.value = value;
        }
    </script>


<!-- /底部 -->
</body>
</html>