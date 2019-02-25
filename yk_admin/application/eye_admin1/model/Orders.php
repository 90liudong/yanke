<?php
namespace app\eye_admin1\model;
use think\Model;
class Orders extends Model{
	//患者的user用s表示  代理的user表用u表示
	
	//整个订单表的数据
	function getall(){
		$items =$this->alias("o")->field("o.id")->select();
		return $items;
	}

	function getallPage($each,$page){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,o.status,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=o.c_uid","left")
		->limit(($page-1)*$each,$each)
		->order('o.id desc')
		->select();
		return $items;

	}

	//搜索
	function ods_search($cond){
		$items = db("orders")->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,o.status,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=o.c_uid","left")
		->where($cond)
		->order('o.id desc')
		->select();
		return $items;

	}

	function ods_searchPage($cond,$each,$page){
		$items = db("orders")->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,o.status,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=o.c_uid","left")
		->where($cond)
		->limit(($page-1)*$each,$each)
		->order('o.id desc')
		->select();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}

}