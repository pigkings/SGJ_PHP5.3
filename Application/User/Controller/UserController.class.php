<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Controller;
use Common\Service\AccountService;
use Common\Service\UserService;
use Home\Controller\HomeController;
/**
 * 用户控制器
 *
 */
class UserController extends HomeController {
    /**
     * 登陆
     *
     */
    public function login() {

        if (IS_POST) {
            $account = I('username');
            $password = I('password');
            $code = I('verify');
            if (!$account) {
                $this->error('请输入账号！');
            }
            if (!$password) {
                $this->error('请输入密码！');
            }
            if (!$this->check_verify(I('post.verify'))) {
                $this->error('验证码输入错误！');
            }
            $user_object = D('User/User');
            $uid = $user_object->login($account, $password);
            if ($uid) {
                $this->success('登录成功！',U('User/Center/index'));
            } else {
                $this->error($user_object->getError());
            }
        } else {
            if (is_login()) {
                $this->redirect('User/Center/index');
            }
            $this->assign('meta_title', '用户登录');
            $this->display();
        }
    }

    /**
     * 注销
     *
     */
    public function logout() {
        session('user_auth', null);
        session('user_auth_sign', null);
        $this->success('退出成功！', U('Home/index/index'));
    }

    public function toregist()
    {
        if (is_login()){
            redirect(U('User/Center/index'));
        }
        $code = I('code');
        if ($code){
            $this->code = $code;
        }
        $this->display();
    }

    /**
     * 用户注册
     *
     */
    public function register() {
        if (IS_POST) {
            if (!C('user_config.reg_toggle')) {
                $this->error('注册已关闭！');
            }
            $reg_type = I('post.reg_type');
            if (!in_array($reg_type, C('user_config.allow_reg_type'))) {
                $this->error('该注册方式已关闭，请选择其它方式注册！');
            }
            $reg_data = array();
            switch ($reg_type) {
                case 'username': //用户名注册
                    //图片验证码校验
                    if (!$this->check_verify(I('post.verify'))) {
                        $this->error('验证码输入错误！');
                    }
                    if (I('post.email')) {
                        $reg_data['email'] = I('post.email');
                    }
                    if (I('post.mobile')) {
                        $reg_data['mobile'] = I('post.mobile');
                    }
                    break;
                case 'email': //邮箱注册
                    //验证码严格加盐加密验证
                    if (user_md5(I('post.verify'), I('post.email')) !== session('reg_verify')) {
                        $this->error('验证码错误！');
                    }
                    $_POST['username'] = I('post.username') ? I('post.username') : 'U'.time();
                    $reg_data['email'] = I('post.email');
                    $reg_data['email_bind'] = 1;
                    if (I('post.mobile')) {
                        $reg_data['mobile'] = I('post.mobile');
                    }
                    break;
                case 'mobile': //手机号注册
                    //验证码严格加盐加密验证
                    if (user_md5(I('post.verify'), I('post.mobile')) !== session('reg_verify')) {
                        $this->error('验证码错误！');
                    }
                    $_POST['username'] = I('post.username') ? I('post.username') : 'U'.time();
                    $reg_data['mobile'] = I('post.mobile');
                    $reg_data['mobile_bind'] = 1;
                    if (I('post.email')) {
                        $reg_data['email'] = I('post.email');
                    }
                    break;
            }

            // 构造注册数据
            $reg_data['user_type'] = I('post.user_type') ? I('post.user_type') : 1;
            $reg_data['nickname']  = I('post.nickname') ? I('post.nickname') : I('post.username');
            $reg_data['username']  = I('post.username');
            $reg_data['password']  = I('post.password');
            if ($_POST['repassword']) {
                $reg_data['repassword'] = $_POST['repassword'];
            }
            $reg_data['reg_type']  = I('post.reg_type');
            $user_object = D('User/User');

            $invite_code = I('post.invite_code');//填写邀请码
            $condition_invite['code'] = array('eq',$invite_code);
            $user_id = $user_object->where($condition_invite)->field('id,invite_path')->find();
            if($user_id){
                $reg_data['invite_id']  = $user_id['id'];
                $reg_data['invite_path']  = $user_id['invite_path'].$user_id['id'].',';
            }


            $data = $user_object->create($reg_data);
            if ($data) {
                $id = $user_object->add($data);
                if ($id) {
                    //生成推广码
                    $condition_dogo['id'] = array('eq',$id);
                    $data_code = $id.mt_rand(100,999);
                    $user_object->where($condition_dogo)->setField('code',$data_code);

                    session('reg_verify', null);
                    $user_info = $user_object->login($data['username'], I('post.password'), true);

                    // 构造消息数据
                    $msg_data['to_uid'] = $user_info['id'];
                    $msg_data['title']  = '注册成功';
                    $msg_data['content'] = '少侠/女侠好：<br>'
                                           .'恭喜您成功注册'.C('WEB_SITE_TITLE').'的帐号<br>'
                                           .'您的帐号信息如下（请妥善保管）：<br>'
                                           .'UID：'.$user_info['id'].'<br>'
                                           .'昵称：'.$user_info['nickname'].'<br>'
                                           .'用户名：'.$user_info['username'].'<br>'
                                           .'密码：'.$_POST['password'].'<br>'
                                           .'<br>';
                    D('User/Message')->sendMessage($msg_data);
                    $url = U('User/Center/index');
                    //---------初始化资金账户-------------//
                    AccountService::initUserAccount($id);
                    //---------发放用户注册奖励-----------//
                    UserService::getRegistAward($id);
                    $this->success('注册成功', $url);
                } else {
                    $this->error('注册失败'.$user_object->getError());
                }
            } else {
                $this->error('注册失败'.$user_object->getError());
            }
        } else {
            $this->assign('meta_title', '用户注册');
            $this->display();
        }
    }

