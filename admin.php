<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

/**
 * Content-type设置
 */
header("Content-type: text/html; charset=utf-8");

/**
 * PHP版本检查
 */
if (version_compare(PHP_VERSION,'5.3.0','<')) {
    die('require PHP > 5.3.0 !');
}

/**
 * PHP报错设置
 */
error_reporting(E_ALL^E_NOTICE^E_WARNING);

/**
 * 开发模式环境变量前缀
 */
define('ENV_PRE', 'OC_');

/**
 * 定义后台标记
 */
define('MODULE_MARK', 'Admin');

define('ROOT_PATH',__DIR__.'/');

/**
 * 应用目录设置
 * 安全期间，建议安装调试完成后移动到非WEB目录
 */
define('APP_PATH', './Application/');

/**
 * 缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define('RUNTIME_PATH', './Public/Tmp/');

/**
 * 静态缓存目录设置
 * 此目录必须可写，建议移动到非WEB目录
 */
define('HTML_PATH', RUNTIME_PATH.'Html/');

/**
 * 包含开发模式数据库连接配置
 */
if (@$_SERVER[ENV_PRE.'DEV_MODE'] !== 'true') {
    @include './Data/dev.php';
}

/**
 * 系统调试设置, 项目正式部署后请设置为false
 */
define('APP_DEBUG', @$_SERVER[ENV_PRE.'APP_DEBUG'] ? : true);

/**
 * 系统安装及开发模式检测
 */
if (is_file('./Data/install.lock') === false && @$_SERVER[ENV_PRE.'DEV_MODE'] !== 'true') {
    define('BIND_MODULE','Install');
}

/**
 * 引入核心入口
 * ThinkPHP亦可移动到WEB以外的目录
 */
require './Public/Sdk/Sdk.php';
