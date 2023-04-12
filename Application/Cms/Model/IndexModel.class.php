<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Cms\Model;
use Think\Model;
/**
 * 文章模型
 *
 */
class IndexModel extends Model {
    /**
     * 模块名称
     *
     */
    public $moduleName = 'Cms';

    /**
     * 数据库真实表名
     * 一般为了数据库的整洁，同时又不影响Model和Controller的名称
     * 我们约定每个模块的数据表都加上相同的前缀，比如微信模块用weixin作为数据表前缀
     *
     */
    public $tableName = 'cms_index';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('doc_type', 'require', '文档类型不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('cid', 'require', '分类不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('cid', 'checkPostAuth', '该分类禁止投稿', self::MUST_VALIDATE, 'callback', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     *
     */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 查找后置操作
     *
     */
    protected function _after_find(&$result, $options) {
       if ($result['cid']) {
           $result['category_info'] = D($this->moduleName.'/Category')->find($result['cid']);
       }
    }

    /**
     * 查找后置操作
     *
     */
    protected function _after_select(&$result, $options) {
        foreach($result as &$record){
            $this->_after_find($record, $options);
        }
    }

    /**
     * 检查分类是否允许前台会员投稿
     * @return int 时间戳
     *
     */
    protected function checkPostAuth() {
        if (MODULE_NAME == 'Home') {
            $category_post_auth = D($this->moduleName.'/Category')->getFieldById(I('post.cid'), 'post_auth');
            if (!$category_post_auth) {
                return false;
            }
        }
        return true;
    }

    /**
     * 新增或更新一个文章
     *
     */
    public function update() {
        // 处理数据
        $_POST = format_data();

        //调用create方法构造数据
        $cid = I('post.cid');
        $category_info = D($this->moduleName.'/Category')->find($cid);
        $doc_type_info = D($this->moduleName.'/Type')->where(array('id' => $category_info['doc_type']))->find();
        $_POST['doc_type'] = $doc_type_info['id'];
        $base_data = $this->create();
        if ($base_data) {
            //获取当前分类
            $extend_table_object = D($this->moduleName.'/'.$this->moduleName.ucfirst($doc_type_info['name']));
            $extend_data = $extend_table_object->create(); //子模型数据验证
            if (!$extend_data) {
                $this->error = $extend_table_object->getError();
            }
            if ($extend_data) {
                if (empty($base_data['id'])) { //新增基础内容
                    $base_id = $this->add();
                    if ($base_id) {
                        $extend_data['id'] = $base_id;
                        $extend_id = $extend_table_object->add($extend_data);
                        if (!$extend_id) {
                            $this->delete($base_id);
                            $this->error = '新增扩展内容出错！';
                            return false;
                        }
                        return $base_id;
                    } else {
                        $this->error = '新增基础内容出错！';
                        return false;
                    }
                } else {
                    $status = $this->save(); //更新基础内容
                    if ($status) {
                        $status = $extend_table_object->save(); //更新基础内容
                        if (false === $status) {
                            $this->error = '更新扩展内容出错！';
                            return false;
                        }
                        return $extend_data;
                    } else {
                        $this->error = '更新基础内容出错！';
                        return false;
                    }
                }
            }
        }
        return false;
    }

    /**
     * 获取文章列表
     *
     */
    public function getList($cid, $limit = 10, $page = 1, $order = null, $child = false, $map = null) {
        //获取分类信息
        $category_object = D($this->moduleName.'/Category');
        $category_info = $category_object->find($cid);
        $base_table = C('DB_PREFIX').$this->tableName;

        //获取该分类绑定文章模型的主要字段
        $type_object = D($this->moduleName.'/Type');
        $type = $type_object->where('system = 0')->find($category_info['doc_type']);
        if ($type) {
            $this->error = '文档模型错误';
        }

        // 获取相同文档类型的子分类
        if ($child) {
            $child_cate_ids = $category_object->where(array('pid' => $cid, 'doc_type' => $category_info['doc_type']))->getField('id', true);
            if ($child_cate_ids) {
                $cid_list[] = $cid;
                $cid_list = array_merge($cid_list, $child_cate_ids);
            }
        } else {
            $cid_list[] = $cid;
        }

        $con["cid"] = array("in", $cid_list);
        $con["status"] = array("eq", '1');
        if ($map) {
            $map = array_merge($con, $map);
        }
        if (!$order) {
            $order = 'sort desc,'.$base_table.'.id desc';
        }
        $extend_table = strtolower(C('DB_PREFIX').$this->moduleName.'_'.$type['name']);
        $return_list = $this->page($page, $limit)
                             ->order($order)
                             ->join($extend_table.' ON '.$base_table.'.id = '.$extend_table.'.id')
                             ->where($map)
                             ->select();

        // 拼接文章地址
        $main_field_name = D($this->moduleName.'/Attribute')->getFieldById($type['main_field'], 'name');
        foreach ($return_list as $key => &$val) {
            $val['href'] = U($this->moduleName.'/Index/detail', array('id' => $val['id']));
            $val['title_url'] = '<a target="_blank" href="'.U($this->moduleName.'/Index/detail', array('id' => $val['id'])).'">'.$val[$main_field_name].'</a>';
        }
        return $return_list;
    }

    /**
     * 获取文章列表
     *
     */
    public function getNewList($doc_type = 3, $limit = 10, $page =1, $order = null, $map = null) {
        //获取该分类绑定文章模型的主要字段
        $type_object = D($this->moduleName.'/Type');
        $type = $type_object->find($doc_type);
        if (!$type) {
            return false;
        }

        // 获取文章列表
        $base_table = C('DB_PREFIX').$this->tableName;
        $con["status"] = array("eq", '1');
        $con["doc_type"] = array("eq", $doc_type);
        if ($map) {
            $map = array_merge($con, $map);
        }
        if (!$order) {
            $order = 'sort desc,'.$base_table.'.id desc';
        }
        $extend_table = strtolower(C('DB_PREFIX').$this->moduleName.'_'.$type['name']);
        $article_list = $this->page($page, $limit)
                             ->order($order)
                             ->join($extend_table.' ON '.$base_table.'.id = '.$extend_table.'.id')
                             ->where($map)
                             ->select();

        // 拼接文章地址
        foreach ($article_list as $key => &$val) {
            $val['href'] = U($this->moduleName.'/Index/detail', array('id' => $val['id']));
        }
        return $article_list;
    }

    /**
     * 获取文章详情
     *
     */
    public function detail($id, $map = null) {
        //获取基础表信息
        $con = array();
        $con['id'] = $id;
        $con['status'] = array('egt', 1);  // 正常、隐藏两种状态是可以访问的
        if ($map) {
            $con = array_merge($con, $map);
        }
        $info = $this->where($con)->find();
        if (!is_array($info)) {
            $this->error = '文章被禁用或已删除！';
            return false;
        }

        // 阅读量加1
        $result = $this->where(array('id' => $id))->SetInc('view');

        // 获取收藏状态
        $info['mark_status'] = D($this->moduleName.'/Mark')->get_mark_status($info['id']);

        // 获取作者信息
        $info['user'] = get_user_info($info['uid']);

        // 获取发帖数量
        $info['user']['post_count'] = $this->where(array('uid' => $info['uid']))->count();

        // 获取评论数量
        $info['user']['comment_count'] = D($this->moduleName.'/Comment')->where(array('uid' => $info['uid']))->count();

        // 获取文档模型相关信息
        $doc_type_info = D($this->moduleName.'/Type')->find($info['category_info']['doc_type']);
        if ($doc_type_info['system']) {
            $this->error = '文档类型错误！';
            return false;
        }
        $info['doc_type_info'] = $doc_type_info;

        // 根据文章模型获取扩展表的息
        $extend_table_object = D($this->moduleName.'/'.$this->moduleName.ucfirst($doc_type_info['name']));
        $extend_data = $extend_table_object->find($id);

        // 基础信息与扩展信息合并
        if (is_array($extend_data)) {
            $info = array_merge($info, $extend_data);
        }

        // 获取筛选字段
        $con = array();
        $con['id'] = array('in', $doc_type_info['filter_field']);
        $attribute_object = D($this->moduleName.'/Attribute');
        $filter_field_list = $attribute_object->where($con)->select();
        $new_filter_field_list = array();
        foreach ($filter_field_list as $key => $val) {
            $val['options'] = parse_attr($val['options']);
            $new_filter_field_list[$val['name']] = $val;
        }
        $info['filter_field_list'] = $new_filter_field_list;

        // 给文档主要字段赋值，如：文章标题、商品名称
        $type_main_field  = $attribute_object->getFieldById($doc_type_info['main_field'], 'name');
        $info['main_field'] = $info[$type_main_field];

        // 下载文件地址加密
        if ($info['file']) {
            $file_list = explode(',', $info['file']);
            foreach ($file_list as &$file) {
                $file = D('Admin/Upload')->find($file);
                $uid = is_login();
                if ($uid) {
                    $file['token'] = \Think\Crypt::encrypt($file['md5'], user_md5($uid), 3600);
                } else {
                    $file['token'] = 'please login';
                }
            }
            $info['file_list'] = $file_list;
        }

        // 获取上一篇和下一篇文章信息
        $info['previous'] = $this->getPrevious($info);
        $info['next']     = $this->getNext($info);
        return $info;
    }

    /**
     * 获取当前分类上一篇文章
     *
     */
    private function getPrevious($info) {
        // 获取文档信息
        $map['status'] = array('eq', 1);
        $map['id'] = array('lt', $info['id']);
        $map['cid'] = array('eq', $info['cid']);
        $previous = $this->where($map)->order('id desc')->find();

        // 获取扩展信息
        if ($previous) {
            $type = D($this->moduleName.'/Type')->find($previous['doc_type']);
            $main_field_name = D($this->moduleName.'/Attribute')->getFieldById($type['main_field'], 'name');
            $previous['title'] = D($this->moduleName.'/'.$this->moduleName.ucfirst($type['name']))->getFieldById($previous['id'], $main_field_name);
        }

        if (!$previous) {
            $previous['title'] = '没有了';
            $previous['href'] = '#';
        } else {
            $previous['href'] = U($this->moduleName.'/Index/detail', array('id' => $previous['id']));
        }
        return $previous;
    }

    /**
     * 获取当前分类下一篇文章
     *
     */
    private function getNext($info) {
        // 获取文档信息
        $map['status'] = array('eq', 1);
        $map['id'] = array('gt', $info['id']);
        $map['cid'] = array('eq', $info['cid']);
        $next = $this->where($map)->order('id asc')->find();

        // 获取扩展信息
        if ($next) {
            $type = D($this->moduleName.'/Type')->find($next['doc_type']);
            $main_field_name = D($this->moduleName.'/Attribute')->getFieldById($type['main_field'], 'name');
            $next['title'] = D($this->moduleName.'/'.$this->moduleName.ucfirst($type['name']))->getFieldById($next['id'], $main_field_name);
        }

        if (!$next) {
            $next['title'] = '没有了';
            $next['href'] = '#';
        } else {
            $next['href'] = U($this->moduleName.'/Index/detail', array('id' => $next['id']));
        }
        return $next;
    }
}
