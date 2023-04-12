<?php
namespace Lib\Payment;

class Yunpay {
	/**
	 * 支付接口配置信息
	 * @var array
	 */
	private $payment;
	/**
	 * 订单信息
	 * @var array
	 */
	private $order;

	public function __construct($order_info = array()) {
		$this->order = $order_info;
		$this->payment = array(
			'partner' => '122132938044221',
			'key' => '3YaItuN4TKvdDBwcjauYbYSfHUWQsxGr',
			'user_seller' => '819974',
		);
	}
	/**
	 * 获取支付接口的请求地址
	 *
	 * @return string
	 */
	public function get_code() {
		
		$parameter = array(
				"partner" => trim($this->payment['partner']),
		         "user_seller"  => $this->payment['user_seller'],
				"out_order_no"	=> $this->order['water_number'],
				"subject"	=> $this->order['subject'],
				"total_fee"	=> $this->order['money'],
				"body"	=> $this->order['water_number'],
				"notify_url"	=> $this->order['notify_url'],
				"return_url"	=> $this->order['return_url']
		);
		//建立请求
		$html_text = $this->buildRequestFormShan($parameter, $this->payment['key']);
		return $html_text;
	}
	/**
	 * 通知地址验证
	 * @return bool
	 */
	public function notify_verify() {
		//计算得出通知验证结果
		$shanNotify = $this->md5VerifyShan($_REQUEST['out_order_no'],$_REQUEST['total_fee'],$_REQUEST['trade_status'],$_REQUEST['sign'],$this->payment['key'],$this->payment['partner']);
		if($shanNotify) {//验证成功
			if($_REQUEST['trade_status']=='TRADE_SUCCESS'){
					return true;
				}else{
		    		return false;
				}
				
		}else {
		   //验证失败
		    return false;
		}
	}

	/**
	 * 返回地址验证
	 * @return bool
	 */
	public function return_verify() {
		$shanNotify = $this->md5VerifyShan($_REQUEST['out_order_no'],$_REQUEST['total_fee'],$_REQUEST['trade_status'],$_REQUEST['sign'],$this->payment['key'],$this->payment['partner']);
		if($shanNotify) {//验证成功
			if($_REQUEST['trade_status']=='TRADE_SUCCESS'){
					return true;
				}else{
					return false;
				}

		}
		else {
		    //验证失败
		    return false;
		}
	}
	public function md5VerifyShan($p1, $p2,$p3,$sign,$key,$pid) {
		$prestr = $p1.$p2.$p3.$pid.$key;
		$mysgin = md5($prestr);
		if($mysgin == $sign) {
			return true;
		}else {
			return false;
		}
	}

	/**
	 * 建立请求，以表单HTML形式构造（默认）
	 * @param $para_temp 请求参数数组
	 *
	 */
	public function buildRequestFormShan($para_temp,$key) {
		//待请求参数数组
		$para = $this->buildRequestParaShan($para_temp,$key);

		$sHtml = "<form id='paysubmit' name='paysubmit' action='http://www.passpay.net/index.php/PayOrder/payorder' accept-charset='utf-8' method='POST'>";
		while (list ($key, $val) = each ($para)) {
	        $sHtml.= "<input type='hidden' name='".$key."' value='".$val."'/>";
	    }

		//submit按钮控件请不要含有name属性
	    $sHtml = $sHtml."<input type='submit'  value='支付进行中...' style='display:none;'></form>";
		
		$sHtml = $sHtml."<script>document.forms['paysubmit'].submit();</script>";
		
		return $sHtml;
	}
	/**
	 * 生成要请求给云闪付的参数数组
	 * @param $para_temp 请求前的参数数组
	 * @return 要请求的参数数组
	 */
	public function buildRequestParaShan($para_temp,$key) {
		//除去待签名参数数组中的空值和签名参数
		$para_filter = $this->paraFilterShan($para_temp);
		//对待签名参数数组排序
		$para_sort = $this->argSortShan($para_filter);
		//生成签名结果
		$mysign = $this->buildRequestMysignShan($para_sort,$key);
		
		//签名结果与签名方式加入请求提交参数组中
		$para_sort['sign'] = $mysign;
		
		return $para_sort;
	}
	/**
	 * 除去数组中的空值和签名参数
	 * @param $para 签名参数组
	 * return 去掉空值与签名参数后的新签名参数组
	 */
	public function paraFilterShan($para) {
		$para_filter = array();
		while (list ($key, $val) = each ($para)) {
			if($key == "sign" || $val == "")continue;
			else	$para_filter[$key] = $para[$key];
		}
		return $para_filter;
	}
	/**
	 * 对数组排序
	 * @param $para 排序前的数组
	 * return 排序后的数组
	 */
	public function argSortShan($para) {
		ksort($para);
		reset($para);
		return $para;
	}
	/**
	 * 生成签名结果
	 * @param $para_sort 已排序要签名的数组
	 * return 签名结果字符串
	 */
	public function buildRequestMysignShan($para_sort,$key) {
		//把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
		$prestr = $this->createLinkstringShan($para_sort);
		$mysign = $this->md5SignShan($prestr, $key);
		return $mysign;
	}
	public function md5SignShan($prestr, $key) {
		$prestr = $prestr . $key;
		return md5($prestr);
	}
	/**
	 * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
	 * @param $para 需要拼接的数组
	 * return 拼接完成以后的字符串
	 */
	public function createLinkstringShan($para) {
		$arg  = "";
		while (list ($key, $val) = each ($para)) {
			$arg.=$key."=".$val."&";
		}
		//去掉最后一个&字符
		$arg = substr($arg,0,count($arg)-2);
		
		//如果存在转义字符，那么去掉转义
		if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}
		
		return $arg;
	}

}