<?php 
namespace app\admin\model;
use think\Model;
use think\Db;

class Enroll extends Model{
	function inEnroll($Enroll){
		$this->insert($Enroll);
	}
	function findall($page){
		$each = 10;
  		$start = ($page - 1)*$each;
		$enroll = $this->alias('en')->limit($start,$each)->join("User u",'u.id=en.uid','left')->join("hire h",'h.id=en.hireid','left')->field('u.username uname,h.title ht,en.tel,en.time,en.name,en.status,en.id,en.q,en.qt,en.school')->order("en.id desc")->select();
		return $enroll;
	}
	function finds($key){
		$user = $this->alias('en')->where('h.title','like','%'.$key.'%')->join("User u",'u.id=en.uid','left')->join("hire h",'h.id=en.hireid','left')->field('u.username uname,h.title ht,en.tel,en.time,en.name,en.status,en.id,en.q,en.qt,en.school')->select();
		return $user;
	}
}