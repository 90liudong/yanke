<?php
namespace app\geng\model;
use think\Model;

class B1Goods extends Model
{
	function adds($data){
		// mp($data);
		$item = count($data['gid']);
		for($i=0;$i<$item;$i++){	
		$res = db('b1_goods')->where(['uid'=>$data['id'],'gid'=>$data['gid'][$i]])->update(['status'=>1]);
		}
		return true;
	}
	function deletes($data){
		// mp($data);
		$item = count($data['gid']);
		for($i=0;$i<$item;$i++){	
		$res = db('b1_goods')->where(['uid'=>$data['id'],'gid'=>$data['gid'][$i]])->update(['status'=>0]);
		}
		return true;
	}
	function dispro($id){
		$pro = db('b1_goods') ->alias('b')->field('b.uid,b.gid,b.num,b.status,g.name,g.image,g.sell_price1,g.retail_price,g.coupon_price,g.detail,g.time')->join('goods g','g.id=b.gid') ->where(['b.uid'=>$id,'status'=>0])->select();
			return $pro; 
	}
	

	function kucuns($id){
		$order = [];
		$items = db('goods')->alias('g')->field('g.id gid,g.name,g.image,g.sell_price1,g.sell_price2,g.retail_price,g.coupon_price,g.detail,g.time')->order('time desc')->select();
			// mp($items);
		$res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')->where(['uid'=>$id])->select();
			// mp($res);
			$cc =[];
			for($m=0;$m<count($res);$m++){
				$orders[$m] = db('profit')->field('money,gid')->where(['uid'=>$id,'gid'=>$res[$m]['gid']])->select();
				if(!empty($orders[$m])){
					$order[] = $orders[$m];
				}
				for($d=0;$d<count($order);$d++){
					for($x=0;$x<count($order[$d]);$x++){
						$bb[$d][$x] = $order[$d][$x]['money'];
						$cc[$d]['sumprofit'] = array_sum($bb[$d]);
						$cc[$d]['gid'] = $order[$d][$x]['gid'];
					}
				}
			}
			// mp($order);
			// mp($cc);
			for($k=0;$k<count($items);$k++){
				$items[$k]['sumprofit']=0;
				$temp = $items[$k]['gid'];
				// mp($cc);
				// mp($items[$k]['gid']);
				for($x=0;$x<count($cc);$x++){
					if($cc[$x]['gid']==$temp){
						$items[$k]['sumprofit']=$cc[$x]['sumprofit'];
					}
				}
			}
			// mp($items);
			for($i=0;$i<count($items);$i++){
				$items[$i]['num']=0;
				for($j=0;$j<count($res);$j++){
					$items[$i]['uid']=$res[$j]['uid'];
					if($items[$i]['gid']==$res[$j]['gid']){
						$items[$i]['num']=$res[$j]['num'];
					}
				}
			}
			// mp($items);
			return $items;
	}
}