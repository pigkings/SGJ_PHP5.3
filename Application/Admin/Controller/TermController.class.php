<?php


namespace Admin\Controller;


use Common\Util\Think\Page;

class TermController extends AdminController
{
    public function index()
    {
        // 搜索
        $keyword   = I('keyword', '', 'string');
        if ($keyword){
            $userConditon['id|username|nickname'] = $keyword;
            $userRs = M('admin_user')->where($userConditon)->find();

        }
        if ($userRs){
            $map['user_id'] = $userRs['id'];
        }
        // 获取所有用户

        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $rechargeModel = M('term');
        $data_list = $rechargeModel
            ->page($p , C('ADMIN_PAGE_ROWS'))
            ->where($map)
            ->order('start_time desc')
            ->select();

        $page = new Page(
            $rechargeModel->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );
        $this->list = $data_list;
        $this->page = $page->show();
        $this->display();
    }

    public function betInfo()
    {
        $term_id = I('term_id');
        //--------获取该期信息----------//
        $termInfo = M('term')->find($term_id);
        if (!$termInfo){
            $this->error("查询奖期异常");
            return false;
        }
        $this->termInfo = $termInfo;
        /*查询投注记录*/
        $betModel = M('log_betting');
        $betCondition['term_id'] = $term_id;
        $betList = $betModel->where($betCondition)->order('addtime desc')->page($_GET['p'].',.C("ADMIN_PAGE_ROWS").')->select();
        $count = $betModel->where($betCondition)->count();
        $page = new Page($count,C("ADMIN_PAGE_ROWS"));
        $this->page = $page->show();
        $this->betList = $betList;

        /*计算所有号码的赔钱情况*/
        $awardList = $betModel->where($betCondition)->field('bet_num,sum(can_award_money) as money')->group('bet_num')->select();
        asort($awardList);
        $this->termId = $term_id;
        $this->awardList = $awardList;

        //----------获取所有号码----//
        $sliderModel = M('admin_slider');
        $hitNums = $sliderModel->field('hitnum')->where('hitnum <7')->select();
        $this->hitnums = $hitNums;

        $this->display();

    }

    /**
     * 设置开奖号码
     */
    public function setHitNum()
    {
        $termId = I('term_id');
        $hitNum = I('num');
        $termModel = M('term');
        $termInfo = $termModel->find($termId);
        if (!$termInfo){
            $this->error("查询信息异常");
        }
        if ($termInfo['hit_num']){
            $this->error("该期已经开奖");
        }
        $save['id'] = $termId;
        $save['set_hit_num'] = $hitNum;
        $saveRs = $termModel->save($save);
        if ($saveRs === false){
            $this->error("开奖号码设置失败");
        } else {
            $this->success("开奖号码已设定");
        }
    }
}