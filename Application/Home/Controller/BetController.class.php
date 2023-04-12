<?php
/**
 * Created by PhpStorm.
 * User: Answer
 * Date: 2016/7/26
 * Time: 15:51
 */

namespace Home\Controller;


use Admin\Model\SliderModel;
use Common\Service\AccountService;
use Common\Service\BettingService;
use Common\Util\Think\Page;

class BetController extends HomeController
{
    /**
     * 初始化方法
     *
     */
    protected function _initialize(){
        parent::_initialize();
        $this->is_login();
    }

    /**
     * @deprecated
     */
    public function bet()
    {
        /*获取最后一期信息*/
        $termInfo = get_last_unopen_term();
        $limitTime = C('GUESS_CLOSE_BETTING');
        $offsetTime = $termInfo['end_time'] - time();
        if ($offsetTime < $limitTime){
            $this->error("开奖结果结算中....");
        }
        //--------获取最近投注记录------------//
        $accountModel = M('log_betting');
        $uid = $this->is_login();
        $condition['user_id'] = $uid;
        $count = $accountModel->where($condition)->count();
        $page = new Page($count,10);
        $list = $accountModel->where($condition)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
        $this->list = $list;
        $this->page = $page->show();

        //----------获取后台的竞猜图片----------//
        $map['status'] = array('egt', '0');  // 禁用和正常状态
        $slider_object = new SliderModel();
        $slders = $slider_object
            ->where($map)
            ->order('sort desc,id desc')
            ->select();
        $this->term_id = I('term_id');
        $this->sliders = $slders;
        $this->display();
    }

    /**
     * 参数投注 添加投注信息
     */
    public function doBet()
    {
        if(!BettingService::checkBetHour()){
            $this->error("该时间不允许投注");
        }
        $termId = I('term_id');
        //------------获取该期信息-------------//
        $termInfo = M('term')->find($termId);
        if (!$termInfo){
            $this->error("该期信息异常");
            return false;
        }
        if ($termInfo['hit_num']){
            $this->error("该期已经开奖");
        }
        $uid = $this->is_login();
        $betData = I('betdata');
        $betData = array_filter(I('betdata'));
        $toBetData = array();
        foreach ($betData as $key=>$v){
            $array['money'] = $v;
            $array['bet_num'] = $key;
            $toBetData[] = $array;
        }

        if (empty($betData)){
            $this->error("请先进行投注");
        }
        $betRs = BettingService::bet($uid,$termId,$toBetData);
        if ($betRs['status']){
            $this->success($betRs['msg'],U('User/Center/index'));
            exit;
        } else{
            $this->error($betRs['msg']);
        }


    }



    
}