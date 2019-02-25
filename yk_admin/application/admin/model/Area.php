<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Area extends Model{
	function findcity(){
		$area= $this->where('pid','neq','0')->select();
		return $area;
	}
		function findArea($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$area= $this->where('pid','neq','0')->limit($start,$each)->select();
		return $area;
		}
		function findpid($a){
			$area= $this->where('id',$a)->select();
			return $area;
		}
		function inprovine($name){
			$area['name'] = $name;
			$area['pid'] = 0;
			$this->insert($area);
		}
		function findprovine(){
			$provine = $this->where('pid',0)->select();
			return $provine;
		}
		function incity($name,$pid){
			$city['name'] = $name;
			$city['pid']= $pid;
			$this->insert($city);
		}

	}