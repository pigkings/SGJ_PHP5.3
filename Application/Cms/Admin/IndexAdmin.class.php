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
 * 后台文档控制器
 *
 */
class IndexAdmin extends AdminController {
    /**
     * 默认方法
     *
     */
    public function index($cid) {
        if ($cid) {
            //获取分类信息
            $category_info = D('Category')->find($cid);

            //获取该分类绑定文档模型的主要字段
            $type_object = D('Type');
            $article_type = $type_object->find($category_info['doc_type']);
            $article_type_main_field = D('Attribute')->getFieldById($article_type['main_field'], 'name');

            //获取分类绑定模型定义的列表需要显示的字段
            $doc_type_list_field = explode(',', $article_type['list_field']);

            //获取文档字段
            $map = array();
            $map['status'] = array('eq', '1');
            $map['show'] = array('eq', '1');
            $map['id'] = array('in', $doc_type_list_field); //只获取列表定义的字段
            $map['doc_type'] = array('eq', $category_info['doc_type']);
            $attribute_list = D('Attribute')->where($map)->select();
            $attribute_list_search = D('Attribute')->where($map)->getField('name', true);

            //获取文档信息
            $map = array();
            $map['cid'] = $cid;
            $map['status'] = array('egt', 0);

            //搜索条件这里用了TP的复合查询
            //封装了一个新的查询条件$map_field，然后并入原来的查询条件$map之中，所以可以完成比较复杂的查询条件组装
            $keyword = I('keyword', '', 'string');
            if ($attribute_list_search && $keyword) {
                foreach ($attribute_list_search as $attribute) {
                    $map_field[$attribute] = array('like','%'.$keyword.'%'); //搜索条件
                }
                $map_field['_logic'] = 'or';
                $map['_complex'] = $map_field;
            }

            //获取文档列表
            $article_list = D('Index')->getList($cid, C('ADMIN_PAGE_ROWS'), $_GET['p'] ? : 1, null, false, $map);
            $article_table = strtolower(C('DB_PREFIX').D('Index')->moduleName.'_'.$article_type['name']);

            //分页
            $base_table = C('DB_PREFIX').D('Index')->tableName;
            $page = new Page(D('Index')->where($map)
                  ->join($article_table.' ON '.$base_table.'.id = '.$article_table.'.id')
                  ->count(), C('ADMIN_PAGE_ROWS'));

            //移动按钮属性
            $move_attr['title'] = '移 动';
            $move_attr['class'] = 'btn btn-info';
            $move_attr['onclick'] = 'move()';

            //构造移动文档所需内容
            $map = array();
            $map['status'] = array('eq', 1);
            $map['doc_type'] = array('eq', $category_info['doc_type']); //文档类型相同的分类才能移动
            $category_list = D('Category')->where($map)->select();
            $tree = new \Common\Util\Tree();
            $category_list = $tree->toFormatTree($category_list);

            //构造移动文档的目标分类列表
            $options = '';
            foreach ($category_list as $key => $val) {
                $options .= '<option value="'.$val['id'].'">'.$val['title_show'].'</option>';
            }

            //文档移动POST地址
            $move_url = U(D('Index')->moduleName.'/Index/move');

            $extra_html = <<<EOF
            <div class="modal fade" id="moveModal">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">关闭</span></button>
                            <p class="modal-title">移动至</p>
                        </div>
                        <div class="modal-body">
                            <form action="{$move_url}" method="post" class="move-form">
                                <div class="form-group">
                                    <select name="to_cid" class="form-control">{$options}</select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="ids">
                                    <input type="hidden" name="from_cid" value="{$cid}">
                                    <button class="btn btn-primary btn-block submit ajax-post" type="submit" target-form="move-form">确 定</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function move(){
                    var ids = '';
                    $('input[name="ids[]"]:checked').each(function(){
                       ids += ',' + $(this).val();
                    });
                    if(ids != ''){
                        ids = ids.substr(1);
                        $('input[name="ids"]').val(ids);
                        $('.modal-title').html('移动选中的的文章至：');
                        $('#moveModal').modal('show', 'fit')
                    }else{
                        $.alertMessager('请选择需要移动的文章', 'danger');
                    }
                }
            </script>
EOF;

            //使用Builder快速建立列表页面。
            $builder = new \Common\Builder\ListBuilder();
            $builder->setMetaTitle($category_info['title']) //设置页面标题
                    ->addTopButton('addnew', array('href' => U('add', array('cid' => $cid)))) //添加新增按钮
                    ->addTopButton('resume', array('model' => D('Index')->tableName))  //添加启用按钮
                    ->addTopButton('forbid', array('model' => D('Index')->tableName))  //添加禁用按钮
                    ->addTopButton('recycle', array('model' => D('Index')->tableName)) //添加回收按钮
                    ->addTopButton('self', $move_attr) //添加移动按钮
                    ->setSearch('请输入ID/标题', U('index', array('cid' => $cid)))
                    ->addTableColumn('id', 'ID')
                    ->addTableColumn('title', '标题');

            //动态生成列表显示的字段
            if ($attribute_list) {
                foreach($attribute_list as $attribute){
                    if ($attribute['name'] !== $article_type_main_field) {
                        $builder->addTableColumn($attribute['name'], $attribute['title'], $attribute['type']);
                    }
                }
            }

            //继续使用Builder快速建立列表页面
            $builder->addTableColumn('create_time', '发布时间', 'time')
                    ->addTableColumn('sort', '排序', 'text')
                    ->addTableColumn('status', '状态', 'status')
                    ->addTableColumn('right_button', '操作', 'btn')
                    ->setTableDataList($article_list) //数据列表
                    ->setTableDataPage($page->show())  //数据列表分页
                    ->addRightButton('edit')    //添加编辑按钮
                    ->addRightButton('forbid')  //添加禁用/启用按钮
                    ->addRightButton('recycle') //添加回收按钮
                    ->setExtraHtml($extra_html)
                    ->display();
        }
    }

