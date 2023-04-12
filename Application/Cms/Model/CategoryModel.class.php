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
 * 分类模型
 *
 */
class CategoryModel extends Model {
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
    protected $tableName = 'cms_category';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('title', 'require', '名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,32', '名称长度为1-32个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_BOTH),
        array('title', 'checkTitle', '名称已经存在', self::MUST_VALIDATE, 'callback', self::MODEL_INSERT),
        array('group', 'require', '分组不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('doc_type', 'require', '内容模型不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('url', '0,255', '链接长度为0-25个字符', self::EXISTS_VALIDATE, 'length',self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     *
     */
    protected $_auto = array(
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 查找后置操作
     *
     */
    protected function _after_find(&$result, $options) {
        $result['cover_url'] = get_cover($result['cover'], 'default');
        $doc_type_info = $result['doc_type_info'] = D($this->moduleName.'Type')->find($result['doc_type']);  // 获取当前文档类型
        if ($doc_type_info['name'] === 'page') {
            $result['href'] = U('Cms/Category/detail', array('id' => $result['id']));
        } else if ($doc_type_info['name'] === 'link') {
            if (!stristr($result['url'], 'http://') && !stristr($result['url'], 'https://')) {
                $result['href'] = U($result['url']);
            } else {
                $result['href'] = 'javascript:window.open(\''.$result['url'].'\')';
            }
        } else if ($doc_type_info['system'] === '0') {
            $result['href'] = U('Cms/Index/lists', array('cid' => $result['id']));
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
     * 前台用户投稿权限(不影响后台)
     *
     */
    public function post_auth($id) {
        $list[0] = '禁止投稿';
        $list[1] = '允许投稿';
        return $id ? $list[$id] : $list;
    }

    /**
     * 栏目分组
     *
     */
    public function group_list() {
        return parse_attr(C('cms_config.group_list'));
    }

    /**
     * 检查同一分组下是否有相同的字段
     *
     */
    protected function checkTitle() {
        $map['title'] = array('eq', I('post.title'));
        $map['group'] = array('eq', I('post.group'));
        $result = $this->where($map)->find();
        return empty($result);
    }

    /**
     * 获取参数的所有父级分类
     * @param int $cid 分类id
     * @return array 参数分类和父类的信息集合
     *
     */
    public function getParentCategory($cid, $group = 1) {
        if (empty($cid)) {
            return false;
        }
        $con['status'] = 1;
        $con['group']  = $group;
        $category_list = $this->where($con)->field('id,pid,group,title,url')->select();
        $current_category = $this->field('id,pid,group,title,url')->find($cid); //获取当前分类的信息
        $result[] = $current_category;
        $pid = $current_category['pid'];
        while (true) {
            foreach ($category_list as $key => $val) {
                if ($val['id'] == $pid) {
                    $pid = $val['pid'];
                    array_unshift($result, $val); //将父分类插入到数组第一个元素前
                }
            }
            if ($pid == 0 || count($result) == 1) { //已找到顶级分类或者没有任何父分类
                break;
            }
        }
        return $result;
    }

    /**
     * 获取分类树，指定分类则返回指定分类的子分类树，不指定则返回所有分类树，指定分类若无子分类则返回同级分类
     * @param  integer $id    分类ID
     * @param  boolean $field 查询字段
     * @return array          分类树
     *
     */
    public function getCategoryTree($id = 0, $limit = null, $page =1, $group = 1, $field = true) {
        //获取当前分类信息
        if ((int)$id > 0) {
            $info = $this->find($id);
            $id   = $info['id'];
        }

        //获取所有分类
        $map['status'] = array('eq', 1);
        $map['group']  = array('eq', $id ? $info['group'] : $group);
        $tree = new \Common\Util\Tree();
        $list = $this->field($field)->where($map)->order('sort asc, id asc')->select();

        // 转换成树结构
        $list = $tree->list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = (int)$id); //返回当前分类的子分类树
        if ($limit) {
            $list = array_slice($list, 0, $limit);
        }
        if (!$list) {
            return $this->getSameLevelCategoryTree($id);
        }
        return $list;
    }

    /**
     * 获取同级分类树
     * @param  integer $id    分类ID
     * @return array          分类树
     *
     */
    public function getSameLevelCategoryTree($id = 0) {
        //获取当前分类信息
        if ((int)$id > 0) {
            $info = $this->find($id);
            $parent_info = $this->find($info['pid']);
            $id   = $info['id'];
        }

        //获取所有分类
        $map['status'] = array('eq', 1);
        $map['pid']    = array('eq', $info['pid']);
        $map['group']  = array('eq', $info['group']);
        $list = $this->field($field)->where($map)->order('sort asc')->select();

        return $list;
    }
}
