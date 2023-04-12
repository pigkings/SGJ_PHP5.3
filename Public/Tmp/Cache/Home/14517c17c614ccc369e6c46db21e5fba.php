<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title><?php echo C('WEB_SITE_TITLE');?></title>
    <meta name="keywords" content="<?php echo ($meta_keywords); ?>">
    <meta name="description" content="<?php echo ($meta_description); ?>">
    <link type="text/css" rel="stylesheet" href="/./Application/Home/Template/Public/css/base.css">
    <link type="text/css" rel="stylesheet" href="/./Application/Home/Template/Public/css/style.css">
    <script type="text/javascript" src="/./Application/Home/Template/Public/js/jquery-1.6.4.min.js"></script>
    <style>
        body {
            background: url(/./Application/Home/Template/Public/images/bodybg.jpg) no-repeat !important;
            background-size: cover !important;
        }

        .time-item strong {
            display: inline-block;
            background: #fff;
            border: 2px solid #ff3939;
            color: #ff3939;
            line-height: 49px;
            font-size: 36px;
            font-family: Arial;
            border-radius: 5px;
            margin: 0 5px;
            width: 80px;
        }

        .time-item strong p {
            font-weight: normal;
            font-size: 14px;
            font-style: normal;
            height: 1.5em;
            line-height: 1.5em;
            border-bottom: 2px solid #ff3939;
        }

        .time-item strong font {
            display: inline-block;
        }

        #day_show {
            float: left;
            line-height: 49px;
            color: #c71c60;
            font-size: 32px;
            margin: 0 10px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .item-title .unit {
            background: none;
            line-height: 49px;
            font-size: 24px;
            padding: 0 10px;
            float: left;
        }
        /*头部LOGO*/
        .block0 {
            font-size: 1.3em;
            color: #f50b0b;
            background: url(<?php echo (get_cover(C("WEB_SITE_LOGO"))); ?>) no-repeat center center;
            line-height: 161px;
            margin: .5em auto;
            text-align: center;
        }

        .block1 {
            width: 21.875em;
            height: 4em;
            margin: .3em auto;
        }

        .block1_1 {
            margin-left: 0%;
            height: 2em;
        }

        .block1_2 {
            margin-left: 3%;
            height: 2em;
            line-height: 2em;
        }

        .block1_2 p img {
            display: inline;
            padding-top: .5em;
        }

        .block1_4 {
            margin-left: 1%;
            margin-right: 1%;
            height: 2em;
            line-height: 2em;
        }

        .block1_3 {
            margin-left: 0%;
            height: 120px;
            line-height: 2em;
            text-align: center;
            position: relative;
        }

        a {
            text-decoration: none
        }

        .xuanshi_banner {
            width: 21.875em;
            margin: .5em auto;
        }

        .b12bgrey {
            background: #eee;
            color: #000;
            font-size: 0.75em;
            padding: .3em 0;
            height: 1.2em;
            line-height: 1.2em;
            text-align: center;
        }

        .block2 {
            width: 320px;
            margin: .5em auto;
            height: 120px;
            border-bottom: 1px dashed #CCC;
            overflow: hidden;
        }

        .block2_1 {
            width: 4em;
        }

        .block2_2 {
            width: 16.625em;
        }

        .block2_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block11 {
            width: 21.875em;
            margin: .5em auto;
            height: 9em;
            border-bottom: 1px dashed #CCC;
            font-size: 1.1em;
        }

        .block11_1 {
            width: 4em;
        }

        .block11_2 {
            width: 16.625em;
        }

        .block11_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block5 {
            width: 21.875em;
            margin: .5em auto;
            height: 5.5em;
            border-bottom: 1px dashed #CCC;
        }

        .block5_1 {
            width: 4em;
        }

        .block5_2 {
            width: 20.625em;
            margin-left: .3em;
        }

        .block5_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block6 {
            width: 100%;
            margin: .5em auto;
            _height: 200px;
            text-align: center;
        }

        .block6_1 {
            width: 4em;
        }

        .block6_2 {
            width: 20em;
            margin-bottom: 1em;
            color: #000000;
            display: block;
            margin: 0 auto;
        }

        .block6_2 img {
            margin-right: .4em;
        }

        .block7 {
            width: 21.875em;
            margin: .5em auto;
            height: 3em;
            border-bottom: 1px dashed #CCC;
        }

        .block7_1 {
            width: 4em;
        }

        .block7_2 {
            width: 20.625em;
            margin-left: .3em;
        }

        .block7_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block8 {
            width: 21.875em;
            margin: .5em auto;
            _height: 200px;
            border-bottom: 1px dashed #CCC;
        }

        .block8_1 {
            width: 4em;
        }

        .block8_2 {
            width: 19.625em;
            margin-left: .3em;
            margin-bottom: .4em;
        }

        .block8_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block9 {
            width: 21.875em;
            margin: .5em auto;
            _height: 200px;
            border-bottom: 1px dashed #CCC;
        }

        .block9_1 {
            width: 4em;
        }

        .block9_2 {
            width: 14.625em;
            margin-left: .3em;
            margin-bottom: 1.5em;
            color: #000000;
        }

        .block9_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block12 {
            width: 21.875em;
            margin: .5em auto;
            _height: 200px;
            border-bottom: 1px dashed #CCC;
        }

        .block12_1 {
            width: 4em;
        }

        .block12_2 {
            width: 14.625em;
            margin-left: .3em;
            margin-bottom: 1.5em;
            color: #000000;
        }

        .block12_2 img {
            margin-right: .4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .block10 {
            width: 21.875em;
            margin: .5em auto;
            height: 6em;
            border-bottom: 0px dashed #CCC;
        }

        .block10_1 {
            width: 4em;
        }

        .block10_2 {
            width: 16.625em;
        }

        .block10_2 img {
            margin-left: 2.4em;
            border: 1px solid #db5b4c;
            padding: .2em;
        }

        .btn {
            margin: 2em auto;
            /*32px / 16px*/
        }

        .btn a {
            display: block;
        }

        .footer li {
            float: left;
            display: inline;
            width: 100%;
        }

        .b1 {
            background: url(__HOME_IMG_/copy2.png) no-repeat center 0px;
        }

        .input_common_box1 {
            float: left;
            width: 30%;
            background: #ffffff;
            border: 1px solid #b9b9b9;
            color: #999;
            height: 0.675em;
            /*14px/16px*/
            font-size: 0.875em;
            /*14px/16px*/
            padding: 0.8125em 0.375em;
            /*6px/16px*/
        }

        .b1 a {
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            color: #542828;
        }

        .b2 a {
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            color: #999;
        }

        .b3 a {
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            color: #999;
        }

        .yanzheng a {
            font-size: 0.875em;
            color: #999999;
            margin-left: .5em;
            text-decoration: none;
            line-height: 2.2em;
            height: 1em;
        }

        .f14blue {
            font-size: .975em;
            background: #14a114;
            height: 2em;
            /*40px/16px*/
            line-height: 2em;
            /*40px/16px*/
            font-weight: bold;
            color: #ffd014;
            text-align: center;
        }

        .f14yellow {
            font-size: .975em;
            background: #14a114;
            height: 2em;
            /*40px/16px*/
            line-height: 2em;
            /*40px/16px*/
            font-weight: bold;
            color: #ffd014;
            text-align: center;
        }

        .datalist {
            border: 1px solid #771804;
            /* 表格边框 */
            font-family: Arial;
            border-collapse: collapse;
            /* 边框重叠 */
            background-color: #eaf5ff;
            /* 表格背景色 */
            font-size: 12px;
        }

        .datalist caption {
            padding: .5em 0;
            margin-top: 5px;
            margin-bottom: .8em;
            text-align: center;
            font-size: 16px;
            background: rgba(255, 255, 255, .6);
        }

        .datalist th {
            border: 1px solid #d57e26;
            /* 行名称边框 */
            background-color: #f3b67a;
            /* 行名称背景色 */
            color: #000;
            /* 行名称颜色 */
            font-weight: bold;
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 12px;
            padding-right: 12px;
            text-align: center;
        }

        .datalist td {
            border: 1px solid #f6cd76;
            /* 单元格边框 */
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 10px;
            padding-right: 10px;
            text-align: center;
            color: #000;
        }

        .datalist tr.altrow {
            background-color: #c7e5ff;
            /* 隔行变色 */
        }

        .biaoge2 {
            border: 1px solid #771804;
            /* 表格边框 */
            font-family: Arial;
            border-collapse: collapse;
            /* 边框重叠 */
            background-color: #eaf5ff;
            /* 表格背景色 */
            font-size: 12px;
        }

        .biaoge2 caption {
            padding-bottom: 5px;
            margin-top: 5px;
            margin-bottom: 2px;
            font: bold 1.4em;
            text-align: left;
            font-size: 16px;
        }

        .biaoge2 th {
            border: 1px solid #d57e26;
            /* 行名称边框 */
            background-color: #f3b67a;
            /* 行名称背景色 */
            color: #000;
            /* 行名称颜色 */
            font-weight: bold;
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 12px;
            padding-right: 12px;
            text-align: left;
        }

        .biaoge2 td {
            border: 1px solid #f6cd76;
            /* 单元格边框 */
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 10px;
            padding-right: 12px;
            text-align: left;
            color: #000;
        }

        .biaoge2 tr.altrow {
            background-color: #c7e5ff;
            /* 隔行变色 */
        }

        .biaoge3 {
            border: 1px solid #771804;
            /* 表格边框 */
            font-family: Arial;
            border-collapse: collapse;
            /* 边框重叠 */
            background-color: #eaf5ff;
            /* 表格背景色 */
            font-size: 16px;
        }

        .biaoge3 caption {
            padding-bottom: 5px;
            margin-top: 5px;
            margin-bottom: 2px;
            font: bold 1.4em;
            text-align: left;
            font-size: 14px;
        }

        .biaoge3 th {
            border: 1px solid #d57e26;
            /* 行名称边框 */
            background-color: #e4978d;
            /* 行名称背景色 */
            color: #000;
            /* 行名称颜色 */
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 12px;
            padding-right: 12px;
            text-align: center;
        }

        .biaoge3 td {
            border: 1px solid #f6cd76;
            /* 单元格边框 */
            padding-top: 4px;
            padding-bottom: 4px;
            padding-left: 10px;
            padding-right: 10px;
            text-align: center;
            color: #000;
        }

        .biaoge3 tr.altrow {
            background-color: #c7e5ff;
            /* 隔行变色 */
        }

        .STYLE1 {
            color: #000000;
            font-size: large;
            font-weight: bold;
        }
    </style>
</head>

<body>
<div id="container">
    <div class="widthauto block0">&nbsp;</div>
    <div class="widthauto f14blue">
        <p id="serverTime">2016-06-06&nbsp;&nbsp;16:16:16&nbsp;&nbsp;星期二</p>
    </div>
    <!--开奖部分-->
    <div class="block2" >
        <div class="block1_3"><img src="/./Application/Home/Template/Public/images/88.gif" ></div>
        <div class="kuai kuai1"></div>
        <div class="kuai kuai2" ></div>
        <div class="kuai kuai3" ></div>
        <div class="kuai kuai4" ></div>
        <div class="kuai kuai5" ></div>
        <div class="kuai kuai6" ></div>
        <style type="text/css">
            .block2 {
                position: relative;
            }

            .block2 .kuai {
                position: absolute;
                height: 28px;
                bottom: 7px;
                display: none;
                background: url('/./Application/Home/Template/Public/images/ok.gif') no-repeat center center;
                text-align: center;
            }

            .block2 .kuai.kuai1 {
                left: 9px;
                width: 45px;
            }

            .block2 .kuai.kuai2 {
                left: 57px;
                width: 49px
            }

            .block2 .kuai.kuai3 {
                left: 108px;
                width: 48px
            }

            .block2 .kuai.kuai4 {
                left: 159px;
                width: 49px;
            }

            .block2 .kuai.kuai5 {
                left: 210px;
                width: 48px;
            }

            .block2 .kuai.kuai6 {
                left: 261px;
                width: 47px;
            }
        </style>
    </div>
    <script type="text/javascript">
        $(function () {
            /*中奖结果*/
            var inputlastResult = $("#inputlastResult").val();

            var src1 = "/./Application/Home/Template/Public/images/num_" + inputlastResult + ".jpg";
            var src2 = "/./Application/Home/Template/Public/images/big_" + inputlastResult + ".jpg";
            var speed = 100;
            var i = 1;
            var timei = 1;
            var endi = 9 * 6;
            var stopIn = '';
            /*头部跑马灯*/
            function kuaiGo() {
                if (timei == endi - 6 * 3) {
                    speed = speed * 2;
                }
                if (timei == endi - 6 * 2) {
                    speed = speed * 2;
                }
                if (timei == endi - 6) {
                    speed = speed * 2;
                    stopIn = inputlastResult;
                }
                setTimeout(function () {
                    $('.kuai' + i).show();
                    setTimeout(function () {

                        if (stopIn != '' && i == stopIn) {
                            var kuai_count = 1;
                            var shanshuo = setInterval(function(){
                                console.log(kuai_count);
                                if (kuai_count >=15){
                                    $('.kuai' + i).show();
                                    clearInterval(shanshuo);
                                    return false;
                                }
                                $('.kuai' + i).toggle();
                                kuai_count++;
                            },150);

                            return false;
                        }
                        $('.kuai' + i).hide();
                        if (i < 6) {
                            i++;
                        } else {
                            i = 1;
                        }
                        if (timei == endi) {
                            return false;
                        } else {
                            timei++;
                            kuaiGo();
                        }
                    }, speed / 5 * 4);
                }, speed / 5);
            }

            kuaiGo();
        });
    </script>
    <!--开奖部分-->
    <div class="block6">
        <!--搜索记录块开始-->
        <div class="block6_2">
            <div class="gonggao">
                <div class="info-img"><img src="/./Application/Home/Template/Public/images/gonggao.png"></div>
                <div class="info-content">
                    <marquee scrollamount="4" onMouseOut="this.start()" onMouseOver="this.stop()"><?php echo C('GUESS_HOME_GG');?></marquee>
                </div>
                <div style="clear: both"></div>
            </div>
            <table width="100%" class="datalist" summary="list of members in EE Studay">
                <caption>
                    <font color="#000000">
                        <p style="margin-bottom: 8px;">当前在线人数</p>
                        <div class="numberRun4">
                            <div class="mt-number-animate">
                                <div class="mt-number-animate-dom" data-num="4"></div>
                                <div class="mt-number-animate-dom" data-num="5"></div>
                                <div class="mt-number-animate-dom" data-num="9"></div>
                                <div class="mt-number-animate-dom" data-num="8"></div>
                            </div>
                        </div>
                        <!--获取最后一期尚未开奖的信息-->
                        <?php $lastUnopenTerm = get_last_unopen_term(); $lastUnopenTerm['start'] = date('H:i:s',$lastUnopenTerm['start_time']); $lastUnopenTerm['end'] = date('H:i:s',$lastUnopenTerm['end_time']); ?>
                        <br>当前第<font color="red" id="qishu"><?php echo ($lastUnopenTerm["id"]); ?></font> 场，竞猜倒计时：
                        <div style="padding-top: 8px;" class="time-item">
                            <strong id="minute_show">
                                <p>分</p>
                                <font id="min">0</font>
                            </strong>
                            <strong id="second_show">
                                <p>秒</p>
                                <font id="second">00</font>
                            </strong>
                        </div>
                        <style type="text/css">
                            .tz_btn {
                                width: 200px;
                                height: 50px;
                                background: #FF3939;
                                line-height: 50px;
                                display: inline-block;
                                margin: 20px 0 10px 0;
                                font-size: 28px;
                                color: #fff;
                                border-radius: 8px;
                                font-weight: bold;
                            }

                            .tz_btn_admin {
                                width: 200px;
                                height: 50px;
                                background: #FF3939;
                                line-height: 50px;
                                display: inline-block;
                                margin: 0px 0 10px 0;
                                font-size: 28px;
                                color: #fff;
                                border-radius: 8px;
                                font-weight: bold;
                            }
                        </style>
                        <a href="<?php echo U('User/Center/index');?>" class="tz_btn">立即下注</a>
                        <!--获取最后一期开奖结果-->
                        <?php $lastOpenTerm = get_last_opened_term(); ?>
                        <p>第<font color="red"><?php echo ($lastOpenTerm["id"]); ?></font> 期开奖结果</p>
                        <?php if(empty($lastOpenTerm)): ?><img id="kj1" style="margin-top:10px;" src="/./Application/Home/Template/Public/images/null.jpg" width="100" height="100">
                            <img id="kj2" style="margin-top:10px;" src="/./Application/Home/Template/Public/images/null.jpg" width="100" height="100">
                            <?php else: ?>
                            <img id="kj1" style="margin-top:10px;" src="/./Application/Home/Template/Public/images/num_<?php echo ($lastOpenTerm["hit_num"]); ?>.jpg" width="100" height="100">
                            <img id="kj2" style="margin-top:10px;" src="<?php echo get_hit_num_img($lastOpenTerm['hit_num']);?>" width="100" height="100"><?php endif; ?>

                        <input type="hidden" id="inputlastResult" name="inputlastResult" value="<?php echo ($lastOpenTerm['hit_num']); ?>">
                    </font></caption>
                <tbody>
                <tr>
                    <th scope="col" width="70px;">场次</th>
                    <th scope="col">中奖</th>
                    <th scope="col" width="70px;">场次</th>
                    <th scope="col">中奖</th>
                </tr>
                <!-- 未开始状态 -->
                <!--期数开始-->
                <?php if(is_array($termList)): foreach($termList as $k=>$term): if(($k%2) == 0): if(($k%3) == 0): ?><tr class="altrow">
                            <?php else: ?>
                            <tr><?php endif; ?>
                            <td scope="col" style="font-size: 17px;"><?php echo ($term['id']); ?>场</td>
                            <td scope="col">
                                <img width="30px" src="<?php echo get_hit_num_img($term['hit_num']);?>">
                            </td>
                            <?php else: ?>
                            <td scope="col" style="font-size: 17px;"><?php echo ($term['id']); ?>场</td>
                            <td scope="col">
                                <img width="30px" src="<?php echo get_hit_num_img($term['hit_num']);?>"></td>
                        </tr><?php endif; endforeach; endif; ?>
                <!--期数结束-->

                </tbody>
            </table>
        </div>
    </div>
    <!--搜索记录块结束-->

    <div class="block6">
        <div class="block6_2" >
            <table width="100%" class="biaoge3" summary="list of members in EE Studay">
            <thead>
                    <tr><th>上一期的获奖用户</th></tr>
            </thead>
            </table>
        </div>
    </div>


    <div class="block6" id="demo" style="overflow: hidden; height: 344px;">
        <div class="block6_2" id="demo1">
            <table width="100%" class="biaoge3" summary="list of members in EE Studay">
                <tbody>
                     <?php if(is_array($randuser)): foreach($randuser as $key=>$v): ?><tr>
                            <td style="color:#a43529; font-size:16px;line-height:30px;width:314px;">恭喜 <?php echo ($v['user']); ?> 喜中 <?php echo ($v['money']); ?> 积分</td>
                        </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
         <div class="block6_2" id="demo2"></div>
    </div>


    <!--搜索记录块开始-->
    <div class="block6">
        <div class="block6_2">
            <table width="100%" class="biaoge3" summary="list of members in EE Studay">
                <tbody>
                <tr>
                    <td style="color:#a43529; font-size:16px;line-height:30px;width:314px;">开奖时间：全天24小时</td>
                </tr>
                <tr>
                    <td style="color:#a43529; font-size:16px;line-height:30px;width:314px;"><?php echo C('WEB_JINGCAI_TIP');?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!--搜索记录块结束-->
    <div class="block10">
        <!--搜索记录块开始-->
        <div>
            <p style="color:#fff; font-size:14px;line-height:37px;text-align:center;">Copyright (c) 2017 <?php echo C('WEB_SITE_TITLE');?></p>
        </div>
    </div>
    <!--搜索记录块结束-->
</div>
<!--container-->
<script type="text/javascript" src="/./Application/Home/Template/Public/js/num.js"></script>
<script type="text/javascript" src="/./Application/Home/Template/Public/js/soundmanager2-jsmin.js"></script>
<script type="text/javascript">  
var speed = 50;  
demo2.innerHTML = demo1.innerHTML;  
function Marquee() {  
    if (demo2.offsetTop - demo.scrollTop <= 0) {  
        demo.scrollTop -= demo1.offsetHeight;  
    } else {  
        demo.scrollTop++;  
    }  
}  
var MyMar = setInterval(Marquee, speed);  
  
demo.onmouseover = function() {  
    clearInterval(MyMar);  
}  
  
demo.onmouseout = function() {  
    MyMar = setInterval(Marquee, speed);  
}  
</script> 

<script language="javascript" type="text/javascript">
//    soundManager = new SoundManager();
//    soundManager.debugMode = false;
//    soundManager.beginDelayedInit();
//    soundManager.onload = function () {
//        //信息音
//        soundManager.createSound({
//            id: 'msgSound',
//            url: '/./Application/Home/Template/Public/js/lastVoice.mp3'
//        });
//    }
    soundManager = new SoundManager();
    soundManager.debugMode = false;
    soundManager.url = '/swf/';
    soundManager.beginDelayedInit();
    soundManager.onload = function () {
        //信息音
        soundManager.createSound({
            id: 'msgSound',
            url: '/./Application/Home/Template/Public/js/lastVoice.mp3'
        });
    }

    var qishu = [];
    qishu.push(<?php echo json_encode($lastUnopenTerm);?>);


    var now = "<?php echo time();?>";

    var week = "<?php echo get_now_week();?>";

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
            if (now >= qishu[i].start_time && now <= qishu[i].end_time) {

                document.getElementById('qishu').innerHTML = qishu[i].id;

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
                if (cha_sec == 20) {
                    soundManager.play('msgSound');
                }
                if (cha_sec == 0) {
                    setTimeout(function () {
                        window.location.reload();
                    }, 1500);
                }
                if (now % 5 == 0) {
                    updateTime();
                }
            }
        }

        now = parseInt(now) + 1;
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
<div class="linecont"></div>
<div class="footbar">
    <div class="footbarcont">
        <p class="foot_tips"><?php echo C('WEB_JINGCAI_TIP');?></p>
        <p class="footlink">
            <?php $uid = is_login() ?>
            <?php if(empty($uid)): ?><a class="login_btn" href="<?php echo U('User/User/login');?>">立即登录</a>
                <a class="regist_btn" href="<?php echo U('User/User/toRegist');?>">立即注册</a>
                <?php else: ?>
                <a class="regist_btn" href="<?php echo U('User/Center/index');?>">立即下注</a>
                <a class="regist_btn" href="<?php echo U('Home/Index/rule');?>">游戏规则</a><?php endif; ?>
        </p>

    </div>
    <div class="foot_imgbox">
        <!--<a href="<?php echo U('Home/Index/rule');?>"><img src="/./Application/Home/Template/Public/images/game_rule.png"></a>-->
    </div>
