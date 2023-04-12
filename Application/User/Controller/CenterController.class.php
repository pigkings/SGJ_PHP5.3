<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Controller;
use Admin\Model\SliderModel;
use Common\Service\UserService;
use Home\Controller\HomeController;
use Common\Util\Think\Page;
/**
 * 用户中心控制器
 *
 */
class CenterController extends HomeController {
    /**
     * 初始化方法
     *
     */
    protected function _initialize(){
        parent::_initialize();
        $this->is_login();
    }
    /**
     * 我的推广链接
     */
    public function getQrcode(){
        vendor("phpqrcode.phpqrcode");
        $QRcode = new \QRcode();
        $code = I('code');
//        $data = 'http://'.$_SERVER['HTTP_HOST'].'/User/User/toregist/code/'.$code;
        $data = 'http://'.$_SERVER['HTTP_HOST'].U('User/User/toregist',array('code'=>$code));
//        $data = 'weixin://wxpay/bizpayurl?pr=pOKZyjD';
//        $data = I('data');
        // 纠错级别：L、M、Q、H
        $level = 'L';
        // 点的大小：1到10,用于手机端4就可以了
        $size = 4;
        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
        //$path = "images/";
        // 生成的文件名
        //$fileName = $path.$size.'.png';
        $QRcode->png($data, false, $level, $size);
    }

    /**
     * 用户个人中心
     *
     */
    public function index() {

        $uid  = $this->is_login();

        $user_info = get_user_info($uid);
        $user_type_info = D('Type')->find($user_info['user_type']);
        if ($user_type_info['center_template']) {
            $template = 'Center/' . $user_type_info['center_template'];
        }
        //----------获取后台的竞猜图片----------//
        $map['status'] = array('egt', '0');  // 禁用和正常状态
        $slider_object = new SliderModel();
        $slders = $slider_object
            ->where($map)
            ->order('sort desc,hitnum asc, id desc')
            ->select();
        $this->term_id = I('term_id');
        $this->sliders = $slders;

        $this->user_info = $user_info;
        $this->todayInfo = UserService::todayInfo($uid);

        $this->assign('meta_title', '个人中心');
        $this->display($template);
    }

    /**
     * 修改昵称
     *
     */
    public function nickname() {
        $uid  = $this->is_login();
        if (IS_POST) {
            if (I('post.nickname')) {
                $user_object = D('User/User');
                $result = $user_object->where(array('id' => $uid))
                        ->setField('nickname', I('post.nickname'));
                if ($result) {
                    $this->success('昵称修改成功');
                } else {
                    $this->error('昵称修改失败'.$user_object->getError());
                }
            } else {
                $this->error('请填写昵称');
            }
        } else {
            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('修改昵称')  // 设置页面标题
                    ->setPostUrl(U(''))        // 设置表单提交地址
                    ->addFormItem('nickname', 'text', '用户昵称')
                    ->setFormData(D('User/User')->detail($uid))
                    ->setTemplate(C('USER_CENTER_FORM'))
                    ->display();
        }
    }

    /**
     * 修改头像
     *
     */
    public function avatar() {
        $uid  = $this->is_login();
        if (IS_POST) {
            if ($_POST) {
                if (!$_POST['avatar']['src'] || !$_POST['avatar']['w'] || !$_POST['avatar']['h'] || $_POST['avatar']['x'] === '' || $_POST['avatar']['y'] === '') {
                    $this->error('参数不完整');
                }
                $result = D('Admin/Upload')->crop($_POST['avatar']);
                if ($result['error'] != 1) {
                    $user_object = D('User/User');
                    $result = $user_object->where(array('id' => $uid))->setField('avatar', $result['id']);
                    if ($result) {
                        $this->success('头像修改成功');
                    } else {
                        $this->error('头像修改失败'.$user_object->getError());
                    }
                } else {
                    $this->error('头像保存失败');
                }
            } else {
                $this->error('请选择文件');
            }
        } else {
            $this->assign('user_info', D('User/User')->detail($uid));
            $this->assign('meta_title', '修改头像');
            $this->display();
        }
    }

    /**
     * 修改密码
     *
     */
    public function password() {
        $uid  = $this->is_login();
        if (IS_POST) {
            $validate = array (
                array('password', 'require', '请填写旧密码', 1, 'regex'),
                array('newpassword', '6,30', '密码长度为6-30位', 1, 'length'),
                array('newpassword', '/(?!^(\d+|[a-zA-Z]+|[~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+)$)^[\w~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+$/', '密码至少由数字、字符、特殊字符三种中的两种组成', 1, 'regex'),
                array('repassword', 'newpassword', '两次输入的密码不一致', 1, 'confirm')
            );
            $user_object = D('User/User');
            $user_object->setProperty("_validate", $validate);
            $data = $user_object->create();
            if ($data) {
                $password = user_md5(I('password'));
                $newpassword = user_md5(I('newpassword'));
                if ($password === get_user_info($uid, 'password')) {
                    $result = $user_object->where(array('id' => $uid))
                            ->setField('password', $newpassword);
                    if ($result) {
                        $this->success('密码修改成功', U('User/User/logout'));
                    } else {
                        $this->error('密码修改失败'.$user_object->getError());
                    }
                } else {
                    $this->error('旧密码输入错误');
                }
            } else {
                    $this->error('错误：'.$user_object->getError());
            }
        } else {
            // 使用FormBuilder快速建立表单页面。
            $this->display();
        }
    }

