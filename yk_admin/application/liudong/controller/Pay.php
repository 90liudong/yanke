<?php
/**
 * Created by PhpStorm.
 * User: PVer
 * Date: 2017/11/16
 * Time: 11:20
 */

namespace app\liudong\controller;

use think\Db;
use think\Request;
use think\Controller;

class Pay extends Controller
{
    
    private $makesign = 'h9IsPjZHf4fh5VNDg14aMX6yKQsd0RXd';   
 //统一下单接口
 public function payfee(){
    $money =input('get.money');
    $openid=input('get.openid');
    $appid='wx9e828b22c65f368b';

    // $openid=json_decode($openid);
    $mch_id='1497920902';
    $key='h9IsPjZHf4fh5VNDg14aMX6yKQsd0RXd';
    $out_trade_no = $mch_id. time();
    $body = "付款";
    $total_fee = floatval($money*100);

    $return=$this->weixinapp($total_fee,$openid,$appid,$mch_id,$key,$out_trade_no,$body);
    echo json_encode($return);
    // mp($return);
 }
/*
   public function pay($total_fee,$openid,$appid,$mch_id,$key,$out_trade_no,$body) {
        //统一下单接口
        $return = $this->weixinapp($total_fee,$openid,$appid,$mch_id,$key,$out_trade_no,$body);
        return $return;
    }

*/

   //微信小程序接口
    private function weixinapp($total_fee,$openid,$appid,$mch_id,$key,$out_trade_no,$body) {
        //统一下单接口
        $unifiedorder = $this->unifiedorder($total_fee,$openid,$appid,$mch_id,$key,$out_trade_no,$body);
        // return  $unifiedorder;
//      print_r($unifiedorder);
        $parameters = array(
            'appId' => $appid, //小程序ID
            'timeStamp' => '' . time() . '', //时间戳
            'nonceStr' => $this->createNoncestr(), //随机串
           'package' => 'prepay_id=' . $unifiedorder['prepay_id'], //数据包
            'signType' => 'MD5'//签名方式
        );
        //签名
        $parameters['paySign'] = $this->getSign($parameters);
        // mp($parameters);
        return $parameters;
    }


  private function createNoncestr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

  //作用：生成签名
    private function getSign($Obj) {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        //签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters);
        //签名步骤二：在string后加入KEY
        $String = $String . "&key=" . "h9IsPjZHf4fh5VNDg14aMX6yKQsd0RXd";
        //签名步骤三：MD5加密
        $String = md5($String);
        //签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        return $result_;
    }



	  ///作用：格式化参数，签名过程需要使用
    private function formatBizQueryParaMap($paraMap) {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
           
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar;
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;


	
    }


	private function unifiedorder($total_fee,$openid,$appid,$mch_id,$key,$out_trade_no,$body) {
        $url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
        $parameters = array(
            'appid' => $appid, //小程序ID
            'body' => $body,//商品描述
            'mch_id' => $mch_id, //商户号
            'nonce_str' => $this->createNoncestr(), //随机字符串
            'notify_url' => 'https://pxxy.90web.cn/index.php/liudong/pay/notify', //通知地址  确保外网能正常访问
            'openid' =>$openid, //用户id
            'out_trade_no'=> $out_trade_no, //商户订单号
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], //终端IP
            'total_fee' => $total_fee,//总金额 单位 分
            'trade_type' => 'JSAPI',//交易类型		
            // "sign_type"=> "MD5"
        );
        // mp($parameters);
        //统一下单签名
        $parameters['sign'] = $this->MakeSign($parameters); 
        $xmlData = $this->arrayToXml($parameters);
        $return = $this->xmlToArray($this->postXmlCurl($xmlData, $url, 60));
        return  $return;
    }
        /**
     * 生成签名
     * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
     */

    protected function MakeSign($arr)
    {
        //签名步骤一：按字典序排序参数
        ksort($arr);
        $string = $this->ToUrlParams($arr);
        //签名步骤二：在string后加入KEY
        $string = $string . "&key=" . $this->makesign;
        //签名步骤三：MD5加密
        $string = md5($string);
        //签名步骤四：所有字符转为大写
        $result = strtoupper($string);
        return $result;
    }
        /**
     * 格式化参数格式化成url参数
     */
    protected function ToUrlParams($arr)
    {
        $buff = "";
        foreach ($arr as $k => $v) {
            if ($k != "sign" && $v != "" && !is_array($v)) {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
	 private function xmlToArray($xml) {


        //禁止引用外部xml实体 


        libxml_disable_entity_loader(true);


        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);


        $val = json_decode(json_encode($xmlstring), true);


        return $val;
    }

	    //数组转换成xml
    private function arrayToXml($arr) {
        $xml = "<root>";
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $xml .= "<" . $key . ">" . arrayToXml($val) . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            }
        }
        $xml .= "</root>";
        return $xml;
    }

	  private static function postXmlCurl($xml, $url, $second = 30) 
    {
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); //严格校验
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);


        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        set_time_limit(0);


        //运行curl
        $data = curl_exec($ch);
        //返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            curl_close($ch);
            throw new WxPayException("curl出错，错误码:$error");
        }
    }
    function notify(){
        echo "123";
    }

}