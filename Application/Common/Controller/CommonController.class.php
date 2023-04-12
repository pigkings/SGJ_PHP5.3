<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Common\Controller;
use Think\Controller;
/**
 * 公共控制器
 *
 */
class CommonController extends Controller {
    /**
     * 模板显示 调用内置的模板引擎显示方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     * @param string $content 输出内容
     * @param string $prefix 模板缓存前缀
     * @return void
     */
    protected function display($template = '', $charset = '', $contentType = '', $content = '', $prefix = '') {

        if (!is_file($template)) {
            $depr = C('TMPL_FILE_DEPR');
            if ('' == $template) {
                // 如果模板文件名为空 按照默认规则定位
                $template = CONTROLLER_NAME . $depr . ACTION_NAME;
            } elseif (false === strpos($template, $depr)) {
                $template = CONTROLLER_NAME . $depr . $template;
            }
        } else {
            $file = $template;
        }

        // 获取所有模块配置的用户导航
        $mod_con['status'] = 1;
        $_user_nav_main = array();
        $_user_nav_list = D('Admin/Module')->where($mod_con)->getField('user_nav', true);
        foreach ($_user_nav_list as $key => $val) {
            if ($val) {
                $val = json_decode($val, true);
                if ($val['main']) {
                    $_user_nav_main = array_merge($_user_nav_main, $val['main']);
                }
            }
        }

        $this->assign('meta_keywords', C('WEB_SITE_KEYWORD'));
        $this->assign('meta_description', C('WEB_SITE_DESCRIPTION'));
        $this->assign('_new_message', cookie('_new_message'));          // 获取用户未读消息数量
        $this->assign('_user_auth', session('user_auth'));              // 用户登录信息
        $this->assign('_user_nav_main', $_user_nav_main);               // 用户导航信息
        $this->assign('_user_center_side', C('USER_CENTER_SIDE'));      // 用户中心侧边
        $this->assign('_user_login_modal', C('USER_LOGIN_MODAL'));      // 用户登录弹窗
        $this->assign('_admin_public_layout', C('ADMIN_PUBLIC_LAYOUT')); // 页面公共继承模版
        $this->assign('_home_public_layout', C('HOME_PUBLIC_LAYOUT'));  // 页面公共继承模版
        $this->assign('_user_layout', C('USER_CENTER_BASE'));  // 页面公共继承模版
        $this->assign('_listbuilder_layout', C('LISTBUILDER_LAYOUT'));  // ListBuilder继承模版
        $this->assign('_formbuilder_layout', C('FORMBUILDER_LAYOUT'));  // FormBuilder继承模版
        $this->assign('_page_name', strtolower(MODULE_NAME . '_' . CONTROLLER_NAME . '_' . ACTION_NAME));

        if (IS_AJAX) {
            $this->success('数据获取成功', '', array('data' => $this->view->get(), 'html' => $this->fetch($template)));
        } else {
            $this->view->display($template);
        }
    }
}
