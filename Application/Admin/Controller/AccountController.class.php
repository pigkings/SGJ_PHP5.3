<?php


namespace Admin\Controller;


use Common\Util\Think\Page;

class AccountController extends AdminController
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
        $map['type'] = array('egt', '0'); // 禁用和正常状态
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $rechargeModel = M('log_account');
        $data_list = $rechargeModel
            ->page($p , C('ADMIN_PAGE_ROWS'))
            ->where($map)
            ->order('addtime desc')
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

            ->addTableColumn('money', '数量')
            ->addTableColumn('account_old', '操作前')
            ->addTableColumn('account_new', '操作后')
            ->addTableColumn('remark', '操作说明')
            ->addTableColumn('addtime', '申请时间', 'time')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($data_list)    // 数据列表
            ->setTableDataPage($page->show()) // 数据列表分页
//            ->addRightButton('edit')          // 添加编辑按钮
//            ->addRightButton('forbid')        // 添加禁用/启用按钮
            ->addRightButton('delete')        // 添加删除按钮
            ->display();
    }
}