<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace User\Model;
use Think\Model;
/**
 * 用户模型
 *
 */
class UserModel extends Model {
    /**
     * 数据库表名
     *
     */
    protected $tableName = 'admin_user';

    /**
     * 自动验证规则
     *
     */
    protected $_validate = array(
        // 验证用户类型
        array('user_type', 'require', '请选择用户类型', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),

        //验证用户名
        array('nickname', 'require', '昵称不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),

        // 验证用户名
        array('username', 'require', '请填写用户名', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('username', '3,32', '用户名长度为1-32个字符', self::MUST_VALIDATE, 'length', self::MODEL_INSERT),
        array('username', '', '用户名被占用', self::MUST_VALIDATE, 'unique', self::MODEL_INSERT),
        array('username', '/^(?!_)(?!\d)(?!.*?_$)[\w]+$/', '用户名只可含有数字、字母、下划线且不以下划线开头结尾，不以数字开头！', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('username', 'checkDenyMember', '该用户名禁止使用', self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册

        // 验证密码
        array('password', 'require', '请填写密码', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('password', '6,30', '密码长度为6-30位', self::MUST_VALIDATE, 'length', self::MODEL_INSERT),
        array('password', '/(?!^(\d+|[a-zA-Z]+|[~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+)$)^[\w~!@#$%^&*()_+{}:"<>?\-=[\];\',.\/]+$/', '密码至少由数字、字符、特殊字符三种中的两种组成', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        array('repassword', 'password', '两次输入的密码不一致', self::EXISTS_VALIDATE, 'confirm', self::MODEL_INSERT),

        // 验证邮箱
        array('email', 'email', '邮箱格式不正确', self::EXISTS_VALIDATE, 'regex', self::MODEL_INSERT),
        array('email', '1,32', '邮箱长度为1-32个字符', self::EXISTS_VALIDATE, 'length', self::MODEL_INSERT),
        array('email', '', '邮箱被占用', self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),

        // 验证手机号码
        array('mobile', '/^1\d{10}$/', '手机号码格式不正确', self::EXISTS_VALIDATE, 'regex', self::MODEL_INSERT),
        array('mobile', '', '手机号被占用', self::EXISTS_VALIDATE, 'unique', self::MODEL_INSERT),

        // 验证注册来源
        array('reg_type', 'require', '注册来源不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    );

    /**
     * 自动完成规则
     *
     */
    protected $_auto = array(
        array('score', '0', self::MODEL_INSERT),
        array('money', '0', self::MODEL_INSERT),
        array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
        array('password', 'user_md5', self::MODEL_BOTH, 'function'),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 查找后置操作
     *
     */
    protected function _after_find(&$result, $options) {
        $result['avatar_url'] = get_cover($result['avatar'], 'avatar');
    }

    /**
     * 查找后置操作
     *
     */
    protected function _after_select(&$result, $options) {
        foreach($result as &$record){
            $this->_after_find($record, $options);
        }
    }

    /**
     * 用户性别
     *
     */
    public function user_gender($id) {
        $list[0]  = '保密';
        $list[1]  = '男';
        $list[-1] = '女';
        return isset($id) ? $list[$id] : $list;
    }

    /**
     * 用户性别图标
     *
     */
    public function user_gender_icon($id) {
        $list[0]  = '<i class="fa fa-genderless"></i>';
        $list[1]  = '<i class="fa fa-mars text-primary color-blue"></i>';
        $list[-1] = '<i class="fa fa-venus text-danger color-pink"></i>';
        return isset($id) ? $list[$id] : '';
    }

    /**
     * 检测用户名是不是被禁止注册
     * @param  string $username 用户名
     * @return boolean ture 未禁用，false 禁止注册
     */
    protected function checkDenyMember($username){
        $deny = C('user_config.deny_username');
        $deny = explode ( ',', $deny);
        foreach ($deny as $k=>$v) {
            if(stristr($username, $v)){
                return false;
            }
        }
        return true;
    }

    /**
     * 用户登录
     *
     */
    public function login($account, $password, $return = false) {
        if (is_login()) {
            $this->error = '已登录！';
            return false;
        }

        //去除前后空格
        $account = trim($account);

        //匹配登录方式
        if (preg_match("/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/", $account)) {
            $map['email'] = array('eq', $account);     // 邮箱登陆
            $map['email_bind'] = array('eq', 1);
        } elseif (preg_match("/^1\d{10}$/", $account)) {
            $map['mobile'] = array('eq', $account);    // 手机号登陆
            $map['mobile_bind'] = array('eq', 1);
        } else {
            $map['username'] = array('eq', $account);  // 用户名登陆
        }

        $map['status']   = array('eq', 1);
        $user_info = $this->where($map)->find(); //查找用户
        if (!$user_info) {
            $this->error = '用户不存在或被禁用！';
        } else {
            if (user_md5($password) !== $user_info['password']) {
                $this->error = '密码错误！';
            } else {
                if ($this->auto_login($user_info)) {
                    if ($return) {
                        return $user_info;
                    } else {
                        return $user_info['id'];
                    }
                }
            }
        }
        return false;
    }

    /**
     * 设置登录状态
     *
     */
    public function auto_login($user) {
        // VIP信息
        if (is_dir('./Application/Vip/')) {
            $con['status'] = 1;
            $con['id'] = is_vip($user['id']);
            $vip = D('Vip/Index')->where($con)->find();
        }

        // 记录登录SESSION和COOKIES
        $auth = array(
            'uid'        => $user['id'],
            'username'   => $user['username'],
            'nickname'   => $user['nickname'],
            'avatar'     => $user['avatar'],
            'avatar_url' => get_cover($user['avatar'], 'avatar'),
            'vip'        => $vip,
        );
        session('user_auth', $auth);
        session('user_auth_sign', $this->data_auth_sign($auth));
        return true;
    }

    /**
     * 密码认证
     *
     */
    public function password_auth($password) {
        $user_info = $this->find(is_login());
        if ($user_info) {
            if ($user_info['password'] === user_md5($password)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 注销
     *
     */
    public function logout() {
        session('user_auth', null);
        session('user_auth_sign', null);
        return true;
    }

    /**
     * 数据签名认证
     * @param  array  $data 被认证的数据
     * @return string       签名
     *
     */
    public function data_auth_sign($data) {
        // 数据类型检测
        if (!is_array($data)) {
            $data = (array)$data;
        }
        ksort($data); //排序
        $code = http_build_query($data); // url编码并生成query字符串
        $sign = sha1($code);  // 生成签名
        return $sign;
    }

    /**
     * 获取用户详情
     *
     */
    public function detail($id) {
        //获取基础表信息
        $user_info = $this->find($id);
        if(!(is_array($user_info) || 1 !== $user_info['status'])){
            $this->error = '用户被禁用或已删除！';
            return false;
        }

        //根据文档模型获取扩展表的息
        $user_type_name = D('User/Type')->where(array('id' => $user_info['user_type']))->getField('name');
        if ($user_type_name) {
            $user_extend_object = D('User/User'.ucfirst($user_type_name));
            $extend_data = $user_extend_object->where(array('uid' => $id))->find();

            //基础信息与扩展信息合并
            if(is_array($extend_data)){
                $user_info = array_merge($user_info, $extend_data);
            }
        }

        // 获取粉丝关注性别等信息
        $user_info['gender_icon'] = $this->user_gender_icon($user_info['gender']);

        return $user_info;
    }
}
