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
 * 文档字段模型
 * 该类参考了OneThink的部分实现
 * @author huajie <banhuajie@163.com>
 */
class AttributeModel extends Model {
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
    protected $tableName = 'cms_attribute';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('name', 'require', '字段名必须', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '/^[a-zA-Z][\w_]{1,29}$/', '字段名不合法', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', 'checkName', '字段名已存在', self::MUST_VALIDATE, 'callback', self::MODEL_BOTH),
        array('title', '1,100', '字段定义不能超过100个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
        array('type', 'require', '字段类型必须', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('field', 'require', '字段定义必须', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('field', '1,100', '字段定义不能超过100个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
        array('tip', '1,100', '备注不能超过100个字符', self::VALUE_VALIDATE, 'length', self::MODEL_BOTH),
        array('doc_type', 'require', '未选择操作的文档类型', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
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
     * 操作的表名
     *
     */
    protected $table_name = null;

    /**
     * 检查同一张表是否有相同的字段
     * @author huajie <banhuajie@163.com>
     */
    protected function checkName() {
        $map['name'] = array('eq', I('post.name'));
        $map['doc_type'] = array('eq', I('post.doc_type'));
        $id = I('post.id');
        if (!empty($id)) {
            $map['id'] = array('neq', $id);
        }
        $result = $this->where($map)->find();
        return empty($result);
    }

    /**
     * 检查当前表是否存在
     * @param intger $model_id 模型id
     * @return intger 是否存在
     * @author huajie <banhuajie@163.com>
     */
    protected function checkTableExist($doc_type) {
        $table_name = C('DB_PREFIX').$this->moduleName.'_'.D($this->moduleName.'/Type')->getfieldById($doc_type, 'name');
        $this->table_name = strtolower($table_name);
        $res = M()->query("SHOW TABLES LIKE '".$this->table_name."'");
        return count($res);
    }

    /**
     * 新建表字段
     * @param array $field 需要新建的字段属性
     * @return boolean true 成功 ， false 失败
     * @author huajie <banhuajie@163.com>
     */
    public function addField($field) {
        //检查表是否存在
        $table_exist = $this->checkTableExist($field['doc_type']);

        //获取默认值
        if ($field['value'] === '') {
            $default = '';
        } else if (is_numeric($field['value'])) {
            $default = ' DEFAULT '.$field['value'];
        } else if (is_string($field['value'])) {
            $default = ' DEFAULT \''.$field['value'].'\'';
        } else {
            $default = '';
        }

        if ($table_exist) {
            $sql = <<<sql
                ALTER TABLE `{$this->table_name}`
ADD COLUMN `{$field['name']}` {$field['field']} {$default} COMMENT '{$field['title']}';
sql;
        } else {
        //新建表
        $sql = <<<sql
            CREATE TABLE IF NOT EXISTS `{$this->table_name}` (
            `id`  int(10) UNSIGNED NOT NULL COMMENT 'ID' ,
            `{$field['name']}` {$field['field']} {$default} COMMENT '{$field['title']}' ,
            PRIMARY KEY (`id`)
            )
            ENGINE=MyISAM
            DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
            CHECKSUM=0
            ROW_FORMAT=DYNAMIC
            DELAY_KEY_WRITE=0
            ;
sql;
        }
        $res = M()->execute($sql);
        return $res !== false;
    }

    /**
     * 更新表字段
     * @param array $field 需要更新的字段属性
     * @return boolean true 成功 ， false 失败
     * @author huajie <banhuajie@163.com>
     */
    public function updateField($field) {
        //检查表是否存在
        $table_exist = $this->checkTableExist($field['doc_type']);

        //获取原字段名
        $last_field = $this->getFieldById($field['id'], 'name');

        //获取默认值
        $default = $field['value'] !='' ? ' DEFAULT \''.$field['value'].'\'' : '';

        $sql = <<<sql
            ALTER TABLE `{$this->table_name}`
CHANGE COLUMN `{$last_field}` `{$field['name']}` {$field['field']} {$default} COMMENT '{$field['title']}' ;
sql;
        $res = M()->execute($sql);
        return $res !== false;
    }

    /**
     * 删除一个字段
     * @param array $field 需要删除的字段属性
     * @return boolean true 成功 ， false 失败
     * @author huajie <banhuajie@163.com>
     */
    public function deleteField($field) {
        //检查表是否存在
        $table_exist = $this->checkTableExist($field['doc_type']);
        if ($table_exist) {
            $sql = <<<sql
                ALTER TABLE `{$this->table_name}`
DROP COLUMN `{$field['name']}`;
sql;
            $res = M()->execute($sql);
        }
        return $res !== false;
    }
}
