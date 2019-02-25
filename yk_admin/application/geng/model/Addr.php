<?php
namespace app\geng\model;
use think\Model;

class Addr extends Model
{
	function address($data){
		$res = db('addr')->where(['uid'=>$data['c_uid']])->find();
		
		if($res){
			$res = db('addr')->where(['uid'=>$data['c_uid']])->update(['name'=>$data['name'],'tel'=>$data['tel'],'addr'=>$data['addr']]);
			return true;
		}else{
			$res = db('addr')->insert(['uid'=>$data['c_uid'],'name'=>$data['name'],'tel'=>$data['tel'],'addr'=>$data['addr']]);
			return true;
		}
	}
	function isaddrs($id){

		$res = db('addr')->where(['uid'=>$id])->find();
		if($res){
			return $res;
		}else{
			return false;
		}
		
	}
}