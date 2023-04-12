<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Controller;
use \Common\Util\Tree;
/**
 * 导航控制器

 */
class NavController extends AdminController {
    /**
     * 导航列表

     */
    public function index($group = 'main') {
        //搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['id|title'] = array(
            $condition,
            $condition,
            '_multi'=>true
        );

        // 获取所有导航
        $map['status'] = array('egt', '0');
        $map['group']  = $group;
        $data_list = D('Nav')
                   ->where($map)
                   ->order('sort asc, id asc')
                   ->select();

        // 转换成树状列表
        $tree = new Tree();
        $data_list = $tree->toFormatTree($data_list);

        // 设置Tab导航数据列表
        $nav_group_list = C('NAV_GROUP_LIST');  // 获取分类分组
        foreach ($nav_group_list as $key => $val) {
            $tab_list[$key]['title'] = $val;
            $tab_list[$key]['href']  = U('index', array('group' => $key));
        }

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('导航列表') // 设置页面标题
                ->addTopButton('addnew', array('href' => U('add', array('group' => $group))))  // 添加新增按钮
                ->addTopButton('resume')  // 添加启用按钮
                ->addTopButton('forbid')  // 添加禁用按钮
                ->addTopButton('delete')  // 添加删除按钮
                ->setSearch('请输入ID/导航名称', U('index', array('group' => $group)))
                ->setTabNav($tab_list, $group)  // 设置页面Tab导航
                ->addTableColumn('id', 'ID')
                ->addTableColumn('icon', '图标', 'icon')
                ->addTableColumn('title_show', '标题')
                ->addTableColumn('sort', '排序')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)  // 数据列表
                ->addRightButton('edit', array('href' => U('edit', array('group' => $group, 'id' => '__data_id__'))))  // 添加编辑按钮
                ->addRightButton('forbid')      // 添加禁用/启用按钮
                ->addRightButton('delete')      // 添加删除按钮
                ->display();
    }

    // 根据导航类型设置表单项目
    private $extra_html = <<<EOF
    <script type="text/javascript">
        $(function(){
            $('input[name="type"]').change(function() {
                var type = $(this).val();
                // 链接类型
                if (type == 'link') {
                    $('.item_url').removeClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').addClass('hidden');
                // 模块类型
                } else if (type == 'module') {
                    $('.item_url').addClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').removeClass('hidden');
                // 单页类型
                } else if (type == 'page') {
                    $('.item_url').addClass('hidden');
                    $('.item_content').removeClass('hidden');
                    $('.item_module_name').addClass('hidden');
                } else {
                    $('.item_url').addClass('hidden');
                    $('.item_content').addClass('hidden');
                    $('.item_module_name').addClass('hidden');
                }
            });
        });
    </script>
EOF;

    /**
     * 新增导航

     */
    public function add($group) {
        if (IS_POST) {
            $nav_object = D('Nav');
            $data = $nav_object->create();
            if ($data) {
                $id = $nav_object->add($data);
                if ($id) {
                    $this->success('新增成功', U('index', array('group' => $group)));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($nav_object->getError());
            }
        } else {
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增导航')  // 设置页面标题
                    ->setPostUrl(U('', array('group' => $group)))     // 设置表单提交地址
                    ->addFormItem('group', 'hidden', '导航分组', '导航分组')
                    ->addFormItem('pid', 'select', '上级导航', '上级导航', select_list_as_tree('Nav', array('group' => $group), '顶级导航'))
                    ->addFormItem('title', 'text', '导航标题', '导航前台显示标题')
                    ->addFormItem('type', 'radio', '导航类型', '导航类型', D('Nav')->nav_type())
                    ->addFormItem('url', 'text', '外链URL地址', '支持http://格式或者TP的U函数解析格式')
                    ->addFormItem('module_name', 'select', '模块', '选择的模块需要具有前台页面', select_list_as_tree('Module', null, null, 'name'), 'hidden')
                    ->addFormItem('content', 'kindeditor', '单页内容', '单页内容', null, 'hidden')
                    ->addFormItem('target', 'radio', '打开方式', '打开方式', array('' => '当前窗口','_blank' => '新窗口打开'))
                    ->addFormItem('icon', 'icon', '图标', '导航图标')
                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->setFormData(array('type' => 'link', 'group' => $group))
                    ->setExtraHtml($this->extra_html)
                    ->display();
        }
    }

    /**
     * 编辑导航

     */
    public function edit($id, $group) {
        if (IS_POST) {
            $nav_object = D('Nav');
            $data = $nav_object->create();
            if ($data) {
                if ($nav_object->save($data)) {
                    $this->success('更新成功', U('index', array('group' => $group)));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($nav_object->getError());
            }
        } else {
            $info = D('Nav')->find($id);

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑导航')  // 设置页面标题
                    ->setPostUrl(U(''))    // 设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->addFormItem('group', 'hidden', '导航分组', '导航分组')
                    ->addFormItem('pid', 'select', '上级导航', '上级导航', select_list_as_tree('Nav', array('group' => $group), '顶级导航'))
                    ->addFormItem('title', 'text', '导航标题', '导航前台显示标题')
                    ->addFormItem('type', 'radio', '导航类型', '导航类型', D('Nav')->nav_type())
                    ->addFormItem('url', 'text', '外链URL地址', '支持http://格式或者TP的U函数解析格式', null, $info['type'] === 'link' ? '' : 'hidden')
                    ->addFormItem('module_name', 'select', '模块', '选择的模块需要具有前台页面', select_list_as_tree('Module', null, null, 'name'), $info['type'] === 'module' ? '' : 'hidden')
                    ->addFormItem('content', 'kindeditor', '单页内容', '单页内容', null, $info['type'] === 'page' ? '' : 'hidden')
                    ->addFormItem('target', 'radio', '打开方式', '打开方式', array('' => '当前窗口','_blank' => '新窗口打开'))
                    ->addFormItem('icon', 'icon', '图标', '导航图标')
                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->setFormData($info)
                    ->setExtraHtml($this->extra_html)
                    ->display();
        }
    }
}
