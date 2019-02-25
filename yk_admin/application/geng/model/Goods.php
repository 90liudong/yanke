<?php
namespace app\geng\model;
use think\Model;

class Goods extends Model
{
	function getpro($id){
		// mp($id);
		$item = db('user')->alias('u')->where(['id'=>$id])->select();
		// mp($item);
		$type = $item[0]['type'];
		$up_uid = $item[0]['up_uid'];
		// mp($id);
		// mp($up_uid);
		if($type==5){
			$pro = db('goods')->order('id desc')->select();
			// mp($pro);
			return $pro;
		}else if($type==4){
			$data = db('user')->alias('u')->where(['id'=>$up_uid])->select();
			$up_uid = $data[0]['up_uid'];
			// mp($up_uid);
			$items = db('goods')->alias('g')->field('g.id gid,g.name,g.image,g.sell_price1,g.sell_price2,g.retail_price,g.coupon_price,g.detail,g.time')->order('time desc')->select();
			$res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')->where(['uid'=>$up_uid])->select();
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
		}else if($type==3||$type==2){
			$items = db('goods')->alias('g')->field('g.id gid,g.name,g.image,g.sell_price1,g.sell_price2,g.retail_price,g.coupon_price,g.detail,g.time')->order('time desc')->select();
			$res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')->where(['uid'=>$up_uid])->select();
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
		}else if($type==1){
			$items = db('goods')->alias('g')->field('g.id gid,g.name,g.image,g.sell_price1,g.sell_price2,g.retail_price,g.coupon_price,g.detail,g.time')->order('time desc')->select();
			$res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')->where(['uid'=>$id])->select();
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
	function prodetail($gid,$uid){
		$data = db('b1_goods')->where(['uid'=>$uid,'gid'=>$gid])->field('gid')->select();
		// mp($data);
		if($data){
			$res = db('goods')->alias('g')->field('g.name,g.image,g.sell_price1,g.sell_price2,g.retail_price,g.coupon_price,g.detail,g.time,b.num')->join('b1_goods b','b.gid=g.id')->where(['g.id'=>$gid,'b.uid'=>$uid])->select();
			return $res;
		}else{
			$res = db('goods')->alias('g')->field('g.name,g.image,g.sell_price1,g.sell_price2,g.retail_price,g.coupon_price,g.detail,g.time')->where(['g.id'=>$gid])->select();
				$res[0]['num'] = 0;
				return $res;
		}
	}
	function except($id){
		$pro = db('b1_goods') ->alias('b')->field('b.uid,b.gid,b.num,b.status,g.name,g.image,g.sell_price1,g.retail_price,g.coupon_price,g.detail,g.time')->join('goods g','g.id=b.gid') ->where(['b.uid'=>$id,'status'=>1])->select();
			return $pro; 
	}
	
}