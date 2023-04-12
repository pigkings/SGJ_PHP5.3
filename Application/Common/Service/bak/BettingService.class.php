<?php

namespace Common\Service;

class BettingService
{
	public static function checkBetHour()
	{
		$startHour = C('GUESS_START_TIME');
		$endHour = C('GUESS_END_TIME');
		$nowHour = date('H');
		if ($startHour == '' || $endHour == '') {
			return false;
		}
		if ($startHour <= 12 || 12 < $endHour && 12 < $startHour) {
			if ($startHour < $nowHour && $nowHour < $endHour) {
				return true;
			}
			return false;
		}
		if (12 < $startHour && $endHour < 12) {
			if ($startHour <= $nowHour || $nowHour < $endHour) {
				return true;
			}
			return false;
		}
		return false;
	}
	public static function bet($userId, $termId, $betData)
	{
		if (!is_array($betData)) {
			$return['status'] = false;
			$return['system_status'] = true;
			$return['msg'] = '投注参数异常';
			return $return;
		}
		$addData = array();
		$money = 0;
		foreach ($betData as $k => $v) {
			$toAdd['user_id'] = $userId;
			$toAdd['term_id'] = $termId;
			$toAdd['money'] = $v['money'];
			$toAdd['addtime'] = time();
			$toAdd['ip'] = get_client_ip();
			$toAdd['bet_num'] = $v['bet_num'];
			$toAdd['award_scale'] = getPeiLv($v['bet_num']);
			$toAdd['can_award_money'] = $v['money'] * $toAdd['award_scale'];
			$money += $v['money'];
			$addData[] = $toAdd;
		}
		$userAccount = get_user_account($userId);
		if ($userAccount['account'] <= 0 || $userAccount['account'] < $money) {
			$return['status'] = false;
			$return['system_status'] = true;
			$return['msg'] = '积分不足';
			return $return;
		}
		$betModel = M('log_betting');
		$betModel->startTrans();
		$addRs = $betModel->addAll($addData);
		$remark = '参与投注,竞猜期数' . $termId;
		$accountRs = AccountService::modifyAccount($userId, $money, AccountService::TYPE_ACCOUNT_BETTING, 2, $remark);
		$termModel = M('term');
		$termCondition['id'] = $termId;
		$termModel->where($termCondition)->setInc('all_bet', 1);
		$termModel->where($termCondition)->setInc('all_bet_money', $money);
		if ($addRs && $accountRs['status']) {
			$betModel->commit();
			$return['status'] = true;
			$return['system_status'] = true;
			$return['msg'] = '投注成功';
			return $return;
		}
		$betModel->rollback();
		$return['status'] = false;
		$return['system_status'] = false;
		$return['msg'] = '投注异常';
		return $return;
	}
	public static function checkOpenTime($termId)
	{
		$termInfo = M('term')->find($termId);
		if ($termInfo) {
			if ($termInfo['end_time'] <= time()) {
				return true;
			}
		}
		return false;
	}
	public static function lottery($termId)
	{
		if (!self::checkOpenTime($termId)) {
			$return['status'] = false;
			$return['system_status'] = true;
			$return['msg'] = '未到开奖时间';
			return $return;
		}
		$termInfo = M('term')->find($termId);
		$sliderModel = M('admin_slider');
		$betLogModel = M('log_betting');
		$baseNums = $sliderModel->field('hitnum')->where(array('hitnum' => array('elt', 6)))->select();
		$baseNum = array();
		foreach ($baseNums as $k => $v) {
			$baseNum[] = $v['hitnum'];
		}
		$toHitHum = 0;
		if ($termInfo['set_hit_num']) {
			$toHitHum = $termInfo['set_hit_num'];
		}
		if (!$toHitHum) {
			$condition['term_id'] = $termId;
			$betRs = $betLogModel->where($condition)->field('bet_num,sum(can_award_money) as money')->group('bet_num')->select();
			$allAwardMomey = 0;
			if (!empty($betRs)) {
				$moneyCount = array();
				$daAward = self::numAward($termId, 7) ?: 0;
				$xiaoAward = self::numAward($termId, 8) ?: 0;
				$danAward = self::numAward($termId, 9) ?: 0;
				$shuangAward = self::numAward($termId, 10) ?: 0;
				foreach ($betRs as $k => $v) {
					if ($v['bet_num'] < 7) {
						switch ($v['bet_num']) {
							case 1:
							case 3:
								$moneyCount[$v['bet_num']] = $v['money'] + $xiaoAward + $danAward;
								break;
							case 2:
								$moneyCount[$v['bet_num']] = $v['money'] + $xiaoAward + $shuangAward;
								break;
							case 4:
							case 6:
								$moneyCount[$v['bet_num']] = $v['money'] + $daAward + $shuangAward;
								break;
							case 5:
								$moneyCount[$v['bet_num']] = $v['money'] + $daAward + $danAward;
								break;
						}
					}
				}
				$allBetNums = array_keys($moneyCount);
				$unBetNums = array_diff($baseNum, $allBetNums);
				if (!empty($allBetNums) && !empty($unBetNums)) {
					$toHitHum = current($unBetNums);
				} else {
					$otherMoneyAward[1] = $xiaoAward + $danAward;
					$otherMoneyAward[2] = $xiaoAward + $shuangAward;
					$otherMoneyAward[3] = $daAward + $danAward;
					$otherMoneyAward[4] = $daAward + $shuangAward;
					$otherHitNum[1] = array('1', '3');
					$otherHitNum[2] = array('2');
					$otherHitNum[3] = array('5');
					$otherHitNum[4] = array('4', '6');
					asort($moneyCount);
					if (empty($moneyCount)) {
						asort($otherMoneyAward);
						$key = key($otherMoneyAward);
						shuffle($otherHitNum[$key]);
						$toHitHum = current($otherHitNum[$key]);
					} else {
						$allAwardMomey = current($moneyCount);
						$toHitHum = key($moneyCount);
					}
				}
			} else {
				$toHitHum = rand(1, 6);
			}
		}
		$nums = array();
		$nums[] = $toHitHum;
		if (3 < $toHitHum) {
			$nums[] = '7';
		} else {
			$nums[] = '8';
		}
		if ($toHitHum % 2 == 0) {
			$nums[] = '10';
		} else {
			$nums[] = '9';
		}
		$userBetCondition['bet_num'] = array('in', $nums);
		$userBetCondition['term_id'] = $termId;
		$userBet = $betLogModel->where($userBetCondition)->field('user_id,sum(can_award_money) as money,sum(money) as bet_money')->group('user_id')->select();
		$termModel = M('term');
		$termCondition['id'] = $termId;
		$termSaveData['hit_num'] = $toHitHum;
		$termSaveData['all_award'] = $allAwardMomey;
		$termSaveRs = $termModel->where($termCondition)->save($termSaveData);
		if ($termSaveRs !== false) {
			if (!empty($userBet)) {
				foreach ($userBet as $key => $bet) {
					$awardMoney = $bet['money'];
					$remark = '第' . $termId . '期开奖，中奖号码' . $toHitHum;
					$accountRs = AccountService::modifyAccount($bet['user_id'], $awardMoney, AccountService::TYPE_ACCOUNT_WIN, 1, $remark);
					$logWinModel = M('log_win');
					$addData['user_id'] = $bet['user_id'];
					$addData['bet_money'] = $bet['bet_money'];
					$addData['term_id'] = $termId;
					$addData['hit_num'] = $toHitHum;
					$addData['award_scale'] = getPeiLv($toHitHum);
					$addData['addtime'] = time();
					$addData['win_money'] = $bet['money'];
					$logWinModel->add($addData);
					if ($accountRs['status'] === false) {
						$termModel->rollback();
						$return['status'] = false;
						$return['system_status'] = true;
						$return['msg'] = '账户获取奖励异常';
						return $return;
					}
				}
			}
		} else {
			$termModel->rollback();
			$return['status'] = false;
			$return['system_status'] = false;
			$return['msg'] = '修改开奖失败';
			return $return;
		}
		$termModel->commit();
		$return['status'] = true;
		$return['system_status'] = true;
		$return['msg'] = '开奖成功';
		return $return;
	}
	public static function syncTerm()
	{
		if (TermService::termIsNull()) {
			return TermService::add();
		}
		$term = get_last_unopen_term();
		$return = self::lottery($term['id']);
		if ($return['status']) {
			return TermService::add();
		}
		return $return;
	}
	public static function numAward($termId, $num)
	{
		if (!$num) {
			return 0;
		}
		$logBetModel = M('log_betting');
		$condition['bet_num'] = $num;
		$condition['term_id'] = $termId;
		$award = $logBetModel->where($condition)->sum('can_award_money');
		return $award;
	}
}