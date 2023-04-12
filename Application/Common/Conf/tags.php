<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
return array(
    'app_init'     => array('Common\Behavior\InitModuleBehavior'), //初始化安装的模块行为扩展
    'app_begin'    => array('Common\Behavior\InitConfigBehavior'), //初始化系统配置行为扩展
    'action_begin' => array('Common\Behavior\InitHookBehavior'), //初始化插件钩子行为扩展
    'app_end'      => array('Behavior\CronRunBehavior'), //定时任务行为扩展
);
