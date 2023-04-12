<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
// 模块信息配置
return array(
    // 模块信息
    'info' => array(
        'name'        => 'Admin',
        'title'       => '系统',
        'icon'        => 'fa fa-cog',
        'icon_color'  => '#3CA6F1',
        'description' => '核心系统',
        'developer'   => '红包竞猜系统',
        'website'     => '',
        'version'     => '1.3.0',
    ),

    // 后台菜单及权限节点配置
    'admin_menu' => array(
        '1' => array(
            'pid'   => '0',
            'title' => '系统',
            'icon'  => 'fa fa-cog',
            'level' => 'system',
        ),
        '2' => array(
            'pid'   => '1',
            'title' => '系统功能',
            'icon'  => 'fa fa-folder-open-o',
        ),
        '3' => array(
            'pid'   => '2',
            'title' => '系统设置',
            'icon'  => 'fa fa-wrench',
            'url'   => 'Admin/Config/group',
        ),
        '4' => array(
            'pid'   => '3',
            'title' => '修改设置',
            'url'   => 'Admin/Config/groupSave',
        ),
       '5' => array(
           'pid'   => '2',
           'title' => '导航管理',
           'icon'  => 'fa fa-map-signs',
           'url'   => 'Admin/Nav/index',
       ),
        '6' => array(
            'pid'   => '5',
            'title' => '新增',
            'url'   => 'Admin/Nav/add',
        ),
        '7' => array(
            'pid'   => '5',
            'title' => '编辑',
            'url'   => 'Admin/Nav/edit',
        ),
        '8' => array(
            'pid'   => '5',
            'title' => '设置状态',
            'url'   => 'Admin/Nav/setStatus',
        ),
        // '9' => array(
        //     'pid'   => '2',
        //     'title' => '竞猜图片',
        //     'icon'  => 'fa fa-image',
        //     'url'   => 'Admin/Slider/index',
        // ),
        '10' => array(
            'pid'   => '9',
            'title' => '新增',
            'url'   => 'Admin/Slider/add',
        ),
        '11' => array(
            'pid'   => '9',
            'title' => '编辑',
            'url'   => 'Admin/Slider/edit',
        ),
        '12' => array(
            'pid'   => '9',
            'title' => '设置状态',
            'url'   => 'Admin/Slider/setStatus',
        ),
        '13' => array(
            'pid'   => '2',
            'title' => '配置管理',
            'icon'  => 'fa fa-cogs',
            'url'   => 'Admin/Config/index',
        ),
        '14' => array(
            'pid'   => '13',
            'title' => '新增',
            'url'   => 'Admin/Config/add',
        ),
        '15' => array(
            'pid'   => '13',
            'title' => '编辑',
            'url'   => 'Admin/Config/edit',
        ),
        '16' => array(
            'pid'   => '13',
            'title' => '设置状态',
            'url'   => 'Admin/Config/setStatus',
        ),
       '17' => array(
           'pid'   => '2',
           'title' => '上传管理',
           'icon'  => 'fa fa-upload',
           'url'   => 'Admin/Upload/index',
       ),
        '18' => array(
            'pid'   => '17',
            'title' => '上传文件',
            'url'   => 'Admin/Upload/upload',
        ),
        '19' => array(
            'pid'   => '17',
            'title' => '删除文件',
            'url'   => 'Admin/Upload/delete',
        ),
        '20' => array(
            'pid'   => '17',
            'title' => '设置状态',
            'url'   => 'Admin/Upload/setStatus',
        ),
        '21' => array(
            'pid'   => '17',
            'title' => '下载远程图片',
            'url'   => 'Admin/Upload/downremoteimg',
        ),
        '22' => array(
            'pid'   => '17',
            'title' => '文件浏览',
            'url'   => 'Admin/Upload/fileManager',
        ),
        '23' => array(
            'pid'   => '1',
            'title' => '系统权限',
            'icon'  => 'fa fa-folder-open-o',
        ),
        '24' => array(
            'pid'   => '23',
            'title' => '用户设置',
            'icon'  => 'fa fa-user',
            'url'   => 'Admin/User/index',
        ),
        '25' => array(
            'pid'   => '24',
            'title' => '新增',
            'url'   => 'Admin/User/add',
        ),
        '26' => array(
            'pid'   => '24',
            'title' => '编辑',
            'url'   => 'Admin/User/edit',
        ),
        '27' => array(
            'pid'   => '24',
            'title' => '设置状态',
            'url'   => 'Admin/User/setStatus',
        ),
        '28' => array(
            'pid'   => '23',
            'title' => '管理设置',
            'icon'  => 'fa fa-lock',
            'url'   => 'Admin/Access/index',
        ),
        '29' => array(
            'pid'   => '28',
            'title' => '新增',
            'url'   => 'Admin/Access/add',
        ),
        '30' => array(
            'pid'   => '28',
            'title' => '编辑',
            'url'   => 'Admin/Access/edit',
        ),
        '31' => array(
            'pid'   => '28',
            'title' => '设置状态',
            'url'   => 'Admin/Access/setStatus',
        ),
        '32' => array(
            'pid'   => '23',
            'title' => '分组权限',
            'icon'  => 'fa fa-sitemap',
            'url'   => 'Admin/Group/index',
        ),
        '33' => array(
            'pid'   => '32',
            'title' => '新增',
            'url'   => 'Admin/Group/add',
        ),
        '34' => array(
            'pid'   => '32',
            'title' => '编辑',
            'url'   => 'Admin/Group/edit',
        ),
        '35' => array(
            'pid'   => '32',
            'title' => '设置状态',
            'url'   => 'Admin/Group/setStatus',
        ),
        '36' => array(
            'pid'   => '1',
            'title' => '扩展中心',
            'icon'  => 'fa fa-folder-open-o',
        ),
       // '37' => array(
       //     'pid'   => '36',
       //     'title' => '前台主题',
       //     'icon'  => 'fa fa-adjust',
       //     'url'   => 'Admin/Theme/index',
       // ),
        '38' => array(
            'pid'   => '37',
            'title' => '安装',
            'url'   => 'Admin/Theme/install',
        ),
        '39' => array(
            'pid'   => '37',
            'title' => '卸载',
            'url'   => 'Admin/Theme/uninstall',
        ),
        '40' => array(
            'pid'   => '37',
            'title' => '更新信息',
            'url'   => 'Admin/Theme/updateInfo',
        ),
        '41' => array(
            'pid'   => '37',
            'title' => '设置状态',
            'url'   => 'Admin/Theme/setStatus',
        ),
        '42' => array(
            'pid'   => '37',
            'title' => '切换主题',
            'url'   => 'Admin/Theme/setCurrent',
        ),
        '43' => array(
            'pid'   => '37',
            'title' => '取消主题',
            'url'   => 'Admin/Theme/cancel',
        ),
       '44' => array(
           'pid'   => '36',
           'title' => '功能模块',
           'icon'  => 'fa fa-th-large',
           'url'   => 'Admin/Module/index',
       ),
        '45' => array(
            'pid'   => '44',
            'title' => '安装',
            'url'   => 'Admin/Module/install',
        ),
        '46' => array(
            'pid'   => '44',
            'title' => '卸载',
            'url'   => 'Admin/Module/uninstall',
        ),
        '47' => array(
            'pid'   => '44',
            'title' => '更新信息',
            'url'   => 'Admin/Module/updateInfo',
        ),
        '48' => array(
            'pid'   => '44',
            'title' => '设置状态',
            'url'   => 'Admin/Module/setStatus',
        ),
       // '49' => array(
       //     'pid'   => '36',
       //     'title' => '插件管理',
       //     'icon'  => 'fa fa-th',
       //     'url'   => 'Admin/Addon/index',
       // ),
        '50' => array(
            'pid'   => '49',
            'title' => '安装',
            'url'   => 'Admin/Addon/install',
        ),
        '51' => array(
            'pid'   => '49',
            'title' => '卸载',
            'url'   => 'Admin/Addon/uninstall',
        ),
        '52' => array(
            'pid'   => '49',
            'title' => '运行',
            'url'   => 'Admin/Addon/execute',
        ),
        '53' => array(
            'pid'   => '49',
            'title' => '设置',
            'url'   => 'Admin/Addon/config',
        ),
        '54' => array(
            'pid'   => '49',
            'title' => '后台管理',
            'url'   => 'Admin/Addon/adminList',
        ),
        '55' => array(
            'pid'   => '54',
            'title' => '新增数据',
            'url'   => 'Admin/Addon/adminAdd',
        ),
        '56' => array(
            'pid'   => '54',
            'title' => '编辑数据',
            'url'   => 'Admin/Addon/adminEdit',
        ),
        '57' => array(
            'pid'   => '54',
            'title' => '设置状态',
            'url'   => 'Admin/Addon/setStatus',
        ),
        '58' => array(
            'pid'   => '2',
            'title' => '竞猜图片',
            'icon'  => 'fa fa-image',
            'url'   => 'Admin/Slider/index',
        ),
        '59' => array(
            'pid'   => '2',
            'title' => '竞猜管理',
            'icon'  => 'fa fa-image',
            'url'   => 'Admin/Term/index',
        ),
    )
);
