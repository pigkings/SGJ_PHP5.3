<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

//开发者二次开发公共函数统一写入此文件，不要修改function.php以便于系统升级。
function get_admin_info()
{
    return session('user_auth') ?: "";
}

/**
 * 获取充值记录的状态
 * @param $status
 * @return string
 */
function getRechargeStatus($status)
{

    switch ($status) {
        case "1":
            $status = '审核中';
            break;
        case "2":
            $status = '驳回申请';
            break;
        case "3":
            $status = '充值成功';
            break;
    }
    return $status;
}

/**
 * 提现记录的状态
 * @param $status
 * @return string
 */
function getWithdrawStatus($status)
{

    switch ($status) {
        case "1":
            $status = '审核中';
            break;
        case "2":
            $status = '驳回申请';
            break;
        case "3":
            $status = '兑换成功';
            break;
    }
    return $status;
}


/**
 * 通过用户ID获取用户帐号信息
 * @param $userId
 * @return mixed
 */
function get_user_account($userId)
{
    $accountModel = M('user_account');
    $condition['user_id'] = $userId;
    $accountRs = $accountModel->where($condition)->find();
    return $accountRs;
}

/**
 * 通过投注号码获取获奖赔率
 * @param $hitnum
 * @return bool
 */
function getPeiLv($hitnum)
{
    $model = M('admin_slider');
    $condition['hitnum'] = $hitnum;
    $rs = $model->where($condition)->field('award')->find();
    if ($rs) {
        return $rs['award'];
    }
    return false;
}

/**
 * 获取最后一期已经开奖的信息
 * @return mixed
 */
function get_last_opened_term()
{
    $termModel = M('term');
    $termCondition['hit_num'] = array('exp', 'is not null');
    $termInfo = $termModel->where($termCondition)->order('id desc')->find();
    return $termInfo;
}

/**
 * 获取最后一起尚未开奖的信息
 * @return mixed
 */
function get_last_unopen_term()
{
    $termModel = M('term');
    $termCondition['hit_num'] = array('exp', 'is null');
    $termInfo = $termModel->where($termCondition)->order('id desc')->find();
    return $termInfo;
}

/**
 * 获取中奖号码的图片
 * @param $hit_num
 * @return mixed
 */
function get_hit_num_img($hit_num)
{
    $sliderModel = M('admin_slider');
    $sliderCondition['s.hitnum'] = $hit_num;
    $rs =  $sliderModel->alias('s')->field('au.path as img')->join("__ADMIN_UPLOAD__ as au on s.cover = au.id")->where($sliderCondition)->find();
    return $rs['img'];
}

/**
 * focket 打开远程连接
 * @param $url
 * @param $query
 */
function sock_post($url, $query)
{

    $info = parse_url($url);

    $fp = fsockopen($info["host"], 80, $errno, $errstr, 3);

    $head = "POST " . $info['path'] . "?" . $info["query"] . " HTTP/1.0\r\n";

    $head .= "Host: " . $info['host'] . "\r\n";

    $head .= "Referer: http://" . $info['host'] . $info['path'] . "\r\n";

    $head .= "Content-type: application/x-www-form-urlencoded\r\n";

    $head .= "Content-Length: " . strlen(trim($query)) . "\r\n";

    $head .= "\r\n";

    $head .= trim($query);

    $write = fputs($fp, $head);

}

/**
 * 设置自动开奖
 */
function start_auto_open(){
    if (file_exists(ROOT_PATH.'Public/game_run')){
        $url = U('Admin/Auto/close');
        echo "<li><a href=\"{$url}\" class=\"btn ajax-get \"><i class=\"fa fa-trash\"></i> 关闭自动开奖功能</a></li>";
    } else {
        $url = U('Admin/Auto/open');
        echo "<li><a href=\"{$url}\" class=\"btn ajax-get \"><i class=\"fa fa-trash\"></i> 开启自动开奖功能</a></li>";
    }
}

/**
 * 设置开始或者暂停自动开奖
 */
function pause_auto_open(){
    if (file_exists(ROOT_PATH.'Public/game_run')){
        if (file_exists(ROOT_PATH.'Public/game_pause')){
            $url = U('Admin/Auto/start');
            echo "<li><a href=\"{$url}\" class=\"btn ajax-get \"><i class=\"fa fa-trash\"></i> 自动开奖启动</a></li>";
        } else {
            $url = U('Admin/Auto/pause');
            echo "<li><a href=\"{$url}\" class=\"btn ajax-get \"><i class=\"fa fa-trash\"></i> 自动开奖暂停</a></li>";
        }
    }

}

function get_now_week(){
    $weekarray=array("日","一","二","三","四","五","六");
    return "星期".$weekarray[date("w")];
}