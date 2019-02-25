<?php
namespace app\eye_admin1\model;
use think\Model;
class Goods extends Model{
	function getAll(){
		header("Content-type: text/html; charset=utf-8");
			$items =$this->alias("i")
			->field("i.id,i.name,i.image,i.sell_price1,i.sell_price2,i.retail_price,i.coupon_price")
			->order('id desc')
			->select();
			return $items;
	}

	function getAllPage($each,$page){
		header("Content-type: text/html; charset=utf-8");
			$items =$this->alias("i")
			->field("i.id,i.name,i.image,i.sell_price1,i.sell_price2,i.retail_price,i.coupon_price")
			->limit(($page-1)*$each,$each)
			->order('id desc')
			->select();
			return $items;
	}

	function search($search){
		header("Content-type: text/html; charset=utf-8");
		$items=$this->alias("i")->field("i.id,i.name,i.image,i.sell_price1,i.sell_price2,i.retail_price,i.coupon_price")
		->where('name','like','%'.$search.'%')
		->order('id desc')
		->select();
		return $items;
	}

	function searchPage($search,$each,$page){
		header("Content-type: text/html; charset=utf-8");
		$items=$this->alias("i")->field("i.id,i.name,i.image,i.sell_price1,i.sell_price2,i.retail_price,i.coupon_price")
		->where('name','like','%'.$search.'%')
		->limit(($page-1)*$each,$each)
		->order('id desc')
		->select();
		return $items;
	}

	function editor($id){
		$items =$this->alias("i")->field("i.name,i.image,i.sell_price1,i.sell_price2,i.retail_price,i.coupon_price,i.detail")
		->where("i.id",$id)
		->select();
		return $items;
	}

}
