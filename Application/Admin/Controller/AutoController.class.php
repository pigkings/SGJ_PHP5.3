<?php
/**
 * Created by PhpStorm.
 * User: Answer
 * Date: 2016/7/30
 * Time: 12:00
 */

namespace Admin\Controller;


class AutoController extends AdminController
{
    /*开启自动开奖功能*/
    public function open()
    {
        mkdir(ROOT_PATH.'Public/game_run');
        if (is_dir(ROOT_PATH.'Public/game_run')){
            $this->success("自动开奖功能已开启",U('Index/index'));
        } else{
            $this->error("自动开奖功能开启异常",U('Index/index'));
        }
    }

    //关闭自动开奖功能
    public function close ()
    {
        if (rmdir(ROOT_PATH.'Public/game_run')){
            $this->success("自动开奖功能已关闭",U('Index/index'));
        } else {
            $this->error("自动开奖功能关闭异常",U('Index/index'));
        }
    }

    public function start()
    {
        if (rmdir(ROOT_PATH.'Public/game_pause')){
            $this->success("自动开奖已开始",U('Index/index'));
        } else {
            $this->error("自动开奖开始异常",U('Index/index'));
        }
    }

    public function pause()
    {
        @mkdir(ROOT_PATH.'Public/game_pause');
        if (is_dir(ROOT_PATH.'Public/game_pause')){
            $this->success("自动开奖已暂停",U('Index/index'));
        } else{
            $this->error("自动开奖暂停异常",U('Index/index'));
        }
    }
}