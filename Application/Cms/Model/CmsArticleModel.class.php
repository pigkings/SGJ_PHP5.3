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
class CmsArticleModel extends Model {
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
    public $tableName = 'cms_article';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('title', 'require', '文章标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    );
}
