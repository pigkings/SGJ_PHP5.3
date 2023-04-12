<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Cms\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;
/**
 * 举报控制器
 *
 */
class ReportAdmin extends AdminController {
    /**
     * 举报列表
     *
     */
    public function index() {
        // 获取所有举报
        $map['status'] = array('egt', '0');  // 禁用和正常状态
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $data_list = D('Report')
                   ->page($p, C('ADMIN_PAGE_ROWS'))
                   ->where($map)
                   ->order('id desc')
                   ->select();
        $page = new Page(
            D('Report')->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        $attr['name']  = 'resume';
        $attr['title'] = '设为已处理';
        $attr['class'] = 'label label-danger ajax-get';
        $attr['href'] = U('Cms/Report/setStatus', array('ids' => '__data_id__', 'status' => 'resume'));

        $right_button['forbid']['title'] = '已处理';
        $right_button['forbid']['attribute'] = 'class="label label-success" href="#"';

        //使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('举报列表')  // 设置页面标题
                ->addTableColumn('id', 'ID')
                ->addTableColumn('data_id', '举报项ID')
                ->addTableColumn('reason', '举报理由', 'callback', array(D('Cms/Report'), 'reason_list'))
                ->addTableColumn('mobile', '电话')
                ->addTableColumn('create_time', '创建时间', 'time')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)     // 数据列表
                ->setTableDataPage($page->show())  // 数据列表分页
                ->addRightButton('edit', array('title' => '查看'))
                ->addRightButton('self', $attr)
                ->alterTableData(  // 修改列表数据
                    array('key' => 'status', 'value' => '<i class="fa fa-check text-success"></i>'),
                    array('right_button' => $right_button)
                )
                ->display();
    }

    /**
     * 编辑
     *
     */
    public function edit($id) {
        if (IS_POST) {
            $default_object = D('Report');
            $data = $default_object->create();
            if ($data) {
                if ($default_object->save()!== false){
                    $this->success('更新成功', U('index'));
                } else {
                    $this->error('更新失败');
                }
            } else{
                $this->error($default_object->getError());
            }
        } else {
            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑')  // 设置页面标题
                    ->setPostUrl(U('edit'))    // 设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->addFormItem('data_id', 'text', '举报项ID', '举报项ID')
                    ->addFormItem('reason', 'select', '举报理由', '举报理由', D('Report')->reason_list())
                    ->addFormItem('abstract', 'textarea', '详情', '详情')
                    ->addFormItem('mobile', 'text', '电话', '电话')
                    ->setFormData(D('Report')->find($id))
                    ->display();
        }
    }

    /**
     * 已处理
     *
     */
    public function setStatus() {
        parent::setStatus('Cms/Report');
    }
}