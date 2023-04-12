<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <title>玩法规则说明</title>
    <link type="text/css" rel="stylesheet" href="/./Application/Home/Template/Public/css/base.css"  />
    <link type="text/css" rel="stylesheet" href="/./Application/Home/Template/Public/css/style.css"  />
</head>
<body>
<style>
    body{
        background: url(/./Application/Home/Template/Public/images/bodybg.jpg)/*tpa=http://www.fafa8889.com/Public/Home/images/bodybg.jpg*/ no-repeat !important;
        background-size: cover !important;
    }
</style>
<div class="rm_cont">
    <div class="rm_tt">
        <img src="/./Application/Home/Template/Public/images/wf_tt.jpg" />
    </div>
    <div class="wanf_box">
        <h3 class="wf_tt">
            【<?php echo C('WEB_NAME');?>】 <?php echo C('WEB_JINGCAI_TIP');?>
        </h3>
        <h3 class="wf_tt wf_tt1">
            开奖时间：全天24小时
        </h3>
        <div class="ruls_txtbox">
            <div class="rtxtb_sp">投注规则</div>
            <?php echo C('GUESS_GAME_RULE');?>
        </div>
    </div>
    <div class="footbtn">
        <a href="<?php echo U('User/User/toregist');?>" >立即注册</a>
        <a class="reback" href="<?php echo U('Home/Index/index');?>" >返回首页</a>
    </div>
</div>
</body>
</html>