<?php

namespace User\Controller;


use Common\Service\WithdrawService;
use Common\Util\Think\Page;

class WithdrawController extends UserController
{
    /**
     * 初始化方法
     *
     */
    protected function _initialize()
    {
        parent::_initialize();
        $this->is_login();
    }

    public function index()
    {
        $rechargeModel = M('log_withdraw');
        $uid = $this->is_login();
        $condition['user_id'] = $uid;
        $count = $rechargeModel->where($condition)->count();
        $page = new Page($count, 10);
        $list = $rechargeModel->where($condition)->order('addtime desc,updatetime desc')->limit($page->firstRow . ',' . $page->listRows)->select();
        $this->list = $list;
        $this->page = $page->show();

        $this->display();
    }

    public function add()
    {
        if (IS_POST) {
            self::doAdd();
        } else {
            self::toAdd();
        }
    }

    private function toAdd()
    {
        $uid = $this->is_login();
        $this->uid = $uid;
        $this->assign('meta_title', '积分兑换');
        $this->display();
    }

    private function doAdd()
    {
        // 强制设置用户ID
        $uid = $this->is_login();
        $userAccount = get_user_account($uid);
        $_POST = format_data();
        $money = $_POST['money'];
        $tixianLimit = C('GUESS_TIXIAN_LIMIT');
        if ($money < $tixianLimit){
            $return['info'] = "最小提现金额{$tixianLimit}";
            $return['status'] = 0;
            $return['url'] = "";
            $this->ajaxReturn($return);
        }
        if ($money > $userAccount['account']) {
            $return['info'] = "积分数量不足{$money}";
            $return['status'] = 0;
            $return['url'] = "";
            $this->ajaxReturn($return);
        }
        $userRemark = I('user_remark');
        if ($_POST['money'] <= 0) {
            $return['info'] = "请正确填写兑换数量";
            $return['status'] = 0;
            $return['url'] = "";
            $this->ajaxReturn($return);
        }
        $type = I('type');
        $accountNumber = I('account_number');
        if (!$accountNumber) {
            $return['info'] = "请填写收款帐号";
            $return['status'] = 0;
            $return['url'] = "";
            $this->ajaxReturn($return);
        }
        $type = I('type');
        $addrs = WithdrawService::apply($uid, $money, $type, $accountNumber, $userRemark);
        if ($addrs['status']) {
            $return['info'] = $addrs['msg'];
            $return['status'] = 1;
            $return['url'] = U('User/Center/index');
            $this->ajaxReturn($return);
        }
    }
}