<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Admin;
use Admin\Controller\AdminController;
use Common\Util\Think\Page;
/**
 * 默认控制器
 *
 */
class IndexAdmin extends AdminController {
    /**
     * 默认方法
     *
     */
    public function index() {
        //计算统计图日期
        $today = strtotime(date('Y-m-d', time())); //今天
        $start_date = I('get.start_date') ? strtotime(I('get.start_date')) : $today-14*86400;
        $end_date   = I('get.end_date') ? (strtotime(I('get.end_date'))+1) : $today+86400;
        $count_day  = ($end_date-$start_date)/86400; //查询最近n天
        $user_object = D('User');
        for($i = 0; $i < $count_day; $i++){
            $day = $start_date + $i*86400; //第n天日期
            $day_after = $start_date + ($i+1)*86400; //第n+1天日期
            $map['create_time'] = array(
                array('egt', $day),
                array('lt', $day_after)
            );
            $user_reg_date[] = date('m月d日', $day);
            $user_reg_count[] = (int)$user_object->where($map)->count();
        }

        $this->assign('start_date', date('Y-m-d', $start_date));
        $this->assign('end_date', date('Y-m-d', $end_date-1));
        $this->assign('count_day', $count_day);
        $this->assign('user_reg_date', json_encode($user_reg_date));
        $this->assign('user_reg_count', json_encode($user_reg_count));
        $this->assign('meta_title', "用户");
        $this->display();
    }
}
