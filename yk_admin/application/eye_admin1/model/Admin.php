<?php
namespace app\eye_admin1\model;
use think\Model;
class Admin extends Model{
	function administrator(){
		$items = db("admin")->alias("a")->field("a.username,a.password,a.type,a.id")->select();
		return $items;
	}
}