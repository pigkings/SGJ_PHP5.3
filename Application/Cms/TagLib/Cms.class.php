<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Cms\TagLib;
use Think\Template\TagLib;
/**
 * 标签库
 *
 */
class Cms extends TagLib {
    /**
     * 定义标签列表
     *
     */
    protected $tags = array(
        'breadcrumb'    => array('attr' => 'name,cid', 'close' => 1), //面包屑导航列表
        'category_list' => array('attr' => 'name,pid,limit,page,group', 'close' => 1), //栏目分类列表
        'article_list'  => array('attr' => 'name,cid,limit,page,order,child', 'close' => 1), //文章列表
        'new_list'      => array('attr' => 'name,doc_type,limit,order', 'close' => 1), //最新文章列表
        'comment_list'  => array('attr' => 'name,data_id,limit,page,order', 'close' => 1), //评论列表
        'similar_list'  => array('attr' => 'name,tags,limit,order', 'close' => 1),  //相关列表
    );

    /**
     * 面包屑导航列表
     *
     */
    public function _breadcrumb($tag, $content) {
        $name   = $tag['name'];
        $cid    = $tag['cid'];
        $group  = $tag['group'] ? : 1;
        $parse  = '<?php ';
        $parse .= '$__PARENT_CATEGORY__ = D("Cms/Category\')->getParentCategory('.$cid.', '.$group.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__PARENT_CATEGORY__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 栏目分类列表
     *
     */
    public function _category_list($tag, $content) {
        $name   = $tag['name'];
        $pid    = $tag['pid'] ? : 0;
        $limit  = $tag['limit'] ? :10;
        $page   = $tag['page'] ? : 1;
        $group  = $tag['group'] ? : 1;
        $parse  = '<?php ';
        $parse .= '$__CATEGORYLIST__ = D("Cms/Category")->getCategoryTree('.$pid.', '.$limit.', '.$page.', '.$group.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__CATEGORYLIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 文章列表
     *
     */
    public function _article_list($tag, $content) {
        $name   = $tag['name'];
        $cid    = $tag['cid'] ? : 1;
        $limit  = $tag['limit'] ? : 10;
        $page   = $tag['page'] ? : 1;
        $order  = $tag['order'] ? : '';
        $child  = $tag['child'] ? : '';
        $parse  = '<?php ';
        $parse .= '$map = array("status" => "1");';
        $parse .= '$__ARTICLE_LIST__ = D("Cms/Index")->getList('.$cid.', '.$limit.', '.$page.', "'.$order.'", "'.$child.'", $map);';
        $parse .= ' ?>';
        $parse .= '<volist name="__ARTICLE_LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 最新文章列表
     *
     */
    public function _new_list($tag, $content) {
        $name   = $tag['name'];
        $doc_type = $tag['doc_type'];
        $limit  = $tag['limit'] ? : 10;
        $page   = $tag['page'] ? : 1;
        $order  = $tag['order'] ? : '';
        $parse  = '<?php ';
        $parse .= '$map = array("status" => "1");';
        $parse .= '$__ARTICLE_LIST__ = D("Cms/Index")->getNewList('.$doc_type.', '.$limit.', '.$page.', "'.$order.'", $map);';
        $parse .= ' ?>';
        $parse .= '<volist name="__ARTICLE_LIST__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 评论列表
     *
     */
    public function _comment_list($tag, $content) {
        $name    = $tag['name'];
        $data_id = $tag['data_id'];
        $limit   = $tag['limit'] ? : 10;
        $page    = $tag['page'] ? :1 ;
        $order   = $tag['order'] ? : 'sort desc,id asc';
        $parse   = '<?php ';
        $parse  .= '$__COMMENT_LIST__ = D("Cms/Comment")->getCommentList('.$data_id.', '.$limit.', '.$page.', "'.$order.'");';
        $parse  .= ' ?>';
        $parse  .= '<volist name="__COMMENT_LIST__" id="'. $name .'">';
        $parse  .= $content;
        $parse  .= '</volist>';
        return $parse;
    }

    /**
     * 相关列表
     *
     */
    public function _similar_list($tag, $content) {
        $name   = $tag['name'];
        $tags   = $tag['tags'];
        $limit  = $tag['limit'] ? : 4;
        $parse  = '<?php ';
        $parse .= '$__SIMILARLIST__ = D("Cms/Index")->getSimilar('.$tags.','.$limit.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__SIMILARLIST__" id="'.$name.'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }
}
