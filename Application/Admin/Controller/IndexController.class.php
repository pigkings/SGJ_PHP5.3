<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Controller;
/**
 * 后台默认控制器

 */
class IndexController extends AdminController {
    /**
     * 默认方法

     */
    public function index(){
        $this->assign('meta_title', "首页");
        $this->display();
    }

    /**
     * 删除缓存

     */
    public function removeRuntime() {
        $file = new \Common\Util\File();
        $result = $file->del_dir(RUNTIME_PATH);
        if ($result) {
            $this->success("缓存清理成功");
        } else {
            $this->error("缓存清理失败");
        }
    }
}
