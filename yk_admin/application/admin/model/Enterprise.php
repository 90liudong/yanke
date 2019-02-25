<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Enterprise extends Model{
		function findenterprise(){
		$Enterprise= $this->select();
		return $Enterprise;
		}
		function findAll($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$Enterprise= $this->limit($start,$each)->select();
		return $Enterprise;
		}
		function inEnterprise($e){
			$this->insert($e);
		}
}