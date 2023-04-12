<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;
/**
 * 幻灯片控制器

 */
class SliderController extends AdminController {
    /**
     * 默认方法

     */
    public function index() {
        // 搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['id|title'] = array($condition, $condition,'_multi'=>true);

        // 获取所有分类
        $p = $_GET["p"] ? : 1;
        $map['status'] = array('egt', '0');  // 禁用和正常状态
        $slider_object = D('Slider');
        $data_list = $slider_object
                   ->page($p, C('ADMIN_PAGE_ROWS'))
                   ->where($map)
                   ->order('sort desc,create_time asc,id desc')
                   ->select();
        $page = new Page(
            $slider_object->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('幻灯列表')  // 设置页面标题
                ->addTopButton('addnew')    // 添加新增按钮
                ->setSearch('请输入ID/模型标题', U('index'))
                ->addTableColumn('id', 'ID')
                ->addTableColumn('cover', '图片', 'picture')
                ->addTableColumn('award', '赔率', 'award')
                ->addTableColumn('hitnum', '中奖数字', 'hitnum')
                ->addTableColumn('title', '标题')
                ->addTableColumn('sort', '排序')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('create_time', '创建时间', 'time')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)     // 数据列表
                ->setTableDataPage($page->show())  // 数据列表分页
                ->addRightButton('edit')           // 添加编辑按钮

                ->display();
    }

    /**
     * 新增文档

     */
    public function add() {
        if (IS_POST) {
            $slider_object = D('Slider');
            $data = $slider_object->create();
            if ($data) {
                $id = $slider_object->add();
                if ($id) {
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($slider_object->getError());
            }
        } else {
            $slider_object = D('Slider');
            $count = $slider_object->count();
//            if ($count >= 6) {
//                $this->error("最多允许设置6个竞猜图片");
//                return false;
//            }
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增幻灯')  // 设置页面标题
                    ->setPostUrl(U('add'))      // 设置表单提交地址
                    ->addFormItem('title', 'text', '标题', '标题')
                    ->addFormItem('cover', 'picture', '图片', '切换图片')

                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->addFormItem('award', 'num', '赔率', '中奖后所得奖励的倍数')
                    ->addFormItem('hitnum', 'num', '中奖数字', '与开奖数字向对应')
                    ->display();
        }
    }

    /**
     * 编辑文章

     */
    public function edit($id) {
        if (IS_POST) {
            $slider_object = D('Slider');
            $data = $slider_object->create();
            if ($data) {
                $id = $slider_object->save();
                if ($id !== false) {
                    $this->success('更新成功', U('index'));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($slider_object->getError());
            }
        } else {
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑幻灯')  // 设置页面标题
                    ->setPostUrl(U('edit'))     // 设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->addFormItem('title', 'text', '标题', '标题')
                    ->addFormItem('cover', 'picture', '图片', '切换图片')

                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->addFormItem('award', 'num', '赔率', '中奖后所得奖励的倍数')
                    ->addFormItem('hitnum', 'static', '中奖数字', '与开奖数字向对应')
                    ->setFormData(D('Slider')->find($id))
                    ->display();
        }
    }
}
