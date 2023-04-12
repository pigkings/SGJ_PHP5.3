<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Home\Controller;
use Common\Controller\CommonController;
/**
 * 前台公共控制器
 * 为防止多分组Controller名称冲突，公共Controller名称统一使用模块名
 *
 */
class HomeController extends CommonController {
    /**
     * 初始化方法
     *
     */
    protected function _initialize() {
        // 系统开关
        if (!C('TOGGLE_WEB_SITE')) {
            $this->error('站点已经关闭，请稍后访问~');
        }

        // 监听行为扩展
        \Think\Hook::listen('corethink_behavior');
    }

    /**
     * 用户登录检测
     *
     */
    protected function is_login() {
        //用户登录检测
        $uid = is_login();
        if ($uid) {
            return $uid;
        } else {
            $this->error('请先登录系统', U('User/User/login'), array('login' => 1));
        }
    }

    /**
     * 用户VIP权限检测
     *
     */
    protected function is_vip($level = 1) {
        if (is_dir('./Application/Vip/')) {
            $vip = is_vip();
            $vip_info = D('Vip/Index')->find($vip);
            if ($vip && $vip_info['type_info']['level'] >= $level) {
                return $vip;
            } else {
                $con['status'] = 1;
                $con['level']  = $level;
                $need_vip_info = D('Vip/Type')->where($con)->find();
                $this->error('请先开通' . $need_vip_info['title'] . 'VIP', U('Vip/Index/index'));
            }
        }
    }

    /**
     * 设置一条或者多条数据的状态
     * @param $script 严格模式要求处理的纪录的uid等于当前登陆用户UID
     *
     */
    public function setStatus($model = CONTROLLER_NAME, $script = true) {
        $ids    = I('request.ids');
        $status = I('request.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        $model_primary_key = D($model)->getPk();
        $map[$model_primary_key] = array('in',$ids);
        if ($script) {
            $map['uid'] = array('eq', is_login());
        }
        switch ($status) {
            case 'forbid' :  // 禁用条目
                $data = array('status' => 0);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'禁用成功','error'=>'禁用失败')
                );
                break;
            case 'resume' :  // 启用条目
                $data = array('status' => 1);
                $map  = array_merge(array('status' => 0), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'启用成功','error'=>'启用失败')
                );
                break;
            case 'recycle' :  // 移动至回收站
                $data['status'] = -1;
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'成功移至回收站','error'=>'删除失败')
                );
                break;
            case 'restore' :  // 从回收站还原
                $data = array('status' => 1);
                $map  = array_merge(array('status' => -1), $map);
                $this->editRow(
                    $model,
                    $data,
                    $map,
                    array('success'=>'恢复成功','error'=>'恢复失败')
                );
                break;
            case 'delete'  :  // 删除条目
                $result = D($model)->where($map)->delete();
                if ($result) {
                    $this->success('删除成功，不可恢复！');
                } else {
                    $this->error('删除失败');
                }
                break;
            default :
                $this->error('参数错误');
                break;
        }
    }

    /**
     * 对数据表中的单行或多行记录执行修改 GET参数id为数字或逗号分隔的数字
     * @param string $model 模型名称,供M函数使用的参数
     * @param array  $data  修改的数据
     * @param array  $map   查询时的where()方法的参数
     * @param array  $msg   执行正确和错误的消息
     *                       array(
     *                           'success' => '',
     *                           'error'   => '',
     *                           'url'     => '',   // url为跳转页面
     *                           'ajax'    => false //是否ajax(数字则为倒数计时)
     *                       )
     *
     */
    final protected function editRow($model, $data, $map, $msg) {
        $id = array_unique((array)I('id',0));
        $id = is_array($id) ? implode(',',$id) : $id;
        //如存在id字段，则加入该条件
        $fields = D($model)->getDbFields();
        if (in_array('id', $fields) && !empty($id)) {
            $where = array_merge(
                array('id' => array('in', $id )),
                (array)$where
            );
        }
        $msg = array_merge(
            array(
                'success' => '操作成功！',
                'error'   => '操作失败！',
                'url'     => ' ',
                'ajax'    => IS_AJAX
            ),
            (array)$msg
        );
        $result = D($model)->where($map)->save($data);
        if ($result != false) {
            $this->success($msg['success'], $msg['url'], $msg['ajax']);
        } else {
            $this->error($msg['error'], $msg['url'], $msg['ajax']);
        }
    }
}
