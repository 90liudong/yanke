<?php
namespace app\geng\model;
use think\Model;

class Moneywater extends Model
{
	function waterflow($id){
		$res = db('moneywater')->alias('m')->where(['m.uid'=>$id])->field('m.id,m.uid,m.money,m.time,m.m_status,m.bm_id,u.profit')->join('user u','u.id=m.uid')->order('m.time desc')->select();
		
		for($i=0;$i<count($res);$i++){
		// 判断是提现利润还是生成利润
		if($res[$i]['m_status']==0){
			$data = db('bring_money')->field('status')->where(['id'=>$res[$i]['bm_id']])->find();
			$res[$i]['status']=$data['status'];
			$res[$i]['money'] = -$res[$i]['money'];
		}else{
			$res[$i]['money'] = $res[$i]['money'];
			$res[$i]['status']='无';
		}
		$res[$i]['time'] = date("Y-m-d",$res[$i]['time']);
		}
		return $res;
	}

}