<?php
namespace app\eye_admin\model;
use think\Model;
class B1Goods extends Model{
	function getgoods($id){
		$items = $this->alias("b")->field("b.uid,b.gid,b.num,g.name")
		->join("user u","u.id=b.uid","left")
		->join("goods g","g.id=b.gid","left")
		->where("uid",$id)
		->select();
		return $items;
	}

	function getgoodsPage($id,$each,$page){
		$items = $this->alias("b")->field("b.uid,b.gid,b.num,g.name")
		->join("user u","u.id=b.uid","left")
		->join("goods g","g.id=b.gid","left")
		->where("uid",$id)
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	function getnum($gid){
		$items =$this->alias("b")->field("b.num")->where("gid",$gid)->find();
		return $items;
	}

	//B1库存页面
	function b1goods($id){
		$items = $this->alias("b")->field("b.uid,b.gid,b.num,u.id,g.name")
		->join("goods g","b.gid=g.id","left")
		->join("user u","b.uid=u.id","left")
		->where("uid",$id)
		->select();
		return $items;
	}

	function b1goodsPage($id,$each,$page){
		$items = $this->alias("b")->field("b.uid,b.gid,b.num,u.id,g.name")
		->join("goods g","b.gid=g.id","left")
		->join("user u","b.uid=u.id","left")
		->where("uid",$id)
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
		// $items = db('goods')->alias('g')->field('g.id gid,g.name')
		// ->limit(($page-1)*$each,$each)
		// ->select();
		// $res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')
		// ->where(['uid'=>$id])
		// ->select();
		// for($i=0;$i<count($items);$i++){
		// 	$items[$i]['num']=0;
		// 	for($j=0;$j<count($res);$j++){
		// 		if($items[$i]['gid']==$res[$j]['gid']){
		// 			$items[$i]['num']=$res[$j]['num'];
		// 		}
		// 	}
		// }
		// for ($i=0; $i <count($items) ; $i++) { 
		// 	$items[$i]["id"]=$id;
		// }
		// return $items;
	}
	

	//B1库存搜索功能
	function b1goods_search($search,$id){
		$items = db('goods')->alias('g')->field('g.id gid,g.name')
		->where("g.name","like","%".$search."%")
		->select();
		$res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')
		->where(['uid'=>$id])
		->select();
		for($i=0;$i<count($items);$i++){
			$items[$i]['num']=0;
			for($j=0;$j<count($res);$j++){
				if($items[$i]['gid']==$res[$j]['gid']){
					$items[$i]['num']=$res[$j]['num'];
				}
			}
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]["id"]=$id;
		}
		return $items;
	}


	function b1goods_searchPage($search,$id,$each,$page){
	    $items = db('goods')->alias('g')->field('g.id gid,g.name')
	    ->where('name','like','%'.$search.'%')
	    ->limit(($page-1)*$each,$each)
	    ->select();
		$res = db('b1_goods')->alias('b')->field('b.uid,b.gid,b.num')
		->where(['uid'=>$id])
		->limit(($page-1)*$each,$each)
		->select();
		for($i=0;$i<count($items);$i++){
			$items[$i]['num']=0;
			for($j=0;$j<count($res);$j++){
				if($items[$i]['gid']==$res[$j]['gid']){
					$items[$i]['num']=$res[$j]['num'];
				}
			}
		}
		for ($i=0; $i <count($items) ; $i++) { 
			$items[$i]["id"]=$id;
		}
		return $items;
	}
}
