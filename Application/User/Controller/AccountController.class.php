<?php


namespace User\Controller;


//use Think\Page;
use Common\Util\Think\Page;

class AccountController extends UserController
{
    /**
     * 初始化方法
     *
     */
    protected function _initialize(){
        parent::_initialize();
        $this->is_login();
    }
    public function index()
    {
        $accountModel = M('log_account');
        $uid = $this->is_login();
        $condition['user_id'] = $uid;
        $count = $accountModel->where($condition)->count();
        $page = new Page($count,10);
        $list = $accountModel->where($condition)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->list = $list;
        $this->page = $page->show();
        $this->display();
    }
}