    /**
     * 新增文档
     *
     */
    public function add($cid) {
        if (IS_POST) {
            //新增文档
            $article_object = D('Index');
            $result = $article_object->update();
            if(!$result){
                $this->error($article_object->getError());
            }else{
                $this->success('新增成功', U('index', array('cid' => I('post.cid'))));
            }
        } else {
            //获取当前分类
            $category_info = D('Category')->find($cid);
            $doc_type = D('Type')->find($category_info['doc_type']);
            $field_sort = json_decode($doc_type['field_sort'], true);
            $field_group = parse_attr($doc_type['field_group']);

            //获取文档字段
            $map['status'] = array('eq', '1');
            $map['show'] = array('eq', '1');
            $map['doc_type'] = array('in', '0,'.$category_info['doc_type']);
            $attribute_list = D('Attribute')->where($map)->select();

            //解析字段options
            $new_attribute_list = array();
            foreach ($attribute_list as $attr) {
                if ($attr['name'] == 'cid') {
                    $con['group'] = $category_info['group'];
                    $con['doc_type'] = $category_info['doc_type'];
                    $con['status'] = array('egt', 0);
                    $attr['value'] = $cid;
                    $attr['options'] = select_list_as_tree('Category', $con);
                } else {
                    $attr['options'] = parse_attr($attr['options']);
                }
                $new_attribute_list[$attr['id']] = $attr;
            }

            //表单字段排序及分组
            if ($field_sort) {
                $new_attribute_list_sort = array();
                foreach ($field_sort as $k1 => &$v1) {
                    $new_attribute_list_sort[0]['type'] = 'group';
                    $new_attribute_list_sort[0]['options']['group'.$k1]['title'] = $field_group[$k1];
                    foreach ($v1 as $k2 => $v2) {
                        $new_attribute_list_sort[0]['options']['group'.$k1]['options'][] = $new_attribute_list[$v2];
                    }
                }
                $new_attribute_list = $new_attribute_list_sort;
            }

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('新增文章') //设置页面标题
                    ->setPostUrl(U('add')) //设置表单提交地址
                    ->setExtraItems($new_attribute_list)
                    ->display();
        }
    }

