<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;
/**
 * 用户类型控制器
 *
 */
class TypeAdmin extends AdminController {
    /**
     * 用户类型列表
     *
     */
    public function index() {
        // 获取所有用户类型
        $map['status'] = array('egt', '0'); // 禁用和正常状态
        $type_object = D('Type');
        $data_list = $type_object->where($map)->order('id asc')->select();

        // 字段管理按钮
        $attr['name']  = 'attribute';
        $attr['title'] = '字段管理';
        $attr['class'] = 'label label-success';
        $attr['href']  = U('User/Attribute/index', array('user_type' => __data_id__));

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('类型列表') // 设置页面标题
                ->addTopButton('addnew')  // 添加新增按钮
                ->addTopButton('resume', array('model' => 'user_type'))  // 添加启用按钮
                ->addTopButton('forbid', array('model' => 'user_type'))  // 添加禁用按钮
                ->addTopButton('delete', array('model' => 'user_type'))  // 添加删除按钮
                ->setSearch('请输入ID/用户名', U('index'))
                ->addTableColumn('id', 'ID')
                ->addTableColumn('name', '名称')
                ->addTableColumn('title', '标题')
                ->addTableColumn('create_time', '注册时间', 'time')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)    // 数据列表
                ->addRightButton('self', $attr)   // 字段管理按钮
                ->addRightButton('edit')    // 添加编辑按钮
                ->addRightButton('forbid')  // 添加禁用/启用按钮
                ->addRightButton('delete')  // 添加删除按钮
                ->display();
    }

    /**
     * 新增用户类型
     *
     */
    public function add() {
        if (IS_POST) {
            $type_object = D('Type');
            $data = $type_object->create();
            if ($data) {
                $id = $type_object->add();
                if ($id) {
                    //新建表
                    $table_name = strtolower(C('DB_PREFIX').'user_' . I('name'));
                    $sql = <<<sql
                        CREATE TABLE IF NOT EXISTS `{$table_name}` (
                        `uid` int(11) UNSIGNED NOT NULL COMMENT 'UID' ,
                        PRIMARY KEY (`uid`)
                        )
                        ENGINE=MyISAM
                        DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
                        CHECKSUM=0
                        ROW_FORMAT=DYNAMIC
                        DELAY_KEY_WRITE=0
                        ;
sql;
                    $res = M()->execute($sql);
                    $this->success('新增成功', U('index'));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($type_object->getError());
            }
        } else {
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增用户类型') //设置页面标题
                    ->setPostUrl(U('add'))    //设置表单提交地址
                    ->addFormItem('name', 'text', '名称', '用户类型名称')
                    ->addFormItem('title', 'text', '标题', '用户类型标题')
                    ->display();
        }
    }

    /**
     * 编辑用户类型
     *
     */
    public function edit($id) {
        if (IS_POST) {
            // 提交数据
            $type_object = D('Type');
            $_POST['list_field'] = implode(',', $_POST['list_field']);
            $data = $type_object->create();
            if ($data) {
                $result = $type_object->save($data);
                if ($result) {
                    $this->success('更新成功', U('index'));
                } else {
                    $this->error('更新失败', $type_object->getError());
                }
            } else {
                $this->error($type_object->getError());
            }
        } else {
            // 获取用户类型信息
            $info = D('Type')->find($id);

            //获取用于列表显示字段表单复选框的内容
            $map['user_type'] = array('eq', $id);
            $attribute_list_checkbox = select_list_as_tree('Attribute', $map);

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑用户类型')  // 设置页面标题
                    ->setPostUrl(U('edit'))    // 设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->addFormItem('name', 'text', '名称', '用户类型名称')
                    ->addFormItem('title', 'text', '标题', '用户类型标题')
                    ->addFormItem('list_field', 'checkbox', '前台查询搜索字段', '前台查询搜索字段', $attribute_list_checkbox)
                    ->addFormItem('home_template', 'text', '主页模版', '主页模版')
                    ->addFormItem('center_template', 'text', '个人中心模版', '个人中心模版')
                    ->setFormData($info)
                    ->display();
        }
    }
}
