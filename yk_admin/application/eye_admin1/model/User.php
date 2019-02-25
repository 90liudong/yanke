<?php
namespace app\eye_admin1\model;
use think\Model;
class User extends Model{

	function getB1(){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.frozen")
		->where('type',1)
		->order('i.time desc')
		->select();
		return $items;
	}
	
	function getB1Page($each,$page){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.frozen")
		->where('type',1)
		->limit(($page-1)*$each,$each)
		->order('i.time desc')
		->select();
		return $items;
	}

	function getB1_2(){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',2)
		->order('i.time desc')
		->select();
		return $items;
	}

	function getB1_2Page($each,$page){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',2)
		->limit(($page-1)*$each,$each)
		->order('i.time desc')
		->select();
		return $items;
	}

	function getB2_1(){
		$items =$this->alias("i")->field("i.type,i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',3)
		->order('i.time desc')
		->select();
		return $items;
	}

	function getB2_1Page($each,$page){
		$items =$this->alias("i")->field("i.type,i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',3)
		->order('i.time desc')
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	function getB2_2(){
		$items =$this->alias("i")->field("i.type,i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',4)
		->order('i.time desc')
		->select();
		return $items;
	}

	function getB2_2Page($each,$page){
		$items =$this->alias("i")->field("i.type,i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',4)
		->order('i.time desc')
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}
	
	function getC1(){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.consume,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',5)
		->order('i.time desc')
		->select();
		return $items;
	}

	function getC1Page($each,$page){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.consume,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where('i.type',5)
		->limit(($page-1)*$each,$each)
		->order('i.time desc')
		->select();
		return $items;
	}

	//用户搜索
	function users_search($cond){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.consume,i.profit,i.totalprofit,i.addr,i.unit,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where($cond)
		->order('i.id desc')
		->select();
		return $items; 
	}

	function users_searchPage($cond,$each,$page){
		$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.consume,i.profit,i.totalprofit,i.addr,i.unit,i.frozen,u.nickname unickname")
		->join("user u","i.up_uid=u.id","left")
		->where($cond)
		->order('i.id desc')
		->limit(($page-1)*$each,$each)
		->select();
		foreach ($items as $key => $value){
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}

	// //根据用户注册时间来搜索
	// function users_time_search($strtime,$endtime,$u_type){
	// 	$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.consume,i.profit,i.totalprofit,i.addr,i.unit,u.nickname unickname")
	// 	->join("user u","i.up_uid=u.id","left")
	// 	->where('i.type',$u_type)
	// 	->where('i.time','between',[$strtime,$endtime])
	// 	->order('i.id desc')
	// 	->select();
	// 	return $items; 
		
	// }

	// function users_time_searchPage($strtime,$endtime,$u_type,$each,$page){
	// 	$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.consume,i.profit,i.totalprofit,i.addr,i.unit,u.nickname unickname")
	// 	->join("user u","i.up_uid=u.id","left")
	// 	->where('i.type',$u_type)
	// 	->where('i.time','between',[$strtime,$endtime])
	// 	->order('i.id desc')
	// 	->limit(($page-1)*$each,$each)
	// 	->select();
	// 	return $items;
	// }

	// //根据用户昵称来搜索（模糊查询）
	// function users_name_search($search,$u_type){
	// 	$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.consume,i.profit,i.totalprofit,i.addr,i.unit,u.nickname unickname")
	// 	->join("user u","i.up_uid=u.id","left")
	// 	->where('i.type',$u_type)
	// 	->where('i.nickname','like','%'.$search.'%')
	// 	->order('i.id desc')
	// 	->select();
	// 	return $items;
	// }

	// function users_name_searchPage($search,$u_type,$each,$page){
	// 	$items =$this->alias("i")->field("i.id,i.type,i.headimg,i.nickname,i.tel,i.true_name,i.time,i.goods_price,i.consume,i.profit,i.totalprofit,i.addr,i.unit,u.nickname unickname")
	// 	->join("user u","i.up_uid=u.id","left")
	// 	->where('i.type',$u_type)
	// 	->where('i.nickname','like','%'.$search.'%')
	// 	->order('i.id desc')
	// 	->limit(($page-1)*$each,$each)
	// 	->select();
	// 	return $items;
	// }

	//患者的user用s表示  代理的user表用u表示
	//代理查看交易记录的数据
	function getbOds($id){
		//$id是代理的id
		// $items = $this->alias("u")->field("o.id oid,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.unit_price,o.price,u.true_name,u.tel utel,s.id,s.type,s.nickname,s.tel stel,g.name,g.image,g.sell_price1,g.sell_price2,p.money")
		// ->join("orders o","o.up_uid=u.id","left")
		// ->join("user s","s.id=o.c_uid","left")
		// ->join("goods g","o.gid=g.id","left")
		// ->join("profit p","p.oid=o.id","left")
		// ->where('u.id',$id)
		// ->where("p.uid",$id)
		// ->select();
		// return $items;
		$items=db("orders")->alias("o")->field("o.id oid,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.unit_price,o.price,u.true_name,u.tel utel,s.id,s.type,s.nickname,s.tel stel,g.name,g.image,g.sell_price1,g.sell_price2,p.money")
		->join("profit p","p.oid=o.id","left")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		// ->where('u.id',$id)
		->where("p.uid",$id)
		->select();
		return $items;
		// $data1=
	}
	// function digui($id){
	// do{
	// 	$item = db('user')->field('up_uid,id')->where(['id'=>$id])->find();
	// 	$i = $item['id'];
	// 	$id = $item['up_uid'];
	// 	$up_uid = $item['up_uid'];
	// }while($up_uid!=0);
	// return $i;
	// }

	function getbOdsPage($id,$each,$page){
		// $items = $this->alias("u")->field("o.id oid,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.unit_price,o.price,u.true_name,u.tel utel,s.id,s.type,s.nickname,s.tel stel,g.name,g.image,g.sell_price1,g.sell_price2,p.money")
		// ->join("orders o","o.up_uid=u.id","left")
		// ->join("user s","s.id=o.c_uid","left")
		// ->join("goods g","o.gid=g.id","left")
		// ->join("profit p","p.oid=o.id","left")
		// ->where('u.id',$id)
		// ->where("p.uid",$id)
		// ->limit(($page-1)*$each,$each)
		// ->select();
		// return $items;
		$items=db("orders")->alias("o")->field("o.id oid,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.unit_price,o.price,u.true_name,u.tel utel,s.id,s.type,s.nickname,s.tel stel,g.name,g.image,g.sell_price1,g.sell_price2,p.money")
		->join("profit p","p.oid=o.id","left")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		// ->where('u.id',$id)
		->where("p.uid",$id)
		->limit(($page-1)*$each,$each)
		->select();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		return $items;
		
	}



	//患者查看交易记录的数据
	function getcOds($id){
		$items = $this->alias("s")->field("o.id oid,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.unit_price,o.price,u.id,u.true_name,u.tel utel,u.type,s.nickname,s.tel stel,g.name,g.image")
		->join("orders o","o.c_uid=s.id","left")
		->join("user u","u.id=s.up_uid","left")
		->join("goods g","o.gid=g.id","left")
		->where('s.id',$id)
		->select();
		return $items;
	}

	function getcOdsPage($id,$each,$page){
		$items = $this->alias("s")->field("o.id oid,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.unit_price,o.price,u.id,u.true_name,u.tel utel,u.type,s.nickname,s.tel stel,g.name,g.image")
		->join("orders o","o.c_uid=s.id","left")
		->join("user u","u.id=s.up_uid","left")
		->join("goods g","o.gid=g.id","left")
		->where('s.id',$id)
		->limit(($page-1)*$each,$each)
		->select();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}
}