    /**
     * 用户修改信息
     *
     */
    public function profile() {
        if (IS_POST) {
            // 强制设置用户ID
            $uid = $this->is_login();
            $_POST['uid'] = $uid;
            $_POST = format_data();

            // 获取用户信息
            $user_object = D('User/User');
            $user_info = $user_object->find($uid);

            // 保存昵称
            if (I('post.nickname')) {
                $result = $user_object->where(array('id' => $uid))->setField('nickname', I('post.nickname'));
                if ($result === false) {
                    $this->error('昵称修改失败'.$user_object->getError());
                }
            } else {
                $this->error('请填写昵称');
            }

            // 保存扩展信息
            $type = $user_info['user_type'];
            $map['user_type'] = array('eq', $type);
            $count = D('User/Attribute')->where($map)->count();
            if ($count) {
                $user_type_name = D('User/Type')->where(array('id' => $user_info['user_type']))->getField('name');
                $user_extend_object = D('User'.ucfirst($user_type_name));
                $extend_data = $user_extend_object->create();
                if (!$extend_data) {
                    $this->error($user_extend_object->getError());
                }
                $extend_info = $user_extend_object->find($uid);
                if ($extend_info) {
                    $result = $user_extend_object->save($extend_data);
                } else {
                    $result = $user_extend_object->add($extend_data);
                }
                if ($result === false) {
                    $this->error('扩展信息修改失败'.$user_extend_object->getError());
                } else {
                    $this->success('信息修改成功');
                }
            }
        } else {
            // 获取当前用户
            $user_object = D('User/User');
            $user_info = $user_object->detail($this->is_login());
            $type = $user_info['user_type'];
            $user_type_info = D('User/Type')->find($type);

            // 获取扩展字段
            $map['user_type'] = array('eq', $type);
            $attribute_list[$type] = D('User/Attribute')->where($map)->order('id asc')->select();

            // 解析字段options
            $new_attribute_list_sort['user']['type'] = 'group';
            if ($attribute_list[$type]) {
                // 增加昵称表单
                $nick['name']  = 'nickname';
                $nick['title'] = '昵称';
                $nick['type']  = 'text';
                $nick['value']  = $user_info['nickname'];
                $new_attribute_list[1][0] = $nick;
                foreach ($attribute_list[$type] as $attr) {
                    $attr['options'] = parse_attr($attr['options']);
                    $new_attribute_list[$type][$attr['id']] = $attr;
                    $new_attribute_list[$type][$attr['id']]['value'] = $user_info[$attr['name']];
                }
                $new_attribute_list_sort['user']['options']['group_extend']['title'] = '完善'.$user_type_info['title'].'信息';
                $new_attribute_list_sort['user']['options']['group_extend']['options'] = $new_attribute_list[$type];
            }

            // 使用FormBuilder快速建立表单页面。
            $builder = new \Common\Builder\FormBuilder();
            $builder->setMetaTitle('修改信息')  // 设置页面标题
                    ->setPostUrl(U(''))        // 设置表单提交地址
                    ->setExtraItems($new_attribute_list_sort)
                    ->setTemplate(C('USER_CENTER_FORM'))
                    ->display();
        }
    }

    /**
     * 生成推广码
     *
     */
    public function invitecode() {
        $uid  = $this->is_login();
        $user_info = get_user_info($uid);
        $this->user_info = $user_info;
        $this->assign('meta_title', '代理推广');
        $this->display('invitecode');

    }

    /**
     * 推广明细信息
     *
     */
    public function invitelist() {
        $uid  = $this->is_login();
        $list = getChildByPid($uid);
        foreach($list as $k=>$v){
            $item = getChildByPid($v['id']);
            foreach($item as $m=>$n){
                $item_three = getChildByPid($n['id']);
                $item[$m]['item'] = $item_three;
            }
            $list[$k]['item'] = $item;
        }
        $this->list = $list;
        $this->assign('meta_title', '邀请记录');
        $this->display('invitelist');

    }

    public function extendRechargeList()
    {
        $ids = UserService::getExtendUserIds($this->is_login());
        $list = "";
        if ($ids){
            $rechargeModel = M('log_recharge');
            $rechargeMap['is_award'] = 1;
            $rechargeMap['user_id'] = array('in',$ids);
            $list = $rechargeModel->where($rechargeMap)->order('addtime desc')->page($_GET['p'].',10')->select();
            $count = $rechargeModel->where($rechargeMap)->count();
            $page = new Page($count,10);
            $this->page = $page->show();
        }
        $this->list = $list;
        $this->display();

    }





}
