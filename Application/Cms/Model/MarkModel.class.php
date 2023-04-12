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
 * 收藏模型
 *
 */
class MarkModel extends Model {
    /**
     * 模块名称
     *
     */
    public $moduleName = 'Cms';

    /**
     * 数据库表名
     *
     */
    protected $tableName = 'cms_mark';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('data_id', 'require', '数据ID必须', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('uid', 'require', '用户ID必须', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    );

    /**
     * 自动完成规则
     *
     */
    protected $_auto = array(
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', 1, self::MODEL_INSERT, 'string'),
    );

    /**
     * 获取收藏状态
     *
     */
    public function get_mark_status($data_id) {
        $con = array();
        $con['uid'] = is_login();
        $con['data_id'] = $data_id;
        $con['status'] = 1;
        $result = $this->where($con)->find();
        return $result;
    }
}