</div>
<div id="rightsead">
    <ul>
<!--         <li>
    <a class="weixinewm">
        <img src="/./Application/Home/Template/Public/images/l09.png" width="47" height="49" class="shows">
        <div class="ewmcontbox">
            <img src="/./Application/Home/Template/Public/images/ewm.jpg">
        </div>
    </a>
</li> -->
<!--  
        <li>
            <a href="<?php echo U('User/recharge/add');?>">
                <img src="/./Application/Home/Template/Public/images/ll07.png" width="131" height="49" class="hides">
                <img src="/./Application/Home/Template/Public/images/l07.png" width="47" height="49" class="shows">
            </a>
        </li>
       <li>
    <a class="weixinewm">
        <img src="/./Application/Home/Template/Public/images/l08.png" width="47" height="49" class="shows">
        <div class="ewmcontbox ewmcontbox1">
            <img src="/./Application/Home/Template/Public/images/ewm.jpg">
        </div>
    </a>
</li> -->
 <!--        <li>
            <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=10373458&amp;site=qq&amp;menu=yes"> <img
                    src="/./Application/Home/Template/Public/images/ll04.png" width="131" height="49" class="hides">
                <img src="/./Application/Home/Template/Public/images/l04.png" width="47" height="49" class="shows">
            </a>
        </li>
        <li>
            <a id="top_btn">
                <img src="/./Application/Home/Template/Public/images/ll06.png" width="131" height="49" class="hides">
                <img src="/./Application/Home/Template/Public/images/l06.png" width="47" height="49" class="shows">
            </a>
        </li>
 -->
    </ul>
</div>
<script>
    $(function () {

        $("#rightsead a").hover(function () {
            if ($(this).prop("className") == "weixinewm") {
                $(this).children(".ewmcontbox").show();
            } else {
                $(this).children("img.hides").show();
                $(this).children("img.shows").hide();
                $(this).children("img.hides").animate({marginRight: '0px'}, 'slow');
            }
        }, function () {
            if ($(this).prop("className") == "weixinewm") {
                $(this).children(".ewmcontbox").hide('slow');
            } else {
                $(this).children("img.hides").animate({marginRight: '-143px'}, 'slow', function () {
                    $(this).hide();
                    $(this).next("img.shows").show();
                });
            }
        });

        $("#top_btn").click(function () {
            if (scroll == "off") return;
            $("html,body").animate({scrollTop: 0}, 600);
        });

        /*鼠标滚动显示与隐藏底部广告*/
        $(window).scroll(function(event){
            var winPos = $(window).scrollTop();
            if (winPos > 100){
                $('.footbar').slideUp();
            }else if(winPos <=100) {
                $('.footbar').slideDown();
            }
        });
    });
</script>


</body>
</html>