<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Common\Util\Think\Page;
use Think\Controller;
use Think\Storage;
/**
 * 后台上传控制器

 */
class UploadController extends AdminController {
    /**
     * 上传列表

     */
    public function index() {
        //搜索
        $keyword = I('keyword', '', 'string');
        $condition = array('like','%'.$keyword.'%');
        $map['id|path'] = array($condition, $condition,'_multi'=>true);

        //获取所有上传
        $map['status'] = array('egt', '0'); //禁用和正常状态
        $p = !empty($_GET["p"]) ? $_GET['p'] : 1;
        $upload_object = D('Upload');
        $data_list = $upload_object
                   ->page($p, C('ADMIN_PAGE_ROWS'))
                   ->where($map)
                   ->order('sort desc,id desc')
                   ->select();
        $page = new Page(
            $upload_object->where($map)->count(),
            C('ADMIN_PAGE_ROWS')
        );

        foreach ($data_list as &$data) {
            $data['name'] = cut_str($data['name'], 0, 30)
                          .'<input class="form-control input-sm" value="'
                          .$data['path'].'">';
        }

        // 使用Builder快速建立列表页面。
        $builder = new \Common\Builder\ListBuilder();
        $builder->setMetaTitle('上传列表')  // 设置页面标题
                ->addTopButton('resume')   // 添加启用按钮
                ->addTopButton('forbid')   // 添加禁用按钮
                ->addTopButton('delete')   // 添加删除按钮
                ->setSearch('请输入ID/上传关键字', U('index'))
                ->addTableColumn('id', 'ID')
                ->addTableColumn('show', '文件')
                ->addTableColumn('name', '文件名及路径')
                ->addTableColumn('size', '大小', 'byte')
                ->addTableColumn('create_time', '创建时间', 'time')
                ->addTableColumn('sort', '排序')
                ->addTableColumn('status', '状态', 'status')
                ->addTableColumn('right_button', '操作', 'btn')
                ->setTableDataList($data_list)     // 数据列表
                ->setTableDataPage($page->show())  // 数据列表分页
                ->addRightButton('forbid')         // 添加禁用/启用按钮
                ->addRightButton('delete')         // 添加删除按钮
                ->display();
    }

    /**
     * 设置一条或者多条数据的状态

     */
    public function setStatus($model = CONTROLLER_NAME) {
        $ids    = I('request.ids');
        $status = I('request.status');
        if (empty($ids)) {
            $this->error('请选择要操作的数据');
        }
        switch ($status) {
            case 'delete' :  // 删除条目
                if (!is_array($ids)) {
                    $id_list[0] = $ids;
                } else {
                    $id_list = $ids;
                }
                foreach ($id_list as $id) {
                    $upload_info = D('Upload')->find($id);
                    if ($upload_info) {
                        $realpath = realpath('.'.$upload_info['path']);
                        if ($realpath) {
                            array_map("unlink", glob($realpath));
                            if (count(glob($realpath))) {
                                $this->error('删除失败！');
                            } else {
                                $resut = D('Upload')->delete($id);
                                $this->success('删除成功！');
                            }
                        } else {
                            $resut = D('Upload')->delete($id);
                            $this->success('删除成功！');
                        }
                    }
                }
                break;
            default :
                parent::setStatus($model);
                break;
        }
    }

    /**
     * 上传

     */
    public function upload() {
        exit(json_encode(D('Upload')->upload()));
    }

    /**
     * 下载

     */
    public function download($token) {
        if (empty($token)) {
            $this->error('token参数错误！');
        }

        //解密下载token
        $file_md5 = \Think\Crypt::decrypt($token, user_md5(is_login()));
        if (!$file_md5) {
            $this->error('下载链接已过期，请刷新页面！');
        }

        $upload_object = D('Upload');
        $file_id = $upload_object->getFieldByMd5($file_md5, 'id');
        if (!$upload_object->download($file_id)) {
            $this->error($upload_object->getError());
        }
    }

    /**
     * KindEditor编辑器文件管理

     */
    public function fileManager() {
        exit(D('Upload')->fileManager());
    }
}
