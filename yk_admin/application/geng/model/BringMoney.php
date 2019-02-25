<?php
namespace app\geng\model;
use think\Model;

class BringMoney extends Model
{
	function get_money($data){
		$item = db('user')->where(['id'=>$data['uid']])->find();
		$profit = $item['profit'];
		// mp($profit);
		$pay_password = $item['pay_password'];
		if($data['pay_password']==$pay_password){
			if($profit<$data['num']){
				return 0;
			}else{
				$all_profit = $profit - $data['num'];
				db('user')->where(['id'=>$data['uid']])->update(['profit'=>$all_profit]);
				$id = db('bring_money')->insertGetId(['bank'=>$data['bank'],'uid' =>$data['uid'], 'name'=>$data['name'],'num'=>$data['num'],'time'=>$data['time'],'status'=>'0']);

				// 生成流水
				db('moneywater')->insert(['uid'=>$data['uid'],'money'=>$data['num'],'time'=>$data['time'],'m_status'=>'0','bm_id'=>$id]);
				return 1;
			}
		}else{
			return 2;
		}
	}
	
}