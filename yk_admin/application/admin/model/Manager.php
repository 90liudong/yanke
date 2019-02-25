<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Manager extends Model{
	function intrue($username,$password){
		$num = $this->where(['managername'=>$username,'password'=>$password])->count();
		if($num>0){
			return true;
		}else{
			return false;
		}
	}
}