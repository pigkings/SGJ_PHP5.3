<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
/**
 * 系统升级控制器

 */
class UpdateController extends AdminController{
    /**
     * 初始化方法

     */
    protected function _initialize(){
        //只有ID为1的超级管理员才有权限系统更新
        if(session('user_auth.uid') !== '1'){
            $this->success('');
        }
    }

    /**
     * 检查新版本

     */
    public function checkVersion(){
        $result['status'] = 1;
        $this->ajaxReturn($result);
    }
}
