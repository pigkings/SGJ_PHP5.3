<?php

namespace User\Controller;

use Common\Util\Think\Page;

class BetController extends UserController
{
    /**
     * 初始化方法
     *
     */
    protected function _initialize(){
        parent::_initialize();
        $this->is_login();
    }

    public function index()
    {
        $accountModel = M('log_betting');
        $uid = $this->is_login();
        $condition['user_id'] = $uid;
        $count = $accountModel->where($condition)->count();
        $page = new Page($count,10);
        $list = $accountModel->where($condition)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
        foreach ($list as &$v) {
            $hit_num =M('Term')->where(array('id'=>$v['term_id']))->getField('hit_num');
            if($hit_num==null){
                    $v['award'] ="<span style='color:grey;'>等待开奖</span>";
            }elseif($hit_num == $v['bet_num']){
                    $v['award'] ="<span style='color:red;'>中奖</span>";
            }else{
                    $v['award'] ="<span style='color:green;'>未中奖</span>";
            }


           if($hit_num!=null){
	           	if($hit_num>3){
	           		$r = 'big';
	           }else{
	           		$r = 'min';
	           }

	           switch ($v['bet_num']) {
	            	case 7:
	            		if($r=='big'){
	            			$v['award'] ="<span style='color:red;'>中奖</span>";
	            		}
	            		break;
	            	case 8:
	            		if($r=='min'){
	            			$v['award'] ="<span style='color:red;'>中奖</span>";
	            		}
	            		break;
	            	case 9:
	            		if($hit_num/2!=0){
	            			$v['award'] ="<span style='color:red;'>中奖</span>";
	            		}
	            		break;
	            	case 10:
	            		if($hit_num/2==0){
	            			$v['award'] ="<span style='color:red;'>中奖</span>";
	            		}
	            		break;
	            	default:
	            		# code...
	            		break;
	            }
           }


        }

        $this->list = $list;
        $this->page = $page->show();
        $this->display();
    }
}