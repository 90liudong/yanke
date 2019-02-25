<?php
namespace app\eye_admin\model;
use think\Model;
class Orders extends Model{
	//患者的user用s表示  代理的user表用u表示
	
	//整个订单表的数据
	function getall(){
		$items =$this->alias("o")->field("o.id")->select();
		return $items;
	}

	function getallPage($each,$page){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=o.c_uid","left")
		->limit(($page-1)*$each,$each)
		->order('id desc')
		->select();
		return $items;

	}

	//根据用户类型拿的数据
	function gettype($a,$cond){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where($cond)
		->order('id desc')
		->select();
		return $items;
	}

	function gettypePage($a,$cond,$each,$page){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where($cond)
		->limit(($page-1)*$each,$each)
		->order('id desc')
		->select();
		return $items;
	}

	//根据发货状态拿数据
	function goods_statu($b,$cond){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where($cond)
		->order('id desc')
		->select();
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		$c=0;
		for ($i=0; $i <count($items) ; $i++) { 
			if ($items[$i]['tk']==$b) {
				$data[]=$items[$i];
				$c=$c+1;
			}
		}
		if ($c==0) {
			$data =array();
		}
		return $data;
	}

	function goods_statuPage($b,$each,$page,$cond){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where($cond)
		->limit(($page-1)*$each,$each)
		->order('id desc')
		->select();
		for ($i=0; $i <count($items) ; $i++) { 
			$res = $items[$i]['tracking'];
			if($res==''){
				$items[$i]['tk'] = 0;
			}else{
				$items[$i]['tk'] = 1;
			}
		}
		$c=0;
		for ($i=0; $i <count($items) ; $i++) { 
			if ($items[$i]['tk']==$b) {
				$data[]=$items[$i];
				$c=$c+1;
			}
		}
		if ($c==0) {
			$data =array();
		}
		return $data;
	}

	//根据用户名字搜索得到的数据
	function getuser($uname,$cond){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where($cond)
		->order('id desc')
		->select();
		return $items;
	}

	function getuserPage($uname,$cond,$each,$page){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where($cond)
		->limit(($page-1)*$each,$each)
		->order('id desc')
		->select();
		return $items;
	}

	//根据用户注册时间搜索
	function ods_time($strtime,$endtime){
		$items =db("orders")->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where('o.time','between',[$strtime,$endtime])
		->order('id desc')
		->select();
		return $items;
	}

	function ods_timePage($strtime,$endtime,$each,$page){
		$items =db("orders")->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where('o.time','between',[$strtime,$endtime])
		->limit(($page-1)*$each,$each)
		->order('id desc')
		->select();
		return $items;
	}

	//根据用户订单号搜索
	function code_search($search){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where("o.code",'like','%'.$search.'%')
		->order('id desc')
		->select();
		return $items;
	}

	function code_searchPage($search,$each,$page){
		$items =$this->alias("o")->field("o.id,o.time,o.code,o.up_uid,o.c_uid,o.gid,o.num,o.price,o.tracking,o.tracking_number,o.unit_price,u.nickname unickname,u.tel utel,u.type utype,s.nickname snickname,s.tel stel,g.name,g.image,g.retail_price,g.coupon_price,a.name aname,a.tel atel,a.addr")
		->join("user u","o.up_uid=u.id","left")
		->join("user s","o.c_uid=s.id","left")
		->join("goods g","o.gid=g.id","left")
		->join("addr a","a.uid=s.id","left")
		->where("o.code",'like','%'.$search.'%')
		->order('id desc')
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}
}