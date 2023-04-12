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
 * 分类控制器
 *
 */
class CategoryController extends HomeController {
    /**
     * 分类列表
     *
     */
    public function index($group = 1) {
        // 获取所有分类
        $map['status'] = array('eq', '1');  // 禁用和正常状态
        if (I('get.pid')) {
            $map['pid'] = array('eq', I('get.pid'));  // 父分类ID
        }
        $map['group'] = array('eq', $group);
        $data_list = D('Category')->field('id,pid,group,doc_type,title,url,icon,create_time,sort,status')
                                  ->where($map)->order('sort asc,id asc')->select();

        // 转换成树状列表
        $tree = new \Common\Util\Tree();
        $category_list = $tree->list_to_tree($data_list);

        $this->success('分类列表', ''. array('data' => $category_list));
    }

    /**
     * 分类详情
     *
     */
    public function detail($id) {
        $map['status'] = array('egt', 1);  // 正常、隐藏两种状态是可以访问的
        $info = D('Category')->where($map)->find($id);
        if(!$info){
            $this->error('您访问的分类已禁用或不存在');
        }
        if ($info['detail_template']) {
            $template = 'Index/'. $info['detail_template'];
        } else {
            $template = 'Index/detail_cate';
        }
        $this->assign('info', $info);
        $this->assign('__current_category__', $info['id']);
        $this->assign('meta_title', $info['title']);
        Cookie('__forward__', $_SERVER['REQUEST_URI']);
        $this->display($template);
    }
}