    /**
     * 编辑文章
     *
     */
    public function edit($id) {
        //获取文档信息
        $article_info = D('Index')->detail($id);

        if (IS_POST) {
            //更新文档
            $article_object = D('Index');
            $result = $article_object->update();
            if (!$result) {
                $this->error($article_object->getError());
            } else {
                $this->success('更新成功', U('index', array('cid' => I('post.cid'))));
            }
        } else {

            //获取当前分类
            $category_info = D('Category')->find($article_info['cid']);
            $doc_type = D('Type')->find($category_info['doc_type']);
            $field_sort = json_decode($doc_type['field_sort'], true);
            $field_group = parse_attr($doc_type['field_group']);

            //获取文档字段
            $map['status'] = array('eq', '1');
            $map['show'] = array('eq', '1');
            $map['doc_type'] = array('in', '0,'.$category_info['doc_type']);
            $attribute_list = D('Attribute')->where($map)->select();

            //解析字段options
            $new_attribute_list = array();
            foreach ($attribute_list as $attr) {
                if ($attr['name'] == 'cid') {
                    $con['group'] = $category_info['group'];
                    $con['doc_type'] = $category_info['doc_type'];
                    $con['status'] = array('egt', 0);
                    $attr['options'] = select_list_as_tree('Category', $con);
                } else {
                    $attr['options'] = parse_attr($attr['options']);
                }
                $new_attribute_list[$attr['id']] = $attr;
                $new_attribute_list[$attr['id']]['value'] = $article_info[$attr['name']];
            }

            //表单字段排序及分组
            if ($field_sort) {
                $new_attribute_list_sort = array();
                foreach ($field_sort as $k1 => &$v1) {
                    $new_attribute_list_sort[0]['type'] = 'group';
                    $new_attribute_list_sort[0]['options']['group'.$k1]['title'] = $field_group[$k1];
                    foreach ($v1 as $k2 => $v2) {
                        $new_attribute_list_sort[0]['options']['group'.$k1]['options'][] = $new_attribute_list[$v2];
                    }
                }
                $new_attribute_list = $new_attribute_list_sort;
            }

            //使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('编辑文章') //设置页面标题
                    ->setPostUrl(U('edit')) //设置表单提交地址
                    ->addFormItem('id', 'hidden', 'ID', 'ID')
                    ->setExtraItems($new_attribute_list)
                    ->setFormData($article_info)
                    ->display();
        }
    }

    /**
     * 移动文档
     *
     */
    public function move() {
        if (IS_POST) {
            $ids = I('post.ids');
            $from_cid = I('post.from_cid');
            $to_cid = I('post.to_cid');
            if ($from_cid === $to_cid) {
                $this->error('目标分类与当前分类相同');
            }
            if ($to_cid) {
                $category_model = D('Category');
                $form_category_type = $category_model->getFieldById($from_cid, 'doc_type');
                $to_category_type = $category_model->getFieldById($to_cid, 'doc_type');
                if ($form_category_type === $to_category_type) {
                    $map['id'] = array('in',$ids);
                    $data = array('cid' => $to_cid);
                    $this->editRow('Index', $data, $map, array('success'=>'移动成功','error'=>'移动失败'));
                } else {
                    $this->error('该分类模型不匹配');
                }
            } else {
                $this->error('请选择目标分类');
            }
        } else {
            $this->error('错误');
        }
    }

    /**
     * 回收站
     *
     */
    public function recycle() {
        $map['status'] = array('eq', '-1');
        $article_list = D('Index')->page(!empty($_GET["p"])?$_GET["p"]:1, C('ADMIN_PAGE_ROWS'))->where($map)->select();
        $page = new Page(D('Index')->where($map)->count(), C('ADMIN_PAGE_ROWS'));

        //使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('回收站') //设置页面标题
                ->addTopButton('restore', array('model' => D('Index')->tableName)) //添加还原按钮
                ->setSearch('请输入ID/文档名称', U('recycle'))
                ->addTableColumn('id', 'ID')
                ->addTableColumn('title', '标题')
                ->addTableColumn('create_time', '发布时间', 'time')
                ->addTableColumn('sort', '排序')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($article_list) //数据列表
                ->setTableDataPage($page->show()) //数据列表分页
                ->addRightButton('restore') //添加还原按钮
                ->addRightButton('delete') //添加删除按钮
                ->display();
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
                $map['status'] = -1;
                $info = D('Index')->detail($ids, $map);
                $extend_table_object = D(strtolower(D('Index')->moduleName.'_'.$info['doc_type_info']['name']));
                $exist = $extend_table_object->find($ids);
                if ($exist) {
                    $result = $extend_table_object->delete($ids);
                } else {
                    $result = true;
                }
                if ($result) {
                    $result2 = D('Index')->delete($ids);
                    if ($result2) {
                        $this->success('彻底删除成功');
                    } else {
                        $this->error('删除失败');
                    }
                } else {
                    $this->error('删除失败');
                }
                break;
            default :
                parent::setStatus($model);
                break;
        }
    }
}
