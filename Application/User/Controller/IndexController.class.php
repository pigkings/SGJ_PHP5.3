<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Controller;
use Home\Controller\HomeController;
use Common\Util\Think\Page;
/**
 * 默认控制器
 *
 */
class IndexController extends HomeController {
    /**
     * 用户UID
     *
     */
    public function uid() {
        $this->success('已登录', '', array('uid' => $this->is_login()));
    }

    /**
     * 用户列表
     *
     */
    public function index($user_type = 1) {
        // 获取用户类型的搜索字段
        $user_type_info = D('User/Type')->find($user_type);
        $con = array();
        $con['user_type'] = $user_type;
        $con['id'] = array('in', $user_type_info['list_field']);
        $query_attribute = D('User/Attribute')->where($con)->select();
        foreach ($query_attribute as &$value) {
            $value['options'] = parse_attr($value['options']);

            // 构造搜索条件
            if ($_GET[$value['name']] !== 'all' && $_GET[$value['name']]) {
                switch ($value['type']) {
                    case 'radio':
                        $tmp = $_GET[$value['name']];
                        $map[$value['name']] = $tmp;
                        break;
                    case 'select':
                        $tmp = $_GET[$value['name']];
                        $map[$value['name']] = $tmp;
                        break;
                    case 'checkbox':
                        $tmp = $_GET[$value['name']];
                        $map[$value['name']] = array(
                            'like',
                            array(
                                $tmp,
                                $tmp.',%',
                                '%,'.$tmp.',%',
                                '%,'.$tmp
                            ),
                            'OR'
                        );
                        break;
                }
            }
        }

        // 获取用户基本信息
        $map['status']    = 1;

        // 关键字搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword) {
            $condition = array('like','%'.$keyword.'%');
            $map['id|nickname|username|email|mobile'] = array(
                $condition,
                $condition,
                $condition,
                $condition,
                $condition,
                '_multi'=>true
            );
        }

        // 获取列表
        $map['user_type'] = $user_type;
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $user_object  = D('User/User');
        $base_table   = C('DB_PREFIX').'admin_user';
        $extend_table = C('DB_PREFIX').'user_'.strtolower($user_type_info['name']);
        $user_list = $user_object
                   ->page($p, 16)
                   ->where($map)
                   ->order('id desc')
                   ->join($extend_table.' ON '.$base_table.'.id = '.$extend_table.'.uid', 'LEFT')
                   ->select();
        $page = new Page(
            $user_object
            ->where($map)
            ->join($extend_table.' ON '.$base_table.'.id = '.$extend_table.'.uid', 'LEFT')
            ->count(),
            16
        );

        foreach ($user_list as &$val) {
            $val['gender_icon'] = $user_object->user_gender_icon($val['gender']);
        }

        $this->assign('page', $page->show());
        $this->assign('query_attribute', $query_attribute);
        $this->assign('meta_title', '用户');
        $this->assign('user_list', $user_list);
        $this->display();
    }

    /**
     * 用户个人主页
     *
     */
    public function home($uid) {
        $user_info = get_user_info($uid);

        // 关注信息
        $user_info['follow_status'] = D('User/Follow')->get_follow_status($uid);

        $user_type_info = D('User/Type')->find($user_info['user_type']);
        if ($user_info['status'] !== '1') {
            $this->error('该用户不存在或已禁用');
        }
        if ($user_type_info['home_template']) {
            $template = $user_type_info['home_template'];
        } else {
            $template = 'home';
        }
        $this->assign('meta_title', $user_info['username'].'的主页');
        $this->assign('user_info', $user_info);
        $this->display($template);
    }

    /**
     * 用户协议
     *
     */
    public function agreement() {
        $this->assign('meta_title', '用户协议');
        $this->display();
    }
}
