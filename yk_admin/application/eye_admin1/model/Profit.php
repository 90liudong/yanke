<?php
namespace app\eye_admin1\model;
use think\Model;
class Profit extends Model{
	//收入记录
	function income(){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->order('p.id desc')
		->select();
		return $items;
	}

	function incomePage($each,$page){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->limit(($page-1)*$each,$each)
		->order('p.id desc')
		->select();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}

	//收入记录的搜索
	function income_search($cond){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where($cond)
		->order('p.id desc')
		->select();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}

	function income_searchPage($cond,$each,$page){
		$items = $this->alias("p")->field("p.oid,p.uid,p.money,p.time,u.id,u.type,u.tel,u.true_name,u.nickname,o.price,o.id")
		->join("user u","p.uid=u.id","left")
		->join("orders o","p.oid=o.id","left")
		->where($cond)
		->limit(($page-1)*$each,$each)
		->order('p.id desc')
		->select();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		return $items;
	}
}