    /**
     * 用户注册2
     *
     */
    public function register2() {
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
                        $this->success('头像设置成功', U('register3'));
                    } else {
                        $this->error('头像设置失败'.$user_object->getError());
                    }
                } else {
                    $this->error('头像保存失败');
                }
            } else {
                $this->error('请选择文件');
            }
        } else {
            $this->assign('user_info', D('User/User')->detail($uid));
            $this->assign('meta_title', '设置头像');
            $this->display();
        }
    }

    /**
     * 用户注册3
     *
     */
    public function register3() {
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
                    $this->success('信息修改成功', U('User/Center/profile'));
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
            $attribute_list[$type] = D('User/Attribute')->where($map)->select();

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
            $builder->setMetaTitle('完善信息')  // 设置页面标题
                    ->setPostUrl(U(''))        // 设置表单提交地址
                    ->setExtraItems($new_attribute_list_sort)
                    ->setTemplate('User/register3')
                    ->display();
        }
    }

    /**
     * 密码重置
     *
     */
    public function resetPassword() {
        if (IS_POST) {
            $reg_type = I('post.reg_type');
            switch ($reg_type) {
                case 'email':
                    $username = I('post.email');
                    $condition['email'] = I('post.email');
                    $condition['email_bind'] = 1;
                    $condition['status'] = 1;
                    break;
                case 'mobile':
                    $username = I('post.mobile');
                    $condition['mobile'] = I('post.mobile');
                    $condition['mobile_bind'] = 1;
                    $condition['status'] = 1;
                    break;
            }

            //验证码严格加盐加密验证
            if (user_md5(I('post.verify'), $username) !== session('reg_verify')) {
                $this->error('验证码错误！');
            }

            $validate = array (
                array('password', '6,30', '密码长度为6-30位', 1, 'length'),
                array('password', '/(?!^(\d+|[a-zA-Z]+|[~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+)$)^[\w~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+$/', '密码至少由数字、字符、特殊字符三种中的两种组成', 1, 'regex'),
            );
            $user_object = D('User/User');
            $user_object->setProperty("_validate", $validate);
            $data = $user_object->create($_POST);  //调用自动验证
            if (!$data) {
                $this->error($user_object->getError());
            }

            // 查找此用户
            $exist = $user_object->where($condition)->find();
            if (!$exist) {
                $this->error('该邮箱不存在或未认证');
            }

            $result = $user_object
                    ->where($condition)
                    ->setField('password', $data['password']);  //重置密码
            if (!$result) {
                $this->error('密码重置失败'.$user_object->getError());
            }
            $user_info = $user_object->login($username, I('post.password'), true);  //自动登录

            // 发送消息
            if ($user_info) {
                // 构造消息数据
                $msg_data['to_uid'] = $user_info['id'];
                $msg_data['title']  = '密码重置成功';
                $msg_data['content'] = '少侠/女侠好：<br>'
                                      .'恭喜您成功重置您在'.C('WEB_SITE_TITLE').'的帐号密码<br>'
                                      .'您的帐号信息如下（请妥善保管）：<br>'
                                      .'UID：'.$user_info['id'].'<br>'
                                      .'昵称：'.$user_info['nickname'].'<br>'
                                      .'用户名：'.$user_info['username'].'<br>'
                                      .'密码：'.$_POST['password'].'<br>'
                                      .'<br>';
                D('User/Message')->sendMessage($msg_data);
                $this->success('密码重置成功', C('HOME_PAGE'));
            } else {
                $this->error('密码重置失败');
            }
        } else {
            $this->assign('meta_title', '密码重置');
            $this->display();
        }
    }

    /**
     * 图片验证码生成，用于登录和注册
     *
     */
    public function verify($vid = 1) {
        $verify = new \Think\Verify();
        $verify->length = 4;
        $verify->entry($vid);
    }

    /**
     * 检测验证码
     * @param  integer $id 验证码ID
     * @return boolean 检测结果
     */
    function check_verify($code, $vid = 1) {
        $verify = new \Think\Verify();
        return $verify->check($code, $vid);
    }

    /**
     * 邮箱验证码，用于注册
     *
     */
    public function sendMailVerify(){
        if((time()-session('limit_time')) < 30){
            $this->error('30秒内不能重复发送');
        }

        // 生成验证码
        $reg_verify = \Org\Util\String::randString(6,1);
        session('reg_verify', user_md5($reg_verify, I('post.email')));

        // 构造邮件数据
        $mail_data['receiver'] = I('post.email');
        $mail_data['title']  = '邮箱验证';
        $mail_data['content'] = '少侠/女侠好：<br>听闻您正使用该邮箱'.I('post.email').'【注册/修改密码】，请在验证码输入框中输入：
        <span style="color:red;font-weight:bold;">'.$reg_verify.'</span>，以完成操作。<br>
        注意：此操作可能会修改您的密码、登录邮箱或绑定手机。如非本人操作，请及时登录并修改
        密码以保证帐户安全 （工作人员不会向您索取此验证码，请勿泄漏！)';
        $result = D('Addons://Email/Email')->send($mail_data);

        // 发送邮件
        if ($result) {
            session('limit_time', time());
            $this->success('发送成功，请登陆邮箱查收！');
        } else {
            $this->error('发送失败！');
        }
    }

    /**
     * 短信验证码，用于注册
     *
     */
    public function sendMobileVerify() {
        if((time()-session('limit_time')) < 30){
            $this->error('30秒内不能重复发送');
        }

        // 生成验证码
        $reg_verify = \Org\Util\String::randString(6,1);
        session('reg_verify', user_md5($reg_verify, I('post.mobile')));

        // 构造短信数据
        $sms_data['RecNum'] = I('post.mobile');
        $sms_data['code']   = $reg_verify;
        $sms_data['SmsFreeSignName'] = '注册验证';
        //$sms_data['SmsTemplateCode'] = '';
        $result = D('Addons://Alidayu/Alidayu')->send($sms_data);
        if ($result) {
            session('limit_time', time());
            $this->success('发送成功，请查收！');
        } else {
            $this->error('发送失败！');
        }
    }
}
