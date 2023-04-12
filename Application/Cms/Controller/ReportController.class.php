<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Cms\Controller;
use Home\Controller\HomeController;
use Common\Util\Think\Page;
/**
 * 举报控制器
 *
 */
class ReportController extends HomeController {
    /**
     * 默认方法
     *
     */
    public function index($data_id) {
        if (IS_POST) {
            $report_object = D('Cms/Report');
            $data = $report_object->create();
            if ($data) {
                $result = $report_object->add($data);
                if ($result) {
                    $this->success('您的举报提交成功，请您耐心等待！');
                } else {
                    $this->error($report_object->getError());
                }
            } else {
                $this->error($report_object->getError());
            }
        } else {
            Cookie('__forward__', $_SERVER['REQUEST_URI']);
            $this->assign('info', D('Cms/Index')->detail($data_id));
            $this->assign('reason_list', D('Cms/Report')->reason_list());
            $this->assign('meta_title', '举报页面');
            $this->display($template);
        }
    }
}