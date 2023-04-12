<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Home\Controller;
use Common\Service\BettingService;
use Think\Controller;
/**
 * 前台默认控制器
 *
 */
class IndexController extends HomeController {
    /**
     * 默认方法
     *
     */
    public function index() {
        BettingService::syncTerm();
        $url = U('Home/Auto/index');
        $post['auth'] = "gussgame";
        sock_post($url,$post);
        /*获取往期开奖结果*/
        $termModel = M('term');
        $condition['hit_num'] = array("exp","is not null");
        $start_time = strtotime(date("Y-m-d"));
        $end_time =  strtotime("+1 day");
        $condition['start_time'] = array(
            array('egt',$start_time),
            array('elt',$end_time)
        );

        $termList = $termModel->where($condition)->order('start_time desc')->limit(30)->select();
        $this->termList = $termList;

        $this->randuser = getRanduser(15);
        $this->sliderlist = getSlider(6);
        Cookie('__forward__', C('HOME_PAGE'));
        $this->assign('meta_title', "首页");
        $this->display();
    }

    /**
     * 单页类型
     *
     */
    public function page($id) {
        $nav_object = D('Admin/Nav');
        $con['id']     = $id;
        $con['status'] = 1;
        $info = $nav_object->where($con)->find();

        Cookie('__forward__', C('HOME_PAGE'));
        $this->assign('info', $info);
        $this->assign('meta_title', $info['title']);
        $this->display();
    }

    public function getTime()
    {
        $data['time'] = time();
        exit(json_encode($data));
    }

    public function rule()
    {
        $this->display();
    }

}
