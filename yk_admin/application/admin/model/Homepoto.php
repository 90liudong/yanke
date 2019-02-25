<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

CLass Homepoto extends Model{
		function findid($id){
			$poto = $this->where("id",$id)->select();
			return $poto;
		}
		function getpoto(){
			$poto = $this->select();
			return $poto;
		}
		function inpoto($poto){
			$this->insert($poto);
		}
	}