<?php
namespace app\eye_admin\model;
use think\Model;
class Profit extends Model{
	//收入记录
	function getincome(){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->select();
		return $items;
	}

	function getincomePage($each,$page){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	//根据type筛选用户类型
	function gettype($a){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where("u.type",$a)
		->select();
		return $items;
	}

	function gettypePage($a,$each,$page){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where("u.type",$a)
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	//根据日期
	function income_time($strtime,$endtime){
		$items= $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where('p.time','between',[$strtime,$endtime])
		->select();
		return $items;
	}

	function income_timePage($strtime,$endtime,$each,$page){
		$items= $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where('p.time','between',[$strtime,$endtime])
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	//根据用户昵称
	function income_name($search){
		$items= $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where("u.nickname",'like','%'.$search.'%')
		->select();
		return $items;
	}

	function income_namePage($search,$each,$page){
		$items= $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where("u.nickname",'like','%'.$search.'%')
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

}