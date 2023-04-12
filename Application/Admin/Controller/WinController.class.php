<?php


namespace Admin\Controller;

use Common\Util\Think\Page;
class WinController extends AdminController
{
    public function index()
    {
        // 搜索
        $keyword = I('keyword', '', 'string');
        if ($keyword){
            $map['user_id|term_id'] = $keyword;
        }
        $map['id'] = array('gt',0);
        // 获取所有分类
        $p = $_GET["p"] ? : 1;

        $betLogModel = M('log_win');
        $data_list = $betLogModel
            ->page($p, C('ADMIN_PAGE_ROWS'))
            ->where($map)
            ->order('addtime desc')
            ->select();
        if (!empty($data_list)){
            foreach($data_list as $k=>$v){
                if ($v['user_id']){
                    $data_list[$k]['username'] = get_user_info($v['user_id'],'username');
                }
            }
        }
        $page = new Page(
            $betLogModel->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );
        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('中奖列表')  // 设置页面标题
        ->addTopButton('delete')    // 添加新增按钮
        ->setSearch('请输入用户ID或者期数ID', U('index'))
            ->addTableColumn('id', 'ID')
            ->addTableColumn('user_id', '用户ID')
            ->addTableColumn('username', '用户名')
            ->addTableColumn('term_id', '投注期数')
            ->addTableColumn('hit_num', '中奖数字')
            ->addTableColumn('award_scale', '中奖赔率')
            ->addTableColumn('bet_money', '投资金额')
            ->addTableColumn('win_money', '奖励金额')
            ->addTableColumn('addtime', '投注时间', 'time')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($data_list)     // 数据列表
            ->setTableDataPage($page->show())  // 数据列表分页
            ->addRightButton('delete')           // 添加编辑按钮

            ->display();
    }
}