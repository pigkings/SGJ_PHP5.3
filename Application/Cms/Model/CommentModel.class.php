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
 * 评论模型
 *
 */
class CommentModel extends Model{
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
    protected $tableName = 'cms_comment';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        array('data_id', 'require', '数据ID', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('content', 'require', '内容不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('content', '1,1280', '内容长度不多于1280个字符', self::VALUE_VALIDATE, 'length'),
        array('content', 'checkContent', '至少包含2个中文字符', self::MUST_VALIDATE, 'callback', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则
     *
     */
    protected $_auto = array(
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('content', 'html2text', self::MODEL_BOTH, 'function'),
        array('nickname', 'getNickname', self::MODEL_INSERT, 'callback'),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('sort', '0', self::MODEL_INSERT),
        array('status', 1, self::MODEL_INSERT, 'string'),
        array('ip', 'get_client_ip', self::MODEL_INSERT, 'function'),
    );

    /**
     * 验证评论内容
     *
     */
    public function checkContent($map){
        preg_match_all("/([\一-\龥]){1}/u", $_POST['content'], $num);
        if(2 > count($num[0])){
            return false;
        }
        return true;
    }

    /**
     * 获取用户昵称
     * @author huajie <banhuajie@163.com>
     */
    protected function getNickname() {
        $nickname = get_user_info(is_login(), 'nickname');
        return $nickname;
    }

    /**
     * 发表评论
     *
     */
    public function addNew($data) {
        $add_result = $this->add($data);
        if ($add_result) {
            //更新评论数
            $article_object = D($this->moduleName.'/Index');
            $article_object->where(array('id'=> (int)$data['data_id']))->setInc('comment');

            //获取当前被评论文档的基础信息
            $current_document_info = $article_object->detail($data['data_id']);

            //查看详情连接
            $view_detail = '<a href="'.U($this->moduleName.'/Index/detail', array('id' => $current_document_info['id']), null, true, true).'"> 查看详情... </a>';

            //当前发表评论的用户信息
            $uid = is_login();
            $current_user_info = get_user_info($uid);

            //给评论用户用户名加上链接以便于直接点击
            $current_username = '<a href="'.U('User/Index/home', array('uid' => $current_user_info['id']), null, true, true).'">'.$current_user_info['nickname'].'</a>';

            //如果是对别人的评论进行回复则获取被评论的那个人的UID以便于发消息骚扰他
            if ($data['pid']) {
                $previous_comment_uid = D($this->moduleName.'/Comment')->getFieldById($data['pid'], 'uid');
            }

            //定义消息结构
            $msg_data['title'] = $current_username.'回复了您！'.$view_detail;
            $msg_data['type']  = 1;
            $msg_data['form_uid'] = $uid;

            //给文档作者发送消息
            //自己给自己发表的文档评论时不发送 要求$current_document_info['uid'] !== $current_user_info['id']
            if ($current_document_info['uid'] !== $current_user_info['id']) {
                //给文档发表者发消息
                $msg_data['to_uid'] = $current_document_info['uid'];
                $result = D('User/Message')->sendMessage($msg_data);
            }

            //给被回复者发送消息
            //自己回复自己的评论时不发送 要求$current_document_info['uid'] !== $previous_comment_uid
            //如果是对别人的评论进行回复则获取被评论的那个人的UID以便于发消息骚扰他
            if ($data['pid']) {
                $previous_comment_uid = D($this->moduleName.'/Comment')->getFieldById($data['pid'], 'uid');
                if ($current_document_info['uid'] !== $previous_comment_uid) {
                    $msg_data['to_uid'] = $previous_comment_uid;
                    $result = D('User/Message')->sendMessage($msg_data);
                }
            }
        }
        return $add_result;
    }

    /**
     * 根据条件获取评论列表
     *
     */
    public function getCommentList($data_id, $limit = 10, $page = 1, $order = 'sort desc,id asc', $con = null){
        $map['status'] = 1;
        $map['data_id'] = $data_id;
        if ($con) {
            $map = array_merge($map, $con);
        }
        $comments = $this->where($map)->page($page, $limit)->order($order)->select();
        foreach($comments as $key => &$val){
            // 获取用户信息
            $val['create_time'] = friendly_date($val['create_time']);
            $val['avatar'] = get_cover(D('User/User')->getFieldById($val['uid'], 'avatar'), 'avatar');
            if($val['pid'] > 0){
                $parent_comment = $this->find($val['pid']);
                $val['parent_comment_nickname'] = $parent_comment['nickname'];
            }

            // 获取发帖数量
            $val['post_count'] = D($this->moduleName.'/Index')->where(array('uid' => $val['uid']))->count();

            // 获取评论数量
            $val['comment_count'] = D($this->moduleName.'/Comment')->where(array('uid' => $val['uid']))->count();
        }
        return $comments;
    }
}
