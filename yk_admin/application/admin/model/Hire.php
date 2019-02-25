<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Hire extends Model{
	function findarea($id){
		$hire =$this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e","e.id=h.enterprise_id","left")->field('a.name Area,e.name enterprise,h.salary,h.title name,h.image imgs,h.id hid,h.balance')->order("h.id desc")->where("h.area_id",$id)->select();
		return $hire;
	}
	function findname($name){
		$hire =$this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e","e.id=h.enterprise_id","left")->where('h.title','like','%'.$name.'%')->field('h.title,a.name Area,e.name enterprise,h.welfare,h.salary,h.title name,h.image imgs,h.id hid,h.balance')->order("h.id desc")->select();
		return $hire;
	}
	function finds(){
		// pagehome 下面的招聘广告->limit(5)
		$hire =$this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e","e.id=h.enterprise_id","left")->field('a.name Area,e.name enterprise,h.salary,h.title name,h.image imgs,h.id hid,h.balance')->order("h.id desc")->select();
		return $hire;
	}
	function findlast($hid){
		// Vice 的招聘广告
		$hire = $this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e",'e.id=h.enterprise_id','left')->join("profession f",'f.id=h.profession_id','left')->field('h.title,h.intro,h.time,h.image,h.salary,h.balance,h.addr,h.requirement,h.role,h.welfare,h.validity,a.name aname,e.name ename,f.name fname,h.id,e.contact,e.addr eaddr,e.type,e.intro eintro,e.tel,h.balance')->where('h.id',$hid)->select();
		// cm($hire);
		return $hire;
	}
	function g($id,$aid){
		$hire =$this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e","e.id=h.enterprise_id","left")->where("h.profession_id",$id)->whereOr("a.id",$aid)->field('a.name Area,e.name enterprise,h.salary,h.title name,h.image imgs,h.id hid,h.balance')->order("h.id desc")->select();
		return $hire;
	}
	function find($cond){
		// other 下面的招聘广告->where("a.id",$aid)->where("h.title","like",'%'.$name.'%')
		$hire =$this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e","e.id=h.enterprise_id","left")->where($cond)->field('a.name Area,e.name enterprise,h.salary,h.title name,h.image imgs,h.id hid,h.balance')->order("h.id desc")->select();
		return $hire;
	}
	function findh($id){
		$hire = $this->alias('h')->join("Area a",'a.id=h.area_id','left')->join("enterprise e",'e.id=h.enterprise_id','left')->join("profession f",'f.id=h.profession_id','left')->field('h.title,h.intro,h.time,h.image,h.salary,h.balance,h.addr,h.requirement,h.role,h.welfare,h.validity,a.name aname,e.name ename,f.name fname,h.id')->where('h.id',$id)->select();
		// cm($hire);
		return $hire;
	}
	function inhire($hire){
		$this->insert($hire);
	}
	function findhire($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$hire = $this->alias('h')->limit($start,$each)->join("Area a",'a.id=h.area_id','left')->join("enterprise e",'e.id=h.enterprise_id','left')->join("profession f",'f.id=h.profession_id','left')->field('h.title,h.intro,h.time,h.image,h.salary,h.balance,h.addr,h.requirement,h.role,h.welfare,h.validity,a.name aname,e.name ename,f.name fname,h.id')->select();
		// cm($hire);
		return $hire;
	}
}