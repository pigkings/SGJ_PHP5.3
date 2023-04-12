<?php

namespace Common\Service;

class UserService
{
	public static function getExtendUserIds($uid)
	{
		if (!$uid) {
			return null;
		}
		$userModel = M('admin_user');
		$condition['invite_path'] = array('like', ',' . $uid . ',');
		$rs = $userModel->where($condition)->field('id')->select();
		$ids = array();
		foreach ($rs as $k => $v) {
			$ids[] = $v['id'];
		}
		return $ids;
	}
	public static function getRegistAward($uid)
	{
		if (!$uid) {
			$return['status'] = false;
			$return['msg'] = '没有指定用户ID';
			return $return;
		}
		$award = (int) C('GUESS_REGIST_AWARD');
		if ($award <= 0) {
			$return['status'] = false;
			$return['msg'] = '后台奖励参数值设置异常';
			return $return;
		}
		$return = AccountService::modifyAccount($uid, $award, AccountService::TYPE_REGIST_AWARD, 1, '注册赠送积分');
		return $return;
	}
	public static function todayInfo($userId)
	{
		$start_time = strtotime(date('Y-m-d'));
		$end_time = strtotime(date('Y-m-d', strtotime('+1 day')));
		$betModel = M('log_betting');
		$condition['user_id'] = $userId;
		$condition['addtime'] = array(array('egt', $start_time), array('elt', $end_time));
		$allBet = $betModel->where($condition)->sum('money');
		$awardModel = M('log_win');
		$allAward = $awardModel->where($condition)->sum('win_money');
		$return['bet_money'] = $allBet ?: 0;
		$return['award_money'] = $allAward ?: 0;
		return $return;
	}
}