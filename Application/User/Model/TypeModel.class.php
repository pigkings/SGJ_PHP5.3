<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Model;
use Think\Model;
/**
 * 用户类型模型
 *
 */
class TypeModel extends Model {
    /**
     * 数据库表名
     *
     */
    protected $tableName = 'user_type';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('name', 'require', '类型名称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '/^[\w]+$/', '名称必须是纯英文，不包含下划线、空格及其他字符', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', 'require', '类型标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
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
}
