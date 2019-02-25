<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Profession extends Model{
	function findid($id){
		$p = $this->where('id',$id)->select();
		return $p;
	}
	function find($pid){
		$p = $this->where('pid',$pid)->select();
		return $p;
	}
	function findzero(){
		$p = $this->alias('p')->where('pid',0)->select();
		return $p;
	}
	function findp(){
		$Enterprise= $this->where('pid','neq','0')->select();
		return $Enterprise;
		}
	function findPro($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$p = $this->where('pid','neq','0')->limit($start,$each)->select();
		return $p;
	}
	function findpid($p){
		$p= $this->where('id',$p)->select();
		return $p;
	}
	function findProfession($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$p = $this->where('pid','0')->limit($start,$each)->select();
		return $p;
	}
	function infession($name,$pid){
		$pro['name'] =$name;
		$pro['pid'] =$pid;
		$this->insert($pro);
	}
	function inprofession($name){
		$pro['name'] = $name;
		$pro['pid'] = 0;
		$this->insert($pro);
	}
}