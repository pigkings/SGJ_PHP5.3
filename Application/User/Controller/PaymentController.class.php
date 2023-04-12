<?php
namespace User\Controller;
use Home\Controller\HomeController;
use Common\Service\RechageService;
class PaymentController extends HomeController {
	//数据以post方式
	public function yunpay_notify() {
		$payment = new \Lib\Payment\Yunpay();

		//对进入的参数进行远程数据判断
		$verify = $payment->notify_verify();

		if ($verify) {
			$where['status'] =1;
			$where['water_number'] =$_REQUEST['out_order_no'];

			$order = M('log_recharge')->where($where)->find();
			if ($order) {
				$this->order_pay($order);
			}
		}
		echo 'success';
	}

	public function yunpay_return() {
		header("content-type: text/html; charset=utf-8");
		$payment = new \Lib\Payment\Yunpay();

		//对进入的参数进行远程数据判断
		$verify = $payment->return_verify();

		if ($verify) {
			$where['water_number'] =$_REQUEST['out_order_no'];
			$order = M('log_recharge')->where($where)->find();
			if ($order['status'] ==1) {
				$this->order_pay($order);
				$this->success('支付成功', U('User/Center/index'));
			}elseif($order['status'] ==3){
				$this->success('支付成功', U('User/Center/index'));
			} else {
				die('订单不存在');
			}

		} else {
			die('支付失败');
		}
	}

	private function order_pay($order){
	            $id = $order['id'];
	            $userId = $order['user_id'];
	            $adminRemark = "支付成功";
	            $status = 3;
	            $opRs = RechageService::progress($id,$userId,$status,$adminRemark);
	}
}