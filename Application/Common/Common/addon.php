<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

/**
 * 处理插件钩子
 * @param string $hook   钩子名称
 * @param mixed $params 传入参数
 * @return void
 *
 */
function hook($hook, $params = array()) {
    \Think\Hook::listen($hook,$params);
}

/**
 * 获取插件类的类名
 * @param strng $name 插件名
 *
 */
function get_addon_class($name) {
    $class = "Addons\\{$name}\\{$name}Addon";
    return $class;
}

/**
 * 插件显示内容里生成访问插件的url
 * @param string $url url
 * @param array $param 参数
 *
 */
function addons_url($url, $param = array()) {
    return D('Admin/Addon')->getAddonUrl($url, $param);
}
