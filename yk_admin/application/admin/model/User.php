<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class User extends Model{
	function findsuser($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$user = $this->limit($start,$each)->select();
		return $user;
	}
	function inUser($User){
		$this->insert($User);
	}
	function finds($key){
		$user = $this->alias('u')->where('u.username','like','%'.$key.'%')->select();
		return $user;
	}
}