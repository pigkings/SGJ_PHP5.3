<?php

namespace Common\Service;

class TermService
{
	public static function add()
	{
		$lastTime = C('GUESS_OPEN_CYCLE');
		if ($lastTime <= 0) {
			$return['status'] = false;
			$return['sys_status'] = false;
			$return['msg'] = '开奖周期时间设置异常';
			return $return;
		}
		$termModel = M('term');
		$addData['start_time'] = time();
		$addData['end_time'] = time() + $lastTime * 60;
		$addRs = $termModel->add($addData);
		if ($addRs) {
			$return['status'] = true;
			$return['sys_status'] = true;
			$return['msg'] = '成功开启下一期';
			return $return;
		}
		$return['status'] = false;
		$return['sys_status'] = false;
		$return['msg'] = '开启下一期异常';
		return $return;
	}
	public static function termIsNull()
	{
		$termModel = M('term');
		$count = $termModel->count();
		$count = (int) $count;
		if ($count === 0) {
			return true;
		}
		return false;
	}
}