<?php

namespace Common\Service;

class RechageService
{
	public static function apply($userId, $money, $type, $waterNumber, $remark = NULL)
	{
		$rechargeModel = M('log_recharge');
		$addData['user_id'] = $userId;
		$addData['money'] = $money;
		$addData['addtime'] = time();
		$addData['type'] = $type;
		$addData['apply_ip'] = get_client_ip();
		$addData['user_remark'] = $remark;
		$addData['water_number'] = $waterNumber;
		$addData['status'] = 1;
		$rechargeRs = $rechargeModel->add($addData);
		if ($rechargeRs) {
			$return['status'] = true;
			$return['system_status'] = true;
			$return['msg'] = '充值已经提交申请，请等待处理';
			return $return;
		}
		$return['status'] = false;
		$return['system_status'] = false;
		$return['msg'] = '充值提交异常';
		return $return;
	}
	public static function progress($id, $userId, $status, $opRemark = NULL)
	{
		$rechargeModel = M('log_recharge');
		$condition['id'] = $id;
		$condition['user_id'] = $userId;
		$withdrawInfo = $rechargeModel->where($condition)->find();
		if (!$withdrawInfo) {
			$return['status'] = false;
			$return['system_status'] = false;
			$return['msg'] = '查询提现记录异常';
			return $return;
		}
		if ($withdrawInfo['status'] != 1) {
			$return['status'] = false;
			$return['system_status'] = false;
			$return['msg'] = '该记录已经处理，请勿重复处理';
			return $return;
		}
		$saveData['updatetime'] = time();
		$saveData['op_ip'] = get_client_ip();
		$saveData['status'] = $status;
		$adminInfo = get_admin_info();
		$saveData['admin_id'] = $adminInfo['uid'];
		$saveData['op_remark'] = $opRemark;
		$rechargeModel->startTrans();
		$opRs = $rechargeModel->where($condition)->save($saveData);
		switch ($status) {
			case 2:
				$logRs = true;
				break;
			case 3:
				$remark = '充值成功';
				$logRs = AccountService::modifyAccount($userId, $withdrawInfo['money'], AccountService::TYPE_ACCOUNT_RECHARGE, 1, $remark);
				self::grantExtendAward($id);
				break;
			default:
				$return['status'] = false;
				$return['system_status'] = false;
				$return['msg'] = '参数传递异常';
				return $return;
		}
		if ($opRs && $logRs['status']) {
			$rechargeModel->commit();
			$return['status'] = true;
			$return['system_status'] = true;
			$return['msg'] = '充值处理成功';
			return $return;
		}
		$return['status'] = false;
		$return['system_status'] = false;
		$return['msg'] = '提现处理异常';
		return $return;
	}
	public static function grantExtendAward($rechargeLogId)
	{
		$rechargeModel = M('log_recharge');
		$rechargeRs = $rechargeModel->find($rechargeLogId);
		if ($rechargeRs['is_award'] != 1) {
			$userModel = M('admin_user');
			$userRs = $userModel->find($rechargeRs['user_id']);
			if ($userRs['invite_id']) {
				$firstLevelUserId = $userRs['invite_id'];
				$return = self::grantExtendAwardByLevel($firstLevelUserId, $rechargeRs['money'], 1);
				$userRs = $userModel->find($firstLevelUserId);
				if ($userRs['invite_id']) {
					$secondLevelUserId = $userRs['invite_id'];
					self::grantExtendAwardByLevel($secondLevelUserId, $rechargeRs['money'], 2);
				}
			}
			$saveData['id'] = $rechargeLogId;
			$saveData['is_award'] = 1;
			$rechargeModel->save($saveData);
		}
	}
	private static function grantExtendAwardByLevel($userId, $rechargeMoney, $level)
	{
		$awardMoney = 0;
		if ($level == 1) {
			$levelAwardScale = C('GUESS_FIRST_LEVEL_AWARD');
			$awardMoney = $rechargeMoney * $levelAwardScale / 100;
			$awardMoney = round($awardMoney, 2);
		} else {
			if ($level == 2) {
				$levelAwardScale = C('GUESS_SECOND_LEVEL_AWARD');
				$awardMoney = $rechargeMoney * $levelAwardScale / 100;
				$awardMoney = round($awardMoney, 2);
			}
		}
		$remark = '推广用户获得奖励';
		if ($awardMoney) {
			return AccountService::modifyAccount($userId, $awardMoney, AccountService::TPPE_ACCOUNT_EXTEND_AWARD, 1, $remark);
		}
		return false;
	}
}