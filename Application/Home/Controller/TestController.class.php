<?php
/**
 * Created by PhpStorm.
 * User: Answer
 * Date: 2016/7/24
 * Time: 11:10
 */

namespace Home\Controller;


use Common\Service\AccountService;
use Common\Service\BettingService;
use Common\Service\RechageService;
use Common\Service\TermService;
use Common\Service\UserService;

class TestController
{
    public function index()
    {
//        dump(UserService::todayInfo(2));
//        RechageService::grantExtendAward(20);
//        dump(BettingService::syncTerm());
//        BettingService::checkBetHour();
//        dump(get_hit_num_img(1));
//        dump(get_last_term());exit;
        dump(BettingService::lottery(1498));
//        dump(TermService::add());
//        AccountService::initUserAccount(2);
    }
}