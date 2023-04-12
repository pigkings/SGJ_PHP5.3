<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
/**
 * 幻灯片模型

 */
class SliderModel extends Model {
    /**
     * 数据库真实表名
     * 一般为了数据库的整洁，同时又不影响Model和Controller的名称
     * 我们约定每个模块的数据表都加上相同的前缀，比如微信模块用weixin作为数据表前缀

     */
    protected $tableName = 'admin_slider';

    /**
     * 自动验证规则

     */
    protected $_validate = array(
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', '1,80', '标题长度为1-80个字符', self::EXISTS_VALIDATE, 'length'),
        array('title', '', '标题已经存在', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),
        array('award', 'require', '中奖赔率不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('hitnum', 'require', '中奖数字不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('hitnum', '', '中奖数字必须唯一', self::VALUE_VALIDATE, 'unique', self::MODEL_BOTH),

    );

    /**
     * 自动完成规则

     */
    protected $_auto = array(
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 查找后置操作

     */
    protected function _after_find(&$result, $options) {
       if ($result['cover']) {
           $result['cover_url'] = get_cover($result['cover'], 'default');
       }
    }

    /**
     * 查找后置操作

     */
    protected function _after_select(&$result, $options) {
        foreach($result as &$record){
            $this->_after_find($record, $options);
        }
    }

    /**
     * 获取幻灯列表

     */
    public function getList($limit = 10, $page = 1, $order = null, $map = null) {
        $con["status"] = array("eq", '1');
        if ($map) {
            $map = array_merge($con, $map);
        }
        if (!$order) {
            $order = 'sort desc, id desc';
        }
       $slider_list = $this->page($page, $limit)
                          ->order($order)
                          ->where($map)
                          ->select();

        return $slider_list;
    }
}
