<?php
/**
 * Created by PhpStorm.
 * User: Answer
 * Date: 2016/8/9
 * Time: 14:54
 */

namespace Admin\Controller;


use Common\Service\AccountService;
use Common\Util\Think\Page;

class ScoreController extends AdminController
{
    public function add ()
    {
        $this->redirect('/Admin/Score/index');
    }

    public function index()
    {
        // 搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword){
            $map['user_id'] = $keyword;
        }
        $map['id'] = array('gt',0);

        // 获取所有分类
        $p = $_GET["p"] ? : 1;

        $accountModel = M('user_account');
        $data_list = $accountModel
            ->page($p, C('ADMIN_PAGE_ROWS'))
            ->where($map)
            ->order('id desc')
            ->select();
        if (!empty($data_list)){
            foreach($data_list as $k=>$v){
                if ($v['user_id']){
                    $data_list[$k]['username'] = get_user_info($v['user_id'],'username');
                }
            }
        }
        $page = new Page(
            $accountModel->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );
        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('幻灯列表')  // 设置页面标题
        ->addTopButton('addnew')    // 添加新增按钮
        ->setSearch('请输入用户ID或者期数ID', U('index'))
            ->addTableColumn('id', 'ID')
            ->addTableColumn('user_id', '用户ID')
            ->addTableColumn('username', '用户名')
            ->addTableColumn('account', '账户余额')
            ->addTableColumn('frozen_account', '冻结金额')
            ->addTableColumn('total_recharge', '总充值金额')
            ->addTableColumn('total_withdraw', '总提现金额')
            ->addTableColumn('total_award', '总收益')
            ->addTableColumn('total_win', '总赢取金额')
            ->addTableColumn('total_betting', '总投注金额')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($data_list)     // 数据列表
            ->setTableDataPage($page->show())  // 数据列表分页
            ->addRightButton('edit')           // 添加编辑按钮

            ->display();

    }

    public function edit()
    {
        if (IS_POST){
            $userId  = I('user_id');
            if(!$userId){
                $this->error("参数异常");
            }
            $money =(int) I('money');
            if ($money <= 0){
                $this->error("操作金额错误");
            }
            $isPlus = I('is_plus');
            if ($isPlus !=1 && $isPlus !=2){
                $this->error("请选择操作方式");
            }
            $remrak = I('remark');
            if (!$remrak){
                $this->error("操作备注不能为空");
            }
            $rs = AccountService::modifyAccount($userId,$money,AccountService::TYPE_ACCOUNT_BACKEND,$isPlus,$remrak);
            if ($rs['status']){
                $this->success("操作成功");
                return true;
            }
            $this->error("操作失败");
        } else{
            $id = I('id');
            $accountRs = M('user_account')->find($id);
            if (!$accountRs){
                $this->error("查询用户账户异常");
                return false;
            }
            $accountRs['user_name'] = get_user_info($accountRs['user_id'],'user_name');
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('修改用户积分')  // 设置页面标题
            ->setPostUrl(U('edit'))    // 设置表单提交地址
            ->addFormItem('id', 'hidden', 'ID', 'ID')
            ->addFormItem('user_id', 'hidden', 'user_id', 'user_id')
                ->addFormItem('user_id', 'hidden', 'user_id', 'user_id')
                ->addFormItem('account', 'text', '余额', '充值数量')
                ->addFormItem('money', 'text', '金额', '操作金额')
                ->addFormItem('is_plus', 'radio', '状态', '金额操作方法', array('1' => '增加', '2' => '减少'))
                ->addFormItem('remark', 'textarea', '操作备注')
                ->setFormData($accountRs)
                ->display();

        }
    }
}