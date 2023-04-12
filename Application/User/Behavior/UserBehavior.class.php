<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Behavior;
use Think\Behavior;
use Think\Hook;
defined('THINK_PATH') or exit();
/**
 * 用户消息
 *
 */
class UserBehavior extends Behavior {
    /**
     * 行为扩展的执行入口必须是run
     *
     */
    public function run(&$content) {
        $uid = is_login();
        if ($uid) {
            // 获取用户未读消息数量
            $_new_message = D('User/Message')->newMessageCount();
            cookie('_new_message', $_new_message ? : null);

            // 更新session用户信息
            if((time()-session('user_auth_expire')) > 60){
                $user_object = D('User/User');
                $user_info = $user_object->find($uid);
                if($user_object->auto_login($user_info)) {
                    session('user_auth_expire', time());
                }
            }
        }
    }
}
