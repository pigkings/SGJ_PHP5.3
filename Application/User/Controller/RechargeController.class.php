<?php
/**
 * Created by PhpStorm.
 * User: Answer
 * Date: 2016/7/25
 * Time: 17:07
 */

namespace User\Controller;

use Common\Service\RechageService;
use Common\Util\Think\Page;

class RechargeController extends UserController
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

    /**
     * 用户中心充值记录列表
     */
    public function index()
    {
        $rechargeModel = M('log_recharge');
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
        $this->weixinImg = get_upload_info(C('GUESS_WEIXIN_IMG'), 'path');
        $this->aliImg = get_upload_info(C('GUESS_ALI_IMG'), 'path');
        $this->assign('meta_title', '积分充值');
        $this->display();
    }

    private function doAdd()
    {
        // 强制设置用户ID
        $uid = $this->is_login();

        $_POST = format_data();
        $money = I('money');
        $userRemark = I('user_remark');
        $waterNumber = I('water_number');
        if ($waterNumber == '') {
            $return['info'] = "交易流水号不能为空";
            $return['status'] = 0;
            $return['url'] = "";
            $this->ajaxReturn($return);
        }
        if ($_POST['money'] <= 0) {
            $return['info'] = "请正确填写充值数量";
            $return['status'] = 0;
            $return['url'] = "";
            $this->ajaxReturn($return);
        }
        $type = I('type');

        $addrs = RechageService::apply($uid, $money, $type, $waterNumber, $userRemark);
        if ($addrs['status']) {
            $return['info'] = $addrs['msg'];
            $return['status'] = 1;
            $return['url'] = U('User/Center/index');
            $this->ajaxReturn($return);
        }

    }

    public function pay(){

        if ( !($uid = $this->is_login()) ) {
            $this->error( '您还没有登陆',U('User/login') );
        }


            $money = intval(I('get.money'));
            if($money < 1){
                $this->error('请输入正确的积分');
            }
            $order = array();
            $order['money'] = $money;
            $order['user_id'] = $uid;
            $order['status'] = 1;
            $order['addtime'] = time();
            $order['water_number'] = create_out_trade_no();

            $order['id'] = M('log_recharge')->data($order)->add();

            $order['subject'] = '积分充值'.$money;
            $order['notify_url'] = "http://www.cshw007.cn". U('User/Payment/yunpay_notify');
            $order['return_url'] = "http://www.cshw007.cn". U('User/Payment/yunpay_return');

            $payment = new \Lib\Payment\Yunpay($order);
            $this->assign('pay_online', $payment->get_code());
        $this->display();
    }








}