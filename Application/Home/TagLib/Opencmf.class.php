<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Home\TagLib;
use Think\Template\TagLib;
/**
 * 标签库
 *
 */
class Opencmf extends TagLib {
    /**
     * 定义标签列表
     *
     */
    protected $tags = array(
        'sql_query'   => array('attr' => 'sql,result', 'close' => 0),             //SQL查询
        'nav_list'    => array('attr' => 'name,pid,group', 'close' => 1),         //导航列表
        'slider_list' => array('attr' => 'name,limit,page,order', 'close' => 1),  //幻灯列表
    );

    /**
     * SQL查询
     */
    public function _sql_query($tag, $content) {
        $sql    =    $tag['sql'];
        $result =    !empty($tag['result']) ? $tag['result'] : 'result';
        $parse  =    '<?php $'.$result.' = M()->query("'.$sql.'");';
        $parse .=    'if($'.$result.'):?>'.$content;
        $parse .=    "<?php endif;?>";
        return $parse;
    }

    /**
     * 导航列表
     */
    public function _nav_list($tag, $content) {
        $name   = $tag['name'];
        $pid    = $tag['pid'] ? : 0;
        $group  = $tag['group'] ? : 'main';
        $parse  = '<?php ';
        $parse .= '$__nav_list__ = D(\'Admin/Nav\')->getNavTree('.$pid.', '.$group.');';
        $parse .= ' ?>';
        $parse .= '<volist name="__nav_list__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }

    /**
     * 幻灯列表
     *
     */
    public function _slider_list($tag, $content) {
        $name   = $tag['name'];
        $limit  = $tag['limit'] ? : 10;
        $page   = $tag['page'] ? : 1;
        $order  = $tag['order'] ? : 'sort desc,id desc';
        $parse  = '<?php ';
        $parse .= '$map["status"] = array("eq", "1");';
        $parse .= '$__slider_list__ = D("Admin/slider")->getList('.$limit.', '.$page.', "'.$order.'", $map);';
        $parse .= ' ?>';
        $parse .= '<volist name="__slider_list__" id="'. $name .'">';
        $parse .= $content;
        $parse .= '</volist>';
        return $parse;
    }
}
