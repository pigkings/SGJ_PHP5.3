<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
use Think\Storage;
/**
 * 主题模型

 */
class ThemeModel extends Model {
    /**
     * 数据库表名

     */
    protected $tableName = 'admin_theme';

    /**
     * 安装描述文件名

     */
    public function install_file() {
        return 'opencmf.php';
    }

    /**
     * 自动验证规则

     */
    protected $_validate = array (
        array('name', 'require', '主题名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('name', '', '该主题已存在', self::MUST_VALIDATE, 'unique', self::MODEL_INSERT),
        array('title', 'require', '主题标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('description', 'require', '主题描述不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('developer', 'require', '主题开发者不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('version', 'require', '主题版本不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    );

    /**
     * 自动完成规则

     */
    protected $_auto = array (
        array('current', '0', self::MODEL_INSERT),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('sort', '0', self::MODEL_INSERT),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 获取主题列表
     * @param string $addon_dir

     */
    public function getAll() {
        //获取所有主题（文件夹下必须有$install_file定义的安装描述文件）
        $path = './Theme/';
        $dirs = array_map('basename', glob($path.'*', GLOB_ONLYDIR));
        foreach ($dirs as $dir) {
            $config_file = realpath($path.$dir).'/'.$this->install_file();
            if (Storage::has($config_file)) {
                $theme_dir_list[] = $dir;
                $temp_arr = include $config_file;
                $temp_arr['info']['status'] = -1; //未安装
                $theme_list[$temp_arr['info']['name']] = $temp_arr['info'];
            }
        }

        // 获取系统已经安装的主题信息
        if ($theme_dir_list) {
            $map['name'] = array('in', $theme_dir_list);
        } else {
            return false;
        }
        $installed_theme_list = $this->where($map)
                                     ->field(true)
                                     ->order('sort asc,id desc')
                                     ->select();
        if ($installed_theme_list) {
            foreach ($installed_theme_list as $theme) {
                $theme_list[$theme['name']] = $theme;
            }
            //系统已经安装的主题信息与文件夹下主题信息合并
            $theme_list = array_merge($theme_list, $theme_list);
        }

        foreach ($theme_list as &$val) {
            switch ($val['status']) {
                case '-1': //未安装
                    $val['status'] = '<i class="fa fa-download" style="color:green"></i>';
                    $val['right_button']['install']['title'] = '安装';
                    $val['right_button']['install']['attribute'] = 'class="label label-success ajax-get" href="'.U('install', array('name' => $val['name'])).'"';
                    break;
                default :
                    $val['status'] = '<i class="fa fa-check" style="color:green"></i>';
                    if ($val['current']) {
                        $val['right_button']['current']['title'] = '我是当前主题';
                        $val['right_button']['current']['attribute'] = 'class="label label-success" href="#"';
                    } else {
                        $val['right_button']['set_current']['title'] = '设为当前主题';
                        $val['right_button']['set_current']['attribute'] = 'class="label label-danger ajax-get" href="'.U('setCurrent', array('id' => $val['id'])).'"';
                    }
                    $val['right_button']['update_info']['title'] = '更新信息';
                    $val['right_button']['update_info']['attribute'] = 'class="label label-info ajax-get" href="'.U('updateInfo', array('id' => $val['id'])).'"';
                    $val['right_button']['uninstall']['title'] = '卸载';
                    $val['right_button']['uninstall']['attribute'] = 'class="label label-danger ajax-get" href="'.U('uninstall', array('id' => $val['id'])).'"';
                    break;
            }
        }
        return $theme_list;
    }
}
