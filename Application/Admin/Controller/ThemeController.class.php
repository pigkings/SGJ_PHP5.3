<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
use Common\Util\Think\Page;
/**
 * 主题控制器

 */
class ThemeController extends AdminController {
    /**
     * 默认方法

     */
    public function index() {
        $theme_object = D('Theme');
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $data_list = $theme_object
                   ->getAll();

        $attr['name']  = 'cencel';
        $attr['title'] = '取消多主题支持';
        $attr['class'] = 'btn btn-primary ajax-get';
        $attr['href']  = U('Admin/Theme/cancel');

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('主题列表')  // 设置页面标题
                ->addTopButton('self', $attr)
                ->addTableColumn('name', '名称')
                ->addTableColumn('title', '标题')
                ->addTableColumn('description', '描述')
                ->addTableColumn('developer', '开发者')
                ->addTableColumn('version', '版本')
                ->addTableColumn('create_time', '创建时间', 'time')
                ->addTableColumn('status', '状态')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)     // 数据列表
                ->display();
    }

    /**
     * 安装主题

     */
    public function install($name) {
        // 获取当前主题信息
        $config_file = realpath('./Theme/'.$name).'/'
                     .D('Theme')->install_file();
        if (!$config_file) {
            $this->error('安装失败');
        }
        $config = include $config_file;
        $data = $config['info'];
        if ($config['config']) {
            $data['config'] = json_encode($config['config']);
        }

        // 写入数据库记录
        $theme_object = D('Theme');
        $data = $theme_object->create($data);
        if ($data) {
            $id = $theme_object->add($data);
            if ($id) {
                $this->success('安装成功', U('index'));
            } else {
                $this->error('安装失败');
            }
        } else {
            $this->error($theme_object->getError());
        }
    }

    /**
     * 卸载主题

     */
    public function uninstall($id) {
        // 当前主题禁止卸载
        $theme_object = D('Theme');
        $result = $theme_object->delete($id);
        if ($result) {
            $this->success('卸载成功！');
        } else {
            $this->error('卸载失败', $theme_object->getError());
        }
    }

    /**
     * 更新主题信息

     */
    public function updateInfo($id) {
        $theme_object = D('Theme');
        $name = $theme_object->getFieldById($id, 'name');
        $config_file = realpath('./Theme/'.$name).'/'
                     .D('Theme')->install_file();
        if (!$config_file) {
            $this->error('不存在安装文件');
        }
        $config = include $config_file;
        $data = $config['info'];
        if ($config['config']) {
            $data['config'] = json_encode($config['config']);
        }
        $data['id'] = $id;
        $data = $theme_object->create($data);
        if ($data) {
            $id = $theme_object->save($data);
            if ($id) {
                $this->success('更新成功', U('index'));
            } else {
                $this->error('更新失败');
            }
        } else {
            $this->error($theme_object->getError());
        }
    }

    /**
     * 切换主题

     */
    public function setCurrent($id) {
        $theme_object = D('Theme');
        $theme_info = $theme_object->find($id);
        if ($theme_info) {
            // 当前主题current字段置为1
            $map['id'] = array('eq', $id);
            $result1 = $theme_object->where($map)->setField('current', 1);
            if ($result1) {
                // 其它主题current字段置为0
                $map = array();
                $map['id'] = array('neq', $id);
                if ($theme_object->where($map)->count() == 0) {
                    $this->success('前台主题设置成功！');
                }
                $con['id'] = array('neq', $id);
                $result2 = $theme_object->where($con)->setField('current', 0);
                if ($result2) {
                    $this->success('前台主题设置成功！');
                } else {
                    $this->error('设置当前主题失败', $theme_object->getError());
                }
            } else {
                $this->error('设置当前主题失败', $theme_object->getError());
            }
        } else {
            $this->error('主题不存在');
        }
    }

    /**
     * 取消主题

     */
    public function cancel() {
        $theme_object = D('Theme');
        $theme_object->where(true)->setField('current', 0);
        $map = array();
        $map['current'] = array('eq', 1);
        if ($theme_object->where($map)->count() == 0) {
            $this->success('取消主题成功！');
        } else {
            $this->error('取消主题失败', $theme_object->getError());
        }
    }
}
