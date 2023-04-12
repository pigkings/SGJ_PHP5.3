<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

/**
 * Builder配置文件
 */
return array(
    //表单类型
    'FORM_ITEM_TYPE' => array(
        'hidden'     => array('隐藏', 'varchar(32) NOT NULL'),
        'static'     => array('不可修改文本', 'varchar(128) NOT NULL'),
        'num'        => array('数字', 'int(11) UNSIGNED NOT NULL'),
        'price'      => array('价格', 'int(11) UNSIGNED NOT NULL'),
        'text'       => array('单行文本', 'varchar(128) NOT NULL'),
        'textarea'   => array('多行文本', 'varchar(256) NOT NULL'),
        'array'      => array('数组', 'varchar(32) NOT NULL'),
        'password'   => array('密码', 'varchar(64) NOT NULL'),
        'radio'      => array('单选按钮', 'varchar(32) NOT NULL'),
        'checkbox'   => array('复选框', 'varchar(32) NOT NULL'),
        'select'     => array('下拉框', 'varchar(32) NOT NULL'),
        'icon'       => array('字体图标', 'varchar(32) NOT NULL'),
        'date'       => array('日期', 'int(11) UNSIGNED NOT NULL'),
        'datetime'   => array('时间', 'int(11) UNSIGNED NOT NULL'),
        'picture'    => array('单张图片', 'int(11) UNSIGNED NOT NULL'),
        'pictures'   => array('多张图片', 'varchar(32) NOT NULL'),
        'file'       => array('单个文件', 'varchar(32) NOT NULL'),
        'files'      => array('多个文件', 'varchar(32) NOT NULL'),
        'media'      => array('单个媒体', 'varchar(32) NOT NULL'),
        'medias'     => array('多个媒体', 'varchar(32) NOT NULL'),
        'kindeditor' => array('HTML编辑器 kindeditor', 'text'),
        'editormd'   => array('Markdown编辑器 editormd', 'text'),
        'tags'       => array('标签', 'varchar(128) NOT NULL'),
        'board  '    => array('拖动排序', 'varchar(256) NOT NULL')
    )
);
