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
 * 后台分类控制器
 *
 */
class CategoryAdmin extends AdminController {
        // 文档类型切换触发操作JS
        private $extra_html = <<<EOF
        <script type="text/javascript">
            //选择模型时页面元素改变
            $(function() {
                $('input[name="doc_type"]').change(function() {
                    var model_id = $(this).val();
                    if (model_id == 1) { //超链接
                        $('.item_url').removeClass('hidden');
                        $('.item_content').addClass('hidden');
                        $('.item_index_template').addClass('hidden');
                        $('.item_detail_template').addClass('hidden');
                    } else if (model_id == 2) { //单页文档
                        $('.item_url').addClass('hidden');
                        $('.item_content').removeClass('hidden');
                        $('.item_index_template').addClass('hidden');
                        $('.item_detail_template').removeClass('hidden');
                    } else {
                        $('.item_url').addClass('hidden');
                        $('.item_content').addClass('hidden');
                        $('.item_index_template').removeClass('hidden');
                        $('.item_detail_template').removeClass('hidden');
                    }
                });
            });
        </script>
EOF;

    /**
     * 分类列表
     *
     */
    public function index($group = 1) { 
        // 搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['id|title'] = array($condition, $condition,'_multi'=>true);

        // 获取所有分类
        $map['status'] = array('egt', '0');  // 禁用和正常状态
        if (I('get.pid')) {
            $map['pid'] = array('eq', I('get.pid'));  // 父分类ID
        }
        $map['group'] = array('eq', $group);
        $data_list = D('Category')->field('id,pid,group,doc_type,title,url,icon,create_time,sort,status')
                                  ->where($map)->order('sort asc,id asc')->select();

        // 非系统特殊类型则给标题加上链接以便于进入相应文档列表
        foreach ($data_list as &$item) {
            $document_type = D('Type')->find($item['doc_type']);  // 获取当前文档类型
            if ($document_type['system'] === '0') {
                $item['title'] = '<a href="'.U(D('Index')->moduleName.'/Index/index', array('cid' => $item['id'])).'">'.$item['title'].'</a>';
            }
        }

        // 转换成树状列表
        $tree = new \Common\Util\Tree();
        $data_list = $tree->toFormatTree($data_list);

        // 设置Tab导航数据列表
        $category_group_list = D('Category')->group_list();  // 获取分类分组
        foreach ($category_group_list as $key => $val) {
            $tab_list[$key]['title'] = $val;
            $tab_list[$key]['href']  = U('index', array('group' => $key));
        }

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('分类列表')  // 设置页面标题
                ->addTopButton('addnew', array('href' => U('add', array('group' => $group))))  // 添加新增按钮
                ->addTopButton('resume')  // 添加启用按钮
                ->addTopButton('forbid')  // 添加禁用按钮
                ->setSearch('请输入ID/分类名称', U('index', array('group' => $group)))
                ->setTabNav($tab_list, $group)  // 设置页面Tab导航
                ->addTableColumn('id', 'ID')
                ->addTableColumn('title_show', '分类')
                ->addTableColumn('url', '链接')
                ->addTableColumn('icon', '图标', 'icon')
                ->addTableColumn('sort', '排序')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)   // 数据列表
                ->addRightButton('edit', array('href' => U('edit', array('group' => $group, 'id' => '__data_id__'))))  // 添加编辑按钮
                ->addRightButton('forbid')  // 添加禁用/启用按钮
                ->addRightButton('delete')  // 添加删除按钮
                ->display();
    }

    /**
     * 新增分类
     *
     */
    public function add($group = 1) {
        if (IS_POST) {
            $category_object = D('Category');
            $data = $category_object->create();
            if ($data) {
                $id = $category_object->add();
                if ($id) {
                    $this->success('新增成功', U('index', array('group' => I('post.group'))));
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($category_object->getError());
            }
        } else {
            // 获取前台模版供选择
            $category_object = D('Category');
            if(C('CURRENT_THEME')){
                $template_list = \Common\Util\File::get_dirs(getcwd().'/Theme/'.C('CURRENT_THEME').'/'.D('Index')->moduleName.'/Index');
            } else {
                $template_list = \Common\Util\File::get_dirs(getcwd().'/Application/'.D('Index')->moduleName.'/View/Index');
            }
            foreach ($template_list['file'] as $val) {
                $val = substr($val, 0, -5);
                if (strstr($val, 'lists')) {
                    $template_list_index[$val] =  $val;
                } elseif (strstr($val, 'detail')) {
                    $template_list_detail[$val] =  $val;
                }
            }

            // 分类查询条件
            $map = array();
            $map['status'] = array('EGT', -1);
            $map['group']  = $group;

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增分类')  // 设置页面标题
                    ->setPostUrl(U('add'))      // 设置表单提交地址
                    ->addFormItem('group', 'radio', '分组', '分组', D('Category')->group_list())
                    ->addFormItem('pid', 'select', '上级分类', '所属的上级分类', select_list_as_tree('Category', $map, '顶级分类'))
                    ->addFormItem('title', 'text', '分类标题', '分类标题')
                    ->addFormItem('doc_type', 'radio', '分类内容模型', '分类内容模型', select_list_as_tree('Type'))
                    ->addFormItem('url', 'text', '链接', 'U函数解析的URL或者外链', null, 'hidden')
                    ->addFormItem('content', 'kindeditor', '内容', '单页模型填写内容', null, 'hidden')
                    ->addFormItem('index_template', 'select', '列表模版', '文档列表或封面模版', $template_list_index, 'hidden')
                    ->addFormItem('detail_template', 'select', '详情页模版', '单页使用的模版或其他模型文档详情页模版', $template_list_detail, 'hidden')
                    ->addFormItem('icon', 'icon', '图标', '菜单图标')
                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->addFormItem('post_auth', 'radio', '投稿权限', '前台用户投稿权限', $category_object->post_auth())
                    ->setFormData(array('group' => $group, 'post_auth' => 1))
                    ->setExtraHtml($this->extra_html)
                    ->display();
        }
    }

    /**
     * 编辑分类
     *
     */
    public function edit($id, $group = 1) {
        if (IS_POST) {
            $category_object = D('Category');
            $data = $category_object->create();
            if ($data) {
                if ($category_object->save()!== false) {
                    $this->success('更新成功', U('index', array('group' => I('post.group'))));
                } else {
                    $this->error('更新失败');
                }
            } else {
                $this->error($category_object->getError());
            }
        } else {
            // 获取分类信息
            $category_object = D('Category');
            $info = $category_object->find($id);

            // 获取前台模版供选择
            if(C('CURRENT_THEME')){
                $template_list = \Common\Util\File::get_dirs(getcwd().'/Theme/'.C('CURRENT_THEME').'/'.D('Index')->moduleName.'/Index');
            } else {
                $template_list = \Common\Util\File::get_dirs(getcwd().'/Application/'.D('Index')->moduleName.'/View/Index');
            }
            foreach ($template_list['file'] as $val) {
                $val = substr($val, 0, -5);
                if (strstr($val, 'lists')) {
                    $template_list_index[$val] =  $val;
                } elseif (strstr($val, 'detail')) {
                    $template_list_detail[$val] =  $val;
                }
            }

            // 分类查询条件
            $map = array();
            $map['status'] = array('EGT', -1);
            $map['group']  = $group;

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑分类')   // 设置页面标题
                    ->setPostUrl(U('edit', array('id' => $id,'group' => $group)))  // 设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->addFormItem('group', 'radio', '分组', '分组', D('Category')->group_list())
                    ->addFormItem('pid', 'select', '上级分类', '所属的上级分类', select_list_as_tree('Category', $map, '顶级分类'))
                    ->addFormItem('title', 'text', '分类标题', '分类标题')
                    ->addFormItem('doc_type', 'radio', '分类内容模型', '分类内容模型', select_list_as_tree('Type'))
                    ->addFormItem('url', 'text', '链接', 'U函数解析的URL或者外链', null, $info['doc_type'] == 1 ? : 'hidden')
                    ->addFormItem('content', 'kindeditor', '内容', '单页模型填写内容', null, $info['doc_type'] == 2 ? : 'hidden')
                    ->addFormItem('index_template', 'select', '模版', '文档列表或封面模版', $template_list_index, $info['doc_type'] > 2 ? : 'hidden')
                    ->addFormItem('detail_template', 'select', '详情页模版', '单页使用的模版或其他模型文档详情页模版', $template_list_detail, $info['doc_type'] > 1 ? : 'hidden')
                    ->addFormItem('icon', 'icon', '图标', '菜单图标')
                    ->addFormItem('sort', 'num', '排序', '用于显示的顺序')
                    ->addFormItem('post_auth', 'radio', '投稿权限', '前台用户投稿权限', $category_object->post_auth())
                    ->setFormData($info)
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
        $map['id'] = array('in',$ids);
        switch ($status) {
            case 'delete' :  // 删除条目
                $category_object = D('Category');
                $con['cid'] = array('in',$ids);
                $count = D('Index')->where($con)->count();
                if ($count == 0) {
                    $result = $category_object->where($map)->delete();
                    if ($result) {
                        $this->success('删除分类成功');
                    }
                } else {
                    $this->error('请先删除或移动该分类下文档');
                }
                break;
            default :
                parent::setStatus($model);
                break;
        }
    }
}
