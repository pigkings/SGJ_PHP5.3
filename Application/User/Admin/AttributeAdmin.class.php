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
 * 用户字段控制器
 *
 */
class AttributeAdmin extends AdminController {
    // 改变表单类型的时候同时改变字段定义
    private $extra_html = <<<EOF
        <script type="text/javascript">
            //改变表单类型的时候同时改变字段定义
            $(function(){
                $('.item_type select').change(function(){
                    var curren_name = $(this).find('option:selected').attr('value');
                    var data_field  = $(this).find('option:selected').attr('data-field');
                    $('.item_field input').val(data_field);
                });
            });
        </script>
EOF;

    /**
     * 默认方法
     *
     */
    public function index($user_type) {
        // 搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['id|name|title'] = array($condition, $condition, $condition,'_multi'=>true);

        if ($user_type) {
            $map['user_type'] = $user_type;
        }
        $map['status'] = array('egt', 0);
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $attribute_list = D('Attribute')
                                 ->page($p, C('ADMIN_PAGE_ROWS'))
                                 ->order('id desc')
                                 ->where($map)
                                 ->select();
        $page = new Page(
            D('Attribute')->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        $attr['name']  = 'addnew';
        $attr['title'] = '新 增';
        $attr['class'] = 'btn btn-primary';
        $attr['href'] = U('add', array('user_type' => $user_type));

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('字段管理')      // 设置页面标题
                ->addTopButton('self', array(  // 添加返回按钮
                    'title' => '<i class="fa fa-reply"></i> 返回类型列表',
                    'class' => 'btn btn-warning',
                    'onclick' => 'javascript:history.back(-1);return false;')
                )
                ->addTopButton('self', $attr)  // 添加新增按钮
                ->addTopButton('resume')       // 添加启用按钮
                ->addTopButton('forbid')       // 添加禁用按钮
                ->setSearch('请输入ID/名称/标题', U('index'))
                ->addTableColumn('id', 'ID')
                ->addTableColumn('name', '名称')
                ->addTableColumn('title', '标题')
                ->addTableColumn('type', '类型', 'type')
                ->addTableColumn('ctime', '发布时间', 'time')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($attribute_list)  // 数据列表
                ->setTableDataPage($page->show())    // 数据列表分页
                ->addRightButton('edit')             // 添加编辑按钮
                ->addRightButton('forbid')           // 添加禁用/启用按钮
                ->addRightButton('delete')           // 添加删除按钮
                ->display();
    }

    /**
     * 新增字段
     *
     */
    public function add($user_type) {
        if (IS_POST) {
            $attribute_object = D('Attribute');
            $data = $attribute_object->create();
            if ($data) {
                $id = $attribute_object->add();
                if ($id) {
                    $result = $attribute_object->addField($data);  //新增表字段
                    if ($result) {
                        $this->success('新增字段成功', U('index', array('user_type' => $user_type)));
                    } else {
                        $attribute_object->delete($id);  // 删除新增数据
                        $this->error('新建字段出错！');
                    }
                } else {
                    $this->error('新增字段出错！');
                }
            } else {
                $this->error($attribute_object->getError());
            }
        } else {
            // 表单默认值
            $info['user_type'] = $user_type;
            $info['show'] = 1;

            // 获取Builder表单类型转换成一维数组
            $form_item_type = C('FORM_ITEM_TYPE');
            foreach($form_item_type as $key => $val){
                $new_form_item_type[$key]['title']      = $val[0];
                $new_form_item_type[$key]['data-field'] = $val[1];
            }

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增字段')  // 设置页面标题
                    ->setPostUrl(U('add'))     // 设置表单提交地址
                    ->addFormItem('user_type', 'select', '类型', '类型', select_list_as_tree('Type'))
                    ->addFormItem('name', 'text', '字段名称', '字段名称，如“title”')
                    ->addFormItem('title', 'text', '字段标题', '字段标题，如“标题”')
                    ->addFormItem('type', 'select', '字段类型', '字段类型', $new_form_item_type)
                    ->addFormItem('field', 'text', '字段定义', '字段定义，如：int(11) unsigned NOT NULL ')
                    ->addFormItem('value', 'text', '字段默认值', '字段默认值')
                    ->addFormItem('show', 'radio', '是否显示', '是否显示', array('1' => '显示', '0' => '不显示'))
                    ->addFormItem('options', 'textarea', '额外选项', '额外选项radio/select等需要配置此项')
                    ->addFormItem('tip', 'textarea', '字段补充说明', '字段补充说明')
                    ->setFormData($info)
                    ->setExtraHtml($this->extra_html)
                    ->display();
        }
    }

    /**
     * 编辑分类
     *
     */
    public function edit($id) {
        if (IS_POST) {
            $attribute_object = D('Attribute');
            $data = $attribute_object->create();
            if ($data) {
                $result = $attribute_object->updateField($data);  // 更新字段
                if ($result) {
                    $status = $attribute_object->save();  // 更新字段信息
                    if ($status) {
                        $this->success('更新字段成功', U('index', array('user_type' => I('user_type'))));
                    } else {
                        $this->error('更新属性出错！');
                    }
                } else {
                    $this->error('更新字段出错！');
                }
            } else {
                $this->error($attribute_object->getError());
            }
        } else {
            // 获取Builder表单类型转换成一维数组
            $form_item_type = C('FORM_ITEM_TYPE');
            foreach ($form_item_type as $key => $val) {
                $new_form_item_type[$key]['title']      = $val[0];
                $new_form_item_type[$key]['data-field'] = $val[1];
            }

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑字段')  // 设置页面标题
                    ->setPostUrl(U('edit'))    // 设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->addFormItem('user_type', 'select', '文档类型', '文档类型', select_list_as_tree('Type'))
                    ->addFormItem('name', 'text', '字段名称', '字段名称，如“title”')
                    ->addFormItem('title', 'text', '字段标题', '字段标题，如“标题”')
                    ->addFormItem('type', 'select', '字段类型', '字段类型', $new_form_item_type)
                    ->addFormItem('field', 'text', '字段定义', '字段定义，如：int(11) NOT NULL ')
                    ->addFormItem('value', 'text', '字段默认值', '字段默认值')
                    ->addFormItem('show', 'radio', '是否显示', '是否显示', array('1' => '显示', '0' => '不显示'))
                    ->addFormItem('options', 'textarea', '额外选项', '额外选项radio/select等需要配置此项')
                    ->addFormItem('tip', 'textarea', '字段补充说明', '字段补充说明')
                    ->setFormData(D('Attribute')->find($id))
                    ->setExtraHtml($this->extra_html)
                    ->display();
        }
    }

    /**
     * 设置一条或者多条数据的状态
     *
     */
    public function setStatus($model = CONTROLLER_NAME) {
        $ids    = I('request.ids');
        $status = I('request.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        switch ($status) {
            case 'delete' : //删除条目
                $attribute_object = D('Attribute');
                $field = $attribute_object->find($ids);
                $result1 = $attribute_object->delete($ids);
                $result2 = $attribute_object->deleteField($field);
                if ($result1 && $result2) {
                    $this->success('删除成功，不可恢复！');
                } else {
                    $this->error('删除失败'.$attribute_object->getError());
                }
                break;
            default :
                parent::setStatus($model);
                break;
        }
    }
}
