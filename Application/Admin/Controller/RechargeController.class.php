<?php
/**
 * Created by PhpStorm.
 * User: Answer
 * Date: 2016/7/26
 * Time: 9:32
 */

namespace Admin\Controller;


use Common\Service\RechageService;
use Common\Util\Think\Page;

class RechargeController extends AdminController
{
    public function index()
    {
        // 搜索
        $keyword   = I('keyword', '', 'string');
        if ($keyword){
            $userConditon['id|username|nickname'] = $keyword;
            $userRs = M('admin_user')->where($userConditon)->find();

        }
        if ($userRs){
            $map['user_id'] = $userRs['id'];
        }
        // 获取所有用户
        $map['status'] = array('egt', '0'); // 禁用和正常状态
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $rechargeModel = M('log_recharge');
        $data_list = $rechargeModel
            ->page($p , C('ADMIN_PAGE_ROWS'))
            ->where($map)
            ->order('addtime desc,updatetime desc')
            ->select();
        foreach ($data_list as $k=>$v){
            $userInfo = get_user_info($v['user_id'],'username');
            $data_list[$k]['username'] = $userInfo;
        }

        $page = new Page(
            $rechargeModel->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('充值列表') // 设置页面标题
//        ->addTopButton('addnew')  // 添加新增按钮
//        ->addTopButton('resume')  // 添加启用按钮
//        ->addTopButton('forbid')  // 添加禁用按钮
        ->addTopButton('delete')  // 添加删除按钮
        ->setSearch('请输入ID/用户名', U('index'))
            ->addTableColumn('id', 'ID')
            ->addTableColumn('username', '申请人')

            ->addTableColumn('money', '金额')

            ->addTableColumn('addtime', '申请时间', 'time')
            ->addTableColumn('water_number', '交易流水号')
            ->addTableColumn('status', '状态', 'callback','getRechargeStatus')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($data_list)    // 数据列表
            ->setTableDataPage($page->show()) // 数据列表分页
            ->addRightButton('edit')          // 添加编辑按钮
//            ->addRightButton('forbid')        // 添加禁用/启用按钮
            ->addRightButton('delete')        // 添加删除按钮
            ->display();
    }

    public function edit($id)
    {
        if (IS_POST) {
            $id = I('id');
            $userId = I('user_id');
            $adminRemark = I('op_remark');
            $status = I('status');

            $opRs = RechageService::progress($id,$userId,$status,$adminRemark);
            if ($opRs['status']){
                $this->success('更新成功', U('index'));
            } else {
                $this->error('更新失败', $opRs['msg']);
            }
        } else {
            // 获取账号信息
            $info = M('log_recharge')->find($id);
            unset($info['password']);

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('处理充值')  // 设置页面标题
            ->setPostUrl(U('edit'))    // 设置表单提交地址
            ->addFormItem('id', 'hidden', 'ID', 'ID')
            ->addFormItem('user_id', 'hidden', 'user_id', 'user_id')
                ->addFormItem('money', 'text', '金额', '充值数量')
                ->addFormItem('status', 'radio', '状态', '充值处理状态', array('1' => '申请中', '2' => '驳回申请','3'=>'充值成功'))
                ->addFormItem('user_remark', 'textarea', '申请备注')
                ->addFormItem('water_number','text', '交易流水号')
                ->addFormItem('op_remark', 'textarea', '处理信息', '处理信息')
                ->setFormData($info)
                ->display();
        }
    }
}