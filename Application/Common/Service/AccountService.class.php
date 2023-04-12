<?php

namespace Common\Service;

class AccountService
{
	const TYPE_ACCOUNT_RECHARGE = 1;
	const TYPE_ACCOUNT_WITHDRAW_APPLY = 2;
	const TYPE_ACCOUNT_BETTING = 3;
	const TYPE_ACCOUNT_WIN = 4;
	const TYPE_ACCOUNT_BACKEND = 5;
	const TYPE_ACCOUNT_WITHDRAW_DENY = 6;
	const TYPE_ACCOUNT_WITHDRAW_SUCCESS = 7;
	const TPPE_ACCOUNT_EXTEND_AWARD = 8;
	const TYPE_REGIST_AWARD = 9;
	public static function initUserAccount($user_id)
	{
		if ($user_id == '') {
			$return['status'] = false;
			$return['system_status'] = true;
			$return['msg'] = '用户ID为空';
			return $return;
		}
		$accountModel = M('user_account');
		$addData['user_id'] = $user_id;
		$addRs = $accountModel->add($addData);
		if ($addRs === false) {
			$return['status'] = false;
			$return['system_status'] = false;
			$return['msg'] = '初始化账户异常';
			return $return;
		}
		if ($addRs) {
			$return['status'] = true;
			$return['system_status'] = true;
			$return['msg'] = '账户初始化成功';
			return $return;
		}
	}
	public static function getUserAccountInfo($userId)
	{
		$accountModel = M('user_account');
		$condition['user_id'] = $userId;
		$accountRs = $accountModel->where($condition)->find();
		if ($accountRs) {
			$return['status'] = true;
			$return['sys_status'] = true;
			$return['msg'] = '获取用户帐号成功';
			$return['data'] = $accountRs;
			return $return;
		}
		$return['status'] = false;
		$return['sys_status'] = false;
		$return['msg'] = '获取用户帐号成功';
		$return['data'] = $accountRs;
		return $return;
	}
	public static function modifyAccount($userId, $money, $type, $isplus, $remark, $adminId = NULL)
	{
		$accountModel = M('user_account');
		$condition['user_id'] = $userId;
		$accountRs = self::getUserAccountInfo($userId);
		if ($accountRs['status'] === false) {
			$return['status'] = false;
			$return['sys_status'] = true;
			$return['msg'] = '用户帐号信息获取异常';
			return $return;
		}
		switch ($type) {
			case self::TYPE_ACCOUNT_RECHARGE:
			case self::TPPE_ACCOUNT_EXTEND_AWARD:
			case self::TYPE_REGIST_AWARD:
				$saveData['account'] = $accountRs['data']['account'] + $money;
				break;
			case self::TYPE_ACCOUNT_WITHDRAW_APPLY:
				$saveData['account'] = $accountRs['data']['account'] - $money;
				$saveData['frozen_account'] = $accountRs['data']['frozen_account'] + $money;
				break;
			case self::TYPE_ACCOUNT_BETTING:
				$saveData['account'] = $accountRs['data']['account'] - $money;
				$saveData['total_betting'] = $accountRs['data']['total_betting'] + $money;
				break;
			case self::TYPE_ACCOUNT_WIN:
				$saveData['account'] = $accountRs['data']['account'] + $money;
				$saveData['total_win'] = $accountRs['data']['total_win'] + $money;
				break;
			case self::TYPE_ACCOUNT_BACKEND:
				if ($isplus == 1) {
					$saveData['account'] = $accountRs['data']['account'] + $money;
				} else {
					$saveData['account'] = $accountRs['data']['account'] - $money;
				}
				break;
			case self::TYPE_ACCOUNT_WITHDRAW_DENY:
				$saveData['account'] = $accountRs['data']['account'] + $money;
				$saveData['frozen_account'] = $accountRs['data']['frozen_account'] - $money;
				break;
			case self::TYPE_ACCOUNT_WITHDRAW_SUCCESS:
				$saveData['frozen_account'] = $accountRs['data']['frozen_account'] - $money;
				break;
			default:
				$return['status'] = false;
				$return['sys_status'] = true;
				$return['msg'] = '操作类型参数传递异常';
				return $return;
		}
		$accountModel->startTrans();
		$accountModRs = $accountModel->where($condition)->save($saveData);
		$accountLogRs = self::accountLog($userId, $money, $type, $isplus, $remark, $accountRs, $adminId);
		if ($accountModRs && $accountLogRs['status']) {
			$accountModel->commit();
			$return['status'] = true;
			$return['sys_status'] = true;
			$return['msg'] = '资金操作成功';
			return $return;
		}
		$accountModel->rollback();
		$return['status'] = false;
		$return['sys_status'] = false;
		$return['msg'] = '资金操作异常';
		return $return;
	}
	public static function accountLog($userId, $money, $type, $isplus, $remark, $accountRs, $adminId = NULL)
	{
		$addData['user_id'] = $userId;
		$addData['money'] = $money;
		$addData['isplus'] = $isplus;
		$addData['adminid'] = $adminId;
		$addData['addtime'] = time();
		$addData['remark'] = $remark;
		$accountRes = $accountRs;
		if (!$accountRs['data']) {
			$return['status'] = false;
			$return['sys_status'] = true;
			$return['msg'] = '用户帐号信息获取异常';
			return $return;
		}
		switch ($type) {
			case self::TYPE_ACCOUNT_RECHARGE:
			case self::TPPE_ACCOUNT_EXTEND_AWARD:
			case self::TYPE_REGIST_AWARD:
				$addData['account_new'] = $accountRes['data']['account'] + $money;
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'] + $money;
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'];
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'];
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'];
				$addData['total_betting_new'] = $accountRes['data']['total_betting'];
				break;
			case self::TYPE_ACCOUNT_WITHDRAW_APPLY:
				$addData['account_new'] = $accountRes['data']['account'] - $money;
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'];
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'];
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'];
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'] + $money;
				$addData['total_betting_new'] = $accountRes['data']['total_betting'];
				break;
			case self::TYPE_ACCOUNT_BETTING:
				$addData['account_new'] = $accountRes['data']['account'] - $money;
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'];
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'];
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'];
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'];
				$addData['total_betting_new'] = $accountRes['data']['total_betting'] + $money;
				break;
			case self::TYPE_ACCOUNT_WIN:
				$addData['account_new'] = $accountRes['data']['account'] + $money;
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'];
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'];
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'] + $money;
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'];
				$addData['total_betting_new'] = $accountRes['data']['total_betting'];
				break;
			case self::TYPE_ACCOUNT_BACKEND:
				if ($isplus == 1) {
					$addData['account_new'] = $accountRes['data']['account'] + $money;
				} else {
					$addData['account_new'] = $accountRes['data']['account'] - $money;
				}
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'];
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'];
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'] + $money;
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'];
				$addData['total_betting_new'] = $accountRes['data']['total_betting'];
				break;
			case self::TYPE_ACCOUNT_WITHDRAW_DENY:
				$addData['account_new'] = $accountRes['data']['account'] + $money;
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'];
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'];
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'];
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'] - $money;
				$addData['total_betting_new'] = $accountRes['data']['total_betting'];
				break;
			case self::TYPE_ACCOUNT_WITHDRAW_SUCCESS:
				$addData['account_new'] = $accountRes['data']['account'];
				$addData['total_recharge_new'] = $accountRes['data']['total_recharge'];
				$addData['total_withdraw_new'] = $accountRes['data']['total_withdraw'] + $money;
				$addData['total_award_new'] = $accountRes['data']['total_award'];
				$addData['total_win_new'] = $accountRes['data']['total_win'];
				$addData['frozen_account_new'] = $accountRes['data']['frozen_account'] - $money;
				$addData['total_betting_new'] = $accountRes['data']['total_betting'];
				break;
			default:
				$return['status'] = false;
				$return['sys_status'] = true;
				$return['msg'] = '操作类型参数传递异常';
				return $return;
		}
		$addData['type'] = $type;
		$addData['account_old'] = $accountRes['data']['account'];
		$addData['total_recharge_old'] = $accountRes['data']['total_recharge'];
		$addData['total_recharge_old'] = $accountRes['data']['total_recharge'];
		$addData['total_withdraw_old'] = $accountRes['data']['total_withdraw'];
		$addData['total_award_old'] = $accountRes['data']['total_award'];
		$addData['total_win_old'] = $accountRes['data']['total_win'];
		$addData['total_betting_old'] = $accountRes['data']['total_betting'];
		$addData['frozen_account_old'] = $accountRes['data']['frozen_account'];
		$logModel = M('log_account');
		$addRs = $logModel->add($addData);
		if ($addRs) {
			$return['status'] = true;
			$return['sys_status'] = true;
			$return['msg'] = '资金记录添加成功';
			return $return;
		}
		$return['status'] = false;
		$return['sys_status'] = false;
		$return['msg'] = '资金记录添加异常';
		return $return;
	}
}