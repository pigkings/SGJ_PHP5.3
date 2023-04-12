<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use User\Api\UserApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends HomeController {

	/* 用户中心首页 */
	public function index(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
        $this->display();
	}

	public function recharge($card_no='', $card_pwd = ''){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		if(IS_POST){
			if(empty($card_no)){
				$this->error('卡号不能为空');
			}
			if(empty($card_pwd)){
				$this->error('卡密不能为空');
			}
			$card = M('card')->where(array('card_no'=>$card_no))->field(true)->find();
			if(empty($card)){
				$this->error('充值卡不存在');
			}
			if($card['card_pwd'] != $card_pwd){
				$this->error('卡密不正确');
			}
			if($card['uid'] != 0){
				$this->error('充值卡已被使用');
			}
			if($card['status'] != 1){
				$this->error('充值卡已失效');
			}
			/* 添加加分历史 */
			$old_score = M('member')->where(array('uid'=> $uid))->getField('score');
			$score_log = array();
			$score_log['uid'] = $uid;
			$score_log['add'] = $card['value'];
			$score_log['score'] = $old_score + $card['value'];
			$score_log['create_time'] = time();
			$score_log['remark'] = '使用充值卡' . $card_no;
			M('member_score_log')->data($score_log)->add();
			/* 加分 */
			M('member')->where(array('uid' => $uid))->setInc('score', $card['value']);
			/* 修改充值卡状态 */
			M('card')->where(array('id'=>$card['id']))->save(array('uid'=> $uid, 'update_time'=> time(), 'status'=>2));
			$this->success('充值成功！', U('Houwang/index'));
		} else {
			$this->display();
		}
	}
	public function pay(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		if(IS_POST){
			$price = intval(I('post.price'));
			if($price < 1){
				$this->error('请输入正确的积分');
			}
			$order = array();
			$order['price'] = $price;
			$order['uid'] = $uid;
			$order['status'] = 1;
			$order['create_time'] = time();
			$order['order_sn'] = build_order_no();
			$order['id'] = M('recharge')->data($order)->add();

			$order['subject'] = '积分充值'.$price;
			$order['notify_url'] = "http://www.cshw007.cn/index.php". U('Payment/yunpay_notify');
			$order['return_url'] = "http://www.cshw007.cn/index.php". U('Payment/yunpay_return');

			$payment = new \Lib\Payment\Yunpay($order);
			$this->assign('pay_online', $payment->get_code());
		}
		$this->display();
	}

	public function withdraw(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		if(IS_POST){
			$data = I('post.');
			$old_score = M('member')->where(array('uid'=> $uid))->getField('score');
			if(empty($data['money'])){
				$this->error('请输入提现金额');
			}
			if(empty($data['card_no'])){
				$this->error('请输入银行卡号');
			}
			if(empty($data['name'])){
				$this->error('请输入联系人');
			}
			if(empty($data['tel'])){
				$this->error('请输入联系电话');
			}
			$old_score = M('member')->where(array('uid'=> $uid))->getField('score');
			if($data['money'] > $old_score){
				$this->error('你提交的金额已经超出你拥有的积分');
			}
			/* 添加扣分历史 */
			$score_log = array();
			$score_log['uid'] = $uid;
			$score_log['add'] = 0 - $data['money'];
			$score_log['score'] = $old_score - $data['money'];
			$score_log['create_time'] = time();
			$score_log['remark'] = '提现' . $data['money'];
			M('member_score_log')->data($score_log)->add();
			/* 扣分 */
			M('member')->where(array('uid' => $uid))->setDec('score', $data['money']);
			/* 添加提现记录 */
			$withdraw = array();
			$withdraw['uid'] = $uid;
			$withdraw['status'] = 1;
			$withdraw['create_time'] = time();
			$withdraw = array_merge($withdraw, $data);
			M('withdraw')->data($withdraw)->add();
			$this->success('提现成功，请耐心等待', U('Houwang/index'));
		} else {
			$this->display();
		}
	}

	public function card_log(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$count=M('card')->where(array('uid'=>$uid))->count();
		$Page = new \Think\Page($count, 10);
		$show  = $Page->show();// 分页显示输出

		$list=M('card')->where(array("uid"=>$uid))->field(array('id', 'card_no', 'value', 'update_time'))->order(array('id'=>'desc'))->page(I('get.p'),$Page->listRows)->select();

		$this->assign('page', $show);
		$this->assign('list', $list);
		$this->display();
	}

	public function recharge_log(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$count=M('recharge')->where(array('uid'=>$uid, 'status'=>2))->count();
		$Page = new \Think\Page($count, 10);
		$show  = $Page->show();// 分页显示输出

		$list=M('recharge')->where(array("uid"=>$uid, 'status'=>2))->field(array('id', 'order_sn', 'price', 'update_time'))->order(array('id'=>'desc'))->page(I('get.p'),$Page->listRows)->select();

		$this->assign('page', $show);
		$this->assign('list', $list);
		$this->display();
	}

	public function withdraw_log(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$count=M('withdraw')->where(array('uid'=>$uid))->count();
		$Page = new \Think\Page($count, 10);
		$show  = $Page->show();// 分页显示输出

		$list=M('withdraw')->where(array("uid"=>$uid))->field(array('id', 'card_no', 'money', 'name', 'tel', 'create_time', 'update_time'))->order(array('id'=>'desc'))->page(I('get.p'),$Page->listRows)->select();

		$this->assign('page', $show);
		$this->assign('list', $list);
		$this->display();
	}

	public function houwang_log(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$count=M('houwang_open_logs')->where(array('uid'=>$uid))->count();
		$Page = new \Think\Page($count, 10);
		$show  = $Page->show();// 分页显示输出

		$list=M('houwang_open_logs')->alias('ol')->join('__HOUWANG_FRUITS__ AS f ON ol.result=f.id', 'left')->where(array("ol.uid"=>$uid))->field(array('ol.id', 'ol.bet_time', 'ol.total_money', 'ol.periods', 'ol.result', 'ol.date', 'f.id'=>'fid', 'f.img'))->order(array('ol.id'=>'desc'))->page(I('get.p'),$Page->listRows)->select();
		if(!empty($list)){
			$v['get_money'] = 0;
			foreach ($list as &$v) {
				$v['fruits'] = M('houwang_open_logs_fruits')->alias('olf')->join('__HOUWANG_FRUITS__ AS f ON f.id=olf.fruit_id', 'left')->where(array('log_id'=>$v['id']))->field(array('f.id', 'f.img', 'olf.score', 'olf.result'))->select();
				foreach ($v['fruits'] as $vv) {
					$v['get_money'] += $vv['result'];
				}
			}
		}

		$this->assign('page', $show);
		$this->assign('list', $list);
		$this->display();
	}

	/**
	 * 推广链接
	 */
	public function share(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$hashids = new \Lib\Hashids(C('PWD_KEY'), C('URL_ID'));
		$this->share_url = U('Index/index', array('u'=>$hashids->encode($uid)), true, true);
		$this->display(); 
	}

	public function children(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$count=M('member_relation')->where(array('pid'=>$uid, 'level'=>1))->count();
		$Page = new \Think\Page($count, 10);
		$show  = $Page->show();// 分页显示输出

		$list=M('member_relation')->alias('mr')->join('__MEMBER__ AS m ON m.uid=mr.uid')->where(array('pid'=>$uid, 'level'=>1))->field(array('m.uid', 'm.nickname'))->page(I('get.p'),$Page->listRows)->select();

		$this->assign('page', $show);
		$this->assign('list', $list);
		$this->display();
	}

	public function deducts(){
		if ( !($uid = is_login()) ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
		$count=M('houwang_deducts')->where(array('uid'=>$uid))->count();
		$Page = new \Think\Page($count, 10);
		$show  = $Page->show();// 分页显示输出

		$list=M('houwang_deducts')->alias('d')->join('__HOUWANG_OPEN_LOGS__ AS ol ON ol.id=d.log_id')->join('__MEMBER__ AS m ON m.uid=ol.uid')->where(array("d.uid"=>$uid))->field(array('d.id', 'd.score', 'ol.date', 'ol.periods', 'ol.total_money', 'm.nickname'))->order(array('d.id'=>'desc'))->page(I('get.p'),$Page->listRows)->select();

		$this->assign('page', $show);
		$this->assign('list', $list);
		$this->display();
	}

	/* 注册页面 */
	public function register($username = '', $password = '', $repassword = '', $email = '', $verify = ''){
        if(!C('USER_ALLOW_REGISTER')){
            $this->error('注册已关闭');
        }
		if(IS_POST){ //注册用户
			/* 检测验证码 */
			if(!check_verify($verify)){
				$this->error('验证码输入错误！');
			}

			/* 检测密码 */
			if($password != $repassword){
				$this->error('密码和重复密码不一致！');
			}			

			/* 调用注册接口注册用户 */
            $User = new UserApi;
			$uid = $User->register($username, $password, $email);
			if(0 < $uid){ //注册成功
				//TODO: 发送验证邮件
				$user = array('uid' => $uid, 'nickname' => $username, 'status' => 1);
                if(!D('Member')->add($user)){
                    $this->error('注册失败！');
                } else {
                	//推荐关系处理
                	$affiliate_uid = intval(cookie('affiliate_uid'));
                	if($affiliate_uid>0 && $affiliate_uid != $uid){
                		M('member_relation')->data(array('pid'=>$affiliate_uid, 'uid'=>$uid, 'level'=>1))->add();
						$grandpas = M('member_relation')->where(array('uid'=>$affiliate_uid))->select();
						if(!empty($grandpas)){
							foreach ($grandpas as $g){
								M('member_relation')->data(array('pid'=>$g['pid'], 'uid'=>$uid, 'level'=>($g['level']+1)));
							}
						}
						cookie('affiliate_uid', null);
                	}
                    $this->success('注册成功！',U('login'));
                }
			} else { //注册失败，显示错误信息
				$this->error($this->showRegError($uid));
			}

		} else { //显示注册表单
			$this->display();
		}
	}

	/* 登录页面 */
	public function login($username = '', $password = '', $verify = ''){
		if(IS_POST){ //登录验证
			/* 检测验证码 */
			if(!check_verify($verify)){
				$this->error('验证码输入错误！');
			}

			/* 调用UC登录接口登录 */
			$user = new UserApi;
			$uid = $user->login($username, $password);
			if(0 < $uid){ //UC登录成功
				/* 登录用户 */
				$Member = D('Member');
				if($Member->login($uid)){ //登录用户
					//TODO:跳转到登录前页面
					$this->success('登录成功！',U('Home/Houwang/index'));
				} else {
					$this->error($Member->getError());
				}

			} else { //登录失败
				switch($uid) {
					case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
					case -2: $error = '密码错误！'; break;
					default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
				}
				$this->error($error);
			}

		} else { //显示登录表单
			$this->display();
		}
	}

	/* 退出登录 */
	public function logout(){
		if(is_login()){
			D('Member')->logout();
			$this->success('退出成功！', U('User/login'));
		} else {
			$this->redirect('User/login');
		}
	}

	/* 验证码，用于登录和注册 */
	public function verify(){
		$verify = new \Think\Verify(array('codeSet'=>'2356789','useCurve'=>'false','useNoise'=>false));
		$verify->entry(1);
	}

	/**
	 * 获取用户注册错误信息
	 * @param  integer $code 错误编码
	 * @return string        错误信息
	 */
	private function showRegError($code = 0){
		switch ($code) {
			case -1:  $error = '用户名长度必须在16个字符以内！'; break;
			case -2:  $error = '用户名被禁止注册！'; break;
			case -3:  $error = '用户名被占用！'; break;
			case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
			case -5:  $error = '邮箱格式不正确！'; break;
			case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
			case -7:  $error = '邮箱被禁止注册！'; break;
			case -8:  $error = '邮箱被占用！'; break;
			case -9:  $error = '手机格式不正确！'; break;
			case -10: $error = '手机被禁止注册！'; break;
			case -11: $error = '手机号被占用！'; break;
			default:  $error = '未知错误';
		}
		return $error;
	}
    /**
     * 修改密码提交
     * @author huajie <banhuajie@163.com>
     */
    public function profile(){
		if ( !is_login() ) {
			$this->error( '您还没有登陆',U('User/login') );
		}
        if ( IS_POST ) {
            //获取参数
            $uid        =   is_login();
            $password   =   I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');

            if($data['password'] !== $repassword){
                $this->error('您输入的新密码与确认密码不一致');
            }

            $Api = new UserApi();
            $res = $Api->updateInfo($uid, $password, $data);
            if($res['status']){
                $this->success('修改密码成功！');
            }else{
                $this->error($res['info']);
            }
        }else{
            $this->display();
        }
    }

}