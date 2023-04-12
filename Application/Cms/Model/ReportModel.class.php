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
 * 举报模型
 *
 */
class ReportModel extends Model {
    /**
     * 数据库真实表名
     * 一般为了数据库的整洁，同时又不影响Model和Controller的名称
     * 我们约定每个模块的数据表都加上相同的前缀，比如微信模块用weixin作为数据表前缀
     *
     */
    protected $tableName = 'cms_report';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('data_id','require','请填写举报项目', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('reason','require','请填写举报理由', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('abstract','require','请填写详情', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('mobile','require','请填写电话', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     *
     */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '0', self::MODEL_INSERT),
    );

    /**
     * 举报理由
     *
     */
    public function reason_list($id) {
        $list[1] = '虚假信息';
        $list[2] = '涉嫌诈骗';
        $list[3] = '辱骂他人';
        return $id ? $list[$id] : $list;
    }
}
