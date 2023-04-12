<?php

namespace Common\Service;

class WithdrawService
{
	const WITHDRAW_STATUS_APPLY = 1;
	const WITHDRAW_STATUS_SUCCESS = 3;
	const WITHDRAW_STATUS_DENY = 2;
	public static function apply($userId, $money, $type, $accountNumber, $remark = NULL)
	{
		$withdrawModel = M('log_withdraw');
		$addData['user_id'] = $userId;
		$addData['money'] = $money;
		$addData['addtime'] = time();
		$addData['remark'] = $remark;
		$addData['apply_ip'] = get_client_ip();
		$addData['type'] = $type;
		$addData['account_number'] = $accountNumber;
		$addData['status'] = self::WITHDRAW_STATUS_APPLY;
		$addData['user_remark'] = $remark;
		$withdrawModel->startTrans();
		$withdrawRs = $withdrawModel->add($addData);
		$remark = '兑换申请';
		$logRs = AccountService::modifyAccount($userId, $money, AccountService::TYPE_ACCOUNT_WITHDRAW_APPLY, 2, $remark);
		if ($withdrawRs && $logRs['status']) {
			$withdrawModel->commit();
			$return['status'] = true;
			$return['system_status'] = true;
			$return['msg'] = '积分兑换已经提交申请，请等待处理';
			return $return;
		}
		$withdrawModel->rollback();
		$return['status'] = false;
		$return['system_status'] = false;
		$return['msg'] = '积分兑换申请异常';
		return $return;
	}
	public static function process($id, $userId, $status, $opRemark = NULL)
	{
		$withdrawModel = M('log_withdraw');
		$condition['id'] = $id;
		$condition['user_id'] = $userId;
		$withdrawInfo = $withdrawModel->where($condition)->find();
		if (!$withdrawInfo) {
			$return['status'] = false;
			$return['system_status'] = false;
			$return['msg'] = '查询提现记录异常';
			return $return;
		}
		$saveData['updatetime'] = time();
		$saveData['op_remark'] = $opRemark;
		$saveData['op_ip'] = get_client_ip();
		$saveData['status'] = $status;
		$adminInfo = get_admin_info();
		$saveData['admin_id'] = $adminInfo['uid'];
		$withdrawModel->startTrans();
		$opRs = $withdrawModel->where($condition)->save($saveData);
		switch ($status) {
			case self::WITHDRAW_STATUS_DENY:
				$remark = '积分兑换申请驳回';
				$logRs = AccountService::modifyAccount($userId, $withdrawInfo['money'], AccountService::TYPE_ACCOUNT_WITHDRAW_DENY, 1, $remark);
				break;
			case self::WITHDRAW_STATUS_SUCCESS:
				$remark = '积分兑换成功';
				$logRs = AccountService::modifyAccount($userId, $withdrawInfo['money'], AccountService::TYPE_ACCOUNT_WITHDRAW_SUCCESS, 2, $remark);
				break;
			default:
				$return['status'] = false;
				$return['system_status'] = false;
				$return['msg'] = '参数传递异常';
				return $return;
		}
		if ($opRs && $logRs['status']) {
			$withdrawModel->commit();
			$return['status'] = true;
			$return['system_status'] = true;
			$return['msg'] = '提现处理成功';
			return $return;
		}
		$return['status'] = false;
		$return['system_status'] = false;
		$return['msg'] = '提现处理异常';
		return $return;
	}
}