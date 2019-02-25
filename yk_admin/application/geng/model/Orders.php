<?php
namespace app\geng\model;
use think\Model;

class Orders extends Model
{
	function buypro($data){
		if($data['up_uid']==0){
			$res = db('orders')->insertGetId(['time'=>$data['time'],'code'=>$data['code'],'up_uid'=>$data['up_uid'],'c_uid'=>$data['c_uid'],'gid'=>$data['gid'],'unit_price'=>$data['unit_price'],'num'=>$data['num'],'price'=>$data['price'],'order_type'=>"1"]);
			// 患者生成消费
				$consumes = db('user')->where(['id'=>$data['c_uid']])->field('consume')->find();
				$all_consumes = $consumes['consume']+$data['price'];
				db('user')->where(['id'=>$data['c_uid']])->update(['consume'=>$all_consumes]);
			return "购买成功";
		}else{
			$res = db('orders')->insertGetId(['time'=>$data['time'],'code'=>$data['code'],'up_uid'=>$data['up_uid'],'c_uid'=>$data['c_uid'],'gid'=>$data['gid'],'unit_price'=>$data['unit_price'],'num'=>$data['num'],'price'=>$data['price'],'order_type'=>"2"]);
			// $id = getLastid()
			$id = $res;
			// mp($id);
			$pro = db('goods')->field('sell_price1,sell_price2,retail_price,coupon_price')->where(['id'=>$data['gid']])->select();
			$sell_price1 = $pro[0]['sell_price1'];
			$sell_price2 = $pro[0]['sell_price2'];
			$retail_price = $pro[0]['retail_price'];
			$coupon_price = $pro[0]['coupon_price'];

			// mp($coupon_price);
			$item = db('orders')->field('up_uid,id')->where(['c_uid'=>$data['c_uid'],'id'=>$id])->select();
			// 患者上一级up_uid
			$up_uid = $item[0]['up_uid'];
			// mp($up_uid);
			$result = db('user')->field('type,up_uid')->where(['id'=>$up_uid])->select();
			// mp($result);
			$type = $result[0]['type'];
			// 患者上一级的上一级的up_uid
			$up_uid2 = $result[0]['up_uid'];
			// mp($up_uid2);

			// mp($type);
			if($type==4){
				$b1=digui($data['up_uid']);
				$status = db('b1_goods')->field('status')->where(['uid'=>$b1,'gid'=>$data['gid']])->find();
				if($status['status']==0){
						$discounts = ab($data['up_uid']);
						// mp($discounts);
						$discount1 = $discounts[1];
						$discount2 = $discounts[2];
						if($discount1<10&&$discount1>0){
							$discount1 = $discount1*10;
						}
						if($discount2<10&&$discount2>0){
							$discount2 = $discount2*10;
						}

						if($discount1==0&&$discount2==0){
							$sell_price1 = $pro[0]['sell_price1'];
							$sell_price2 = $pro[0]['sell_price2'];
						}else if($discount1!=0&&$discount2!=0){
							$sell_price1 = $retail_price*($discount1/100);
							$sell_price2 = $retail_price*($discount2/100);
								if($sell_price1>$pro[0]['sell_price1']){
									$sell_price1 = $pro[0]['sell_price1'];
								}
								if($sell_price2<$pro[0]['sell_price1']||$sell_price2>$pro[0]['sell_price2']){
									$sell_price2 = $pro[0]['sell_price2'];
								}
						}else if($discount1==0&&$discount2!=0){
							$sell_price1 = $pro[0]['sell_price1'];
							$sell_price2 = $retail_price*($discount2/100);
							if($sell_price2<$pro[0]['sell_price1']||$sell_price2>$pro[0]['sell_price2']){
									$sell_price2 = $pro[0]['sell_price2'];
								}
						}else{
							$sell_price1 = $retail_price*($discount1/100);
							$sell_price2 = $pro[0]['sell_price2'];
							if($sell_price1>$pro[0]['sell_price1']){
									$sell_price1 = $pro[0]['sell_price1'];
								}
						}
				}
				
				

				// b2利润
				$profit1 = $data['num']*($data['unit_price']-$sell_price2);
				$res1 = db('profit')->insert(['oid'=>$id,'gid'=>$data['gid'],'uid'=>$up_uid,'money'=>$profit1,'time'=>$data['time']]);
				
				// 将获得的利润更新到该id的账户余额
				$all = db('user')->where(['id'=>$up_uid])->field('profit,totalprofit')->find();
				$all_profit = $all['profit']+$profit1;
				$totalprofit = $all['totalprofit']+$profit1;
				db('user')->where(['id'=>$up_uid])->update(['profit'=>$all_profit,'totalprofit'=>$totalprofit]);
				// 生成b2流水
				db('moneywater')->insert(['uid'=>$up_uid,'money'=>$profit1,'time'=>$data['time'],'m_status'=>'1']);
				// b1-2利润
				$profit2 = $data['num']*($sell_price2-$sell_price1);

				$result2 = db('user')->field('up_uid,id')->where(['id'=>$up_uid2])->select();
				$res2 = db('profit')->insert(['oid'=>$id,'gid'=>$data['gid'],'uid'=>$up_uid2,'money'=>$profit2,'time'=>$data['time']]);
				// 将获得的利润更新到该id的账户余额
				$all = db('user')->where(['id'=>$up_uid2])->field('profit,totalprofit')->find();
				$all_profit = $all['profit']+$profit2;
				$totalprofit = $all['totalprofit']+$profit2;
				db('user')->where(['id'=>$up_uid2])->update(['profit'=>$all_profit,'totalprofit'=>$totalprofit]);
				// 生成b1-2流水
				db('moneywater')->insert(['uid'=>$up_uid2,'money'=>$profit2,'time'=>$data['time'],'m_status'=>'1']);
				// $up_uid3 = $result2[0]['up_uid'];
				// 总代收入
				// $profit3 = $data['price'];
				$profit3 = $data['num']*$sell_price1;
				$result3 = db('user')->field('up_uid,id')->where(['id'=>$result[0]['up_uid']])->select();
				$res2 = db('profit')->insert(['oid'=>$id,'gid'=>$data['gid'],'uid'=>$result3[0]['up_uid'],'money'=>$profit3,'time'=>$data['time']]);
				// 将获得的利润更新到该id的账户余额
				$all = db('user')->where(['id'=>$result3[0]['up_uid']])->field('profit,totalprofit')->find();
				$all_profit = $all['profit']+$profit3;
				$totalprofit = $all['totalprofit']+$profit3;
				db('user')->where(['id'=>$result3[0]['up_uid']])->update(['profit'=>$all_profit,'totalprofit'=>$totalprofit]);
				// 生成流水
				db('moneywater')->insert(['uid'=>$result3[0]['up_uid'],'money'=>$profit3,'time'=>$data['time'],'m_status'=>'1']);
				// 库存量减少
				// 先找到b1的id
				$b1_id = digui($data['up_uid']);
				$nums = db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$data['gid']])->find();
				$newnum = $nums["num"] - $data['num'];	
				db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$data['gid']])->update(['num'=>$newnum]);
				// 患者生成消费
				$consumes = db('user')->where(['id'=>$data['c_uid']])->field('consume')->find();
				$all_consumes = $consumes['consume']+$data['price'];
				db('user')->where(['id'=>$data['c_uid']])->update(['consume'=>$all_consumes]);
				return "购买成功";
			}else if($type==3||$type==2){
				$b1=digui($data['up_uid']);
				$status = db('b1_goods')->field('status')->where(['uid'=>$b1,'gid'=>$data['gid']])->find();
				if($status['status']==0){
					// 折扣价一
					$dis = one($data['up_uid']);
					if($dis<10&&$dis>0){
						$dis = $dis*10;
					}
					// mp($dis);
					if($dis==0){
						$sell_price1 = $pro[0]['sell_price1'];
						// $sell_price2 = $pro[0]['sell_price2'];
					}else{
						$sell_price1 = $retail_price*($dis/100);
						// $sell_price2 = $pro[0]['sell_price2'];
							if($sell_price1>$pro[0]['sell_price1']){
								$sell_price1 = $pro[0]['sell_price1'];
							}
					}
					// mp($sell_price2);
				}
				
				// b1-2利润
				$profit2 = $data['num']*($data['unit_price']-$sell_price1);
				$res1 = db('profit')->insert(['oid'=>$id,'gid'=>$data['gid'],'uid'=>$up_uid,'money'=>$profit2,'time'=>$data['time']]);
				
				// 将获得的利润更新到该id的账户余额
				$all = db('user')->where(['id'=>$up_uid])->field('profit,totalprofit')->find();
				$all_profit = $all['profit']+$profit2;
				$totalprofit = $all['totalprofit']+$profit2;
				db('user')->where(['id'=>$up_uid])->update(['profit'=>$all_profit,'totalprofit'=>$totalprofit]);
				// 生成b1-2流水
				db('moneywater')->insert(['uid'=>$up_uid,'money'=>$profit2,'time'=>$data['time'],'m_status'=>'1']);
				// 总代收入
				// $profit3 = $data['price'];
				$profit3 = $data['num']*$sell_price1;
				$result2 = db('user')->field('up_uid,id')->where(['id'=>$up_uid2])->select();
				$res2 = db('profit')->insert(['oid'=>$id,'gid'=>$data['gid'],'uid'=>$up_uid2,'money'=>$profit3,'time'=>$data['time']]);
				// 将获得的利润更新到该id的账户余额
				$all = db('user')->where(['id'=>$up_uid2])->field('profit,totalprofit')->find();
				$all_profit = $all['profit']+$profit3;
				$totalprofit = $all['totalprofit']+$profit3;
				db('user')->where(['id'=>$up_uid2])->update(['profit'=>$all_profit,'totalprofit'=>$totalprofit]);
				// 生成流水
				db('moneywater')->insert(['uid'=>$up_uid2,'money'=>$profit3,'time'=>$data['time'],'m_status'=>'1']);
				// 库存量减少
				// 先找到b1的id
				$b1_id = digui($data['up_uid']);
				$nums = db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$data['gid']])->find();
				$newnum = $nums["num"] - $data['num'];	
				db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$data['gid']])->update(['num'=>$newnum]);
				// 患者生成消费
				$consumes = db('user')->where(['id'=>$data['c_uid']])->field('consume')->find();
				$all_consumes = $consumes['consume']+$data['price'];
				db('user')->where(['id'=>$data['c_uid']])->update(['consume'=>$all_consumes]);
				return "购买成功";
			}else if($type==1){ 
				// 总代收入
				$profit3 = $data['price'];
				$res1 = db('profit')->insert(['oid'=>$id,'gid'=>$data['gid'],'uid'=>$up_uid,'money'=>$profit3,'time'=>$data['time']]);
				// 将获得的利润更新到该id的账户余额
				$all = db('user')->where(['id'=>$up_uid])->field('profit,totalprofit')->find();
				$all_profit = $all['profit']+$profit3;
				$totalprofit = $all['totalprofit']+$profit3;
				db('user')->where(['id'=>$up_uid])->update(['profit'=>$all_profit,'totalprofit'=>$totalprofit]);
				// 生成流水
				db('moneywater')->insert(['uid'=>$up_uid,'money'=>$profit3,'time'=>$data['time'],'m_status'=>'1']);
				// 库存量减少
				// 先找到b1的id
				$b1_id = digui($data['up_uid']);
				$nums = db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$data['gid']])->find();
				$newnum = $nums["num"] - $data['num'];	
				// mp($newnum);

				db('b1_goods')->field('num')->where(['uid'=>$b1_id,'gid'=>$data['gid']])->update(['num'=>$newnum]);
				// 患者生成消费
				$consumes = db('user')->where(['id'=>$data['c_uid']])->field('consume')->find();
				$all_consumes = $consumes['consume']+$data['price'];
				db('user')->where(['id'=>$data['c_uid']])->update(['consume'=>$all_consumes]);
				return "购买成功";
			}
		}
			
	}
	function patient($id){
		$res = db('orders')->alias('o')->field('o.id,o.tracking,o.tracking_number,o.num,o.unit_price,o.price,o.time,o.code,g.name,g.image')->where(['c_uid'=>$id])->join('goods g','g.id=o.gid')->select();

		$data = db('orders')->alias('o')->field('a.name,a.tel,a.tel,a.addr')->where(['c_uid'=>$id])->join('addr a','a.uid=o.c_uid')->select();
		for($i=0;$i<count($res);$i++){
			$res[$i]['addr']=$data[$i];
		}
		return $res;
	}
	function b2_orders($id){
		$res = db('orders')->alias('o')->field('o.id,o.time,o.code,o.gid,o.unit_price,o.num,o.unit_price,o.price,o.tracking,o.tracking_number,u.nickname,u.tel')->join('user u','u.id=o.c_uid')->where(['o.up_uid'=>$id])->order('o.id desc')->select();
		// mp($res);	
		for($i=0;$i<count($res);$i++){
			// $item =[];
			$item =db('goods')->alias('g')->field('g.name,g.image,g.sell_price2,g.sell_price1')->where(['id'=>$res[$i]['gid']])->find();
			// mp($item);
			$res[$i]['name'] = $item['name'];
			$res[$i]['image'] = $item['image'];
			$res[$i]['sell_price1'] = $item['sell_price1'];
			$res[$i]['sell_price2'] = $item['sell_price2'];
			$profit[$i] = db('profit')->alias('p')->field('p.money')->where(['uid'=>$id,'oid'=>$res[$i]['id']])->find();
			// mp($profit[$i]['money']);
			$res[$i]['money'] = $profit[$i]['money'];
			// mp($res);
		}
		return $res;
	}
	

	
}