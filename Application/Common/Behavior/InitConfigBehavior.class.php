<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Common\Behavior;
use Think\Behavior;
defined('THINK_PATH') or exit();
/**
 * 根据不同情况读取数据库的配置信息并与本地配置合并
 * 本行为扩展很重要会影响核心系统前后台、模块功能及模版主题使用
 * 如非必要或者并不是十分了解系统架构不推荐更改
 *
 */
class InitConfigBehavior extends Behavior {
    /**
     * 行为扩展的执行入口必须是run
     *
     */
    public function run(&$content) {
        // 安装模式下直接返回
        if(defined('BIND_MODULE') && BIND_MODULE === 'Install') return;

        // 读取数据库中的配置
        $system_config = S('DB_CONFIG_DATA');
        if (!$system_config || APP_DEBUG === true) {
            // 获取所有系统配置
            $system_config = D('Admin/Config')->lists();

            // SESSION与COOKIE与前缀设置避免冲突
            $system_config['SESSION_PREFIX'] = ENV_PRE.MODULE_MARK.'_';  // Session前缀
            $system_config['COOKIE_PREFIX']  = ENV_PRE.MODULE_MARK.'_';  // Cookie前缀

            // Session数据表
            $system_config['SESSION_TABLE'] = C('DB_PREFIX').'admin_session';

            // 获取所有安装的模块配置
            $module_list = D('Admin/Module')->where(array('status' => '1'))->select();
            foreach ($module_list as $val) {
                $module_config[strtolower($val['name'].'_config')] = json_decode($val['config'], true);
                $module_config[strtolower($val['name'].'_config')]['module_name'] = $val['name'];
            }
            if ($module_config) {
                // 合并模块配置
                $system_config = array_merge($system_config, $module_config);

                // 加载模块标签库及行为扩展
                $system_config['TAGLIB_PRE_LOAD'] = explode(',', C('TAGLIB_PRE_LOAD'));  // 先取出配置文件中定义的否则会被覆盖
                foreach ($module_config as $key => $val) {
                    // 加载模块标签库
                    if ($val['taglib']) {
                        foreach ($val['taglib'] as $tag) {
                            $tag_path = APP_PATH.$val['module_name'].'/'.'TagLib'.'/'.$tag.'.class.php';
                            if (is_file($tag_path)) {
                                $system_config['TAGLIB_PRE_LOAD'][] = $val['module_name'].'\\TagLib\\'.$tag;
                            }
                        }
                    }

                    // 加载模块行为扩展
                    if ($val['behavior']) {
                        foreach ($val['behavior'] as $bhv) {
                            $bhv_path = APP_PATH.$val['module_name'].'/'.'Behavior'.'/'.$bhv.'Behavior.class.php';
                            if (is_file($bhv_path)) {
                                \Think\Hook::add('corethink_behavior', $val['module_name'].'\\Behavior\\'.$bhv.'Behavior');
                            }
                        }
                    }
                }
                $system_config['TAGLIB_PRE_LOAD'] = implode(',', $system_config['TAGLIB_PRE_LOAD']);
            }

            // 加载Formbuilder扩展类型
            $system_config['FORM_ITEM_TYPE'] = C('FORM_ITEM_TYPE');
            $formbuilder_extend = explode(',', D('Admin/Hook')->getFieldByName('FormBuilderExtend', 'addons'));
            if ($formbuilder_extend) {
                $addon_object = D('Admin/Addon');
                foreach ($formbuilder_extend as $val) {
                    $temp = json_decode($addon_object->getFieldByName($val, 'config'), true);
                    if ($temp['status']) {
                        $form_type[$temp['form_item_type_name']] = array($temp['form_item_type_title'], $temp['form_item_type_field']);
                        $system_config['FORM_ITEM_TYPE'] = array_merge($system_config['FORM_ITEM_TYPE'], $form_type);
                    }
                }
            }

            S('DB_CONFIG_DATA', $system_config, 3600);  // 缓存配置
        }

        // 移动端强制后台传统视图
        if (is_wap()){
            $system_config['IS_WAP'] = true;
            $system_config['ADMIN_TABS'] = 0;
        }

        // 如果是后台并且不是Admin模块则设置默认控制器层为Admin
        if (MODULE_MARK === 'Admin' && MODULE_NAME !== 'Admin') {
            $system_config['DEFAULT_C_LAYER'] = 'Admin';
            $system_config['VIEW_PATH'] = APP_PATH.MODULE_NAME.'/View/Admin/';
        }

        // 静态资源域名
        if ($system_config['STATIC_DOMAIN']) {
            $static_domain = $system_config['STATIC_DOMAIN'];
        } else {
            $static_domain = C('HOME_PAGE');
            $system_config['STATIC_DOMAIN'] = $static_domain;
        }

        // 获取当前主题的名称
        $current_theme = D('Admin/Theme')->where(array('current' => 1))->order('id asc')->getField('name');

        // 当前模块模版参数配置
        $system_config['TMPL_PARSE_STRING'] = C('TMPL_PARSE_STRING');  // 先取出配置文件中定义的否则会被覆盖
        $system_config['TMPL_PARSE_STRING']['__IMG__']  = $static_domain.'/'.APP_PATH.MODULE_NAME.'/View/Public/img';
        $system_config['TMPL_PARSE_STRING']['__CSS__']  = $static_domain.'/'.APP_PATH.MODULE_NAME.'/View/Public/css';
        $system_config['TMPL_PARSE_STRING']['__JS__']   = $static_domain.'/'.APP_PATH.MODULE_NAME.'/View/Public/js';
        $system_config['TMPL_PARSE_STRING']['__LIBS__'] = $static_domain.'/'.APP_PATH.MODULE_NAME.'/View/Public/libs';

        // 启用多主题
        if ($current_theme) {
            //默认主题设为当前主题
            $system_config['CURRENT_THEME'] = $current_theme;

            // 前台Home模块静态资源路径及模板继承基本模板
            $home_public_path = './Theme/'.$current_theme.'/Home/Public';
            if (is_dir($home_public_path)) {
                $system_config['HOME_PUBLIC_LAYOUT']  = $home_public_path.'/layout.html';
                $system_config['TMPL_PARSE_STRING']['__HOME_IMG__']   = $static_domain.'/'.$home_public_path.'/img';
                $system_config['TMPL_PARSE_STRING']['__HOME_CSS__']   = $static_domain.'/'.$home_public_path.'/css';
                $system_config['TMPL_PARSE_STRING']['__HOME_JS__']    = $static_domain.'/'.$home_public_path.'/js';
                $system_config['TMPL_PARSE_STRING']['__HOME_LIBS__']  = $static_domain.'/'.$home_public_path.'/libs';
            }

            if (MODULE_MARK === 'Home') {
                // Builder模板
                $builder_path = './Theme/'.$current_theme.'/Home/Builder';
                if (is_dir($builder_path)) {
                    $system_config['LISTBUILDER_LAYOUT'] = $builder_path.'/listbuilder.html';
                    $system_config['FORMBUILDER_LAYOUT'] = $builder_path.'/formbuilder.html';
                }

                // 如果当前主题存在User模板则改变相关配置
                if (is_dir('./Theme/'.$current_theme.'/User')) {
                    $system_config['USER_CENTER_SIDE'] = './Theme/'.$current_theme.'/User/Index/side.html';
                    $system_config['USER_LOGIN_MODAL'] = './Theme/'.$current_theme.'/User/User/login_modal.html';

                    // 如果当前主题存在User模板则改变相关配置
                    if (is_dir('./Theme/'.$current_theme.'/User/Builder')) {
                        $system_config['USER_CENTER_FORM'] = './Theme/'.$current_theme.'/User/Builder/form.html';
                        $system_config['USER_CENTER_LIST'] = './Theme/'.$current_theme.'/User/Builder/list.html';
                    }
                }
            }

            // 当前主题
            $current_theme_path = './Theme/'.$current_theme.'/'.MODULE_NAME.'/'; //当前主题文件夹路径
            if(is_dir($current_theme_path)){
                // 模板文件夹
                if (MODULE_MARK === 'Home') {
                    $system_config['VIEW_PATH'] = $current_theme_path;
                } else if (MODULE_MARK === 'Admin' && MODULE_NAME !== 'Admin') {
                    if (is_dir($current_theme_path.'Admin/')) {
                        $system_config['VIEW_PATH'] = $current_theme_path.'Admin/';
                    }
                }

                // 各模块自带静态资源路径
                $module_public_path = $current_theme_path . 'Public';
                if (is_dir($module_public_path)) {
                    $system_config['TMPL_PARSE_STRING']['__IMG__']  = $static_domain.'/'.$module_public_path.'/img';
                    $system_config['TMPL_PARSE_STRING']['__CSS__']  = $static_domain.'/'.$module_public_path.'/css';
                    $system_config['TMPL_PARSE_STRING']['__JS__']   = $static_domain.'/'.$module_public_path.'/js';
                    $system_config['TMPL_PARSE_STRING']['__LIBS__'] = $static_domain.'/'.$module_public_path.'/libs';
                }
            }
        }

        C($system_config);  // 添加配置
    }
}
