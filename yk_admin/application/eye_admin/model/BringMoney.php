<?php
namespace app\eye_admin\model;
use think\Model;
class BringMoney extends Model{
	//提现记录
	function getpickmoney(){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->order('status')
		->select();
		return $items;
	}
	

	function getpickmoneyPage($each,$page){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->limit(($page-1)*$each,$each)
		->order('status')
		->select();
		return $items;
	}

	//根据用户类型筛选提现记录
	function gettype($a){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where("u.type",$a)
		->select();
		return $items;
	}

	function gettypePage($a,$each,$page){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where("u.type",$a)
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	//根据日期
	function pickup_time($strtime,$endtime){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where('b.time','between',[$strtime,$endtime])
		->select();
		return $items;
	}

	function pickup_timePage($strtime,$endtime,$each,$page){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where('b.time','between',[$strtime,$endtime])
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	//根据昵称
	function pickup_name($search){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where("u.nickname",'like','%'.$search.'%')
		->select();
		return $items;
	}

	function pickup_namePage($search,$each,$page){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where("u.nickname",'like','%'.$search.'%')
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}

	//筛选申请状态
	function apply_statu($b){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where("b.status",$b)
		->select();
		return $items;
	}

	function apply_statuPage($b,$each,$page){
		$items = $this->alias("b")->field("b.uid,b.num,b.time,b.status,b.bank,b.name,b.id,u.type,u.tel,u.true_name,u.nickname")
		->join("user u","b.uid=u.id")
		->where("b.status",$b)
		->limit(($page-1)*$each,$each)
		->select();
		return $items;
	}
}
