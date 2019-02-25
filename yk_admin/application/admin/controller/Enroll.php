<?php 
namespace app\admin\controller;
use think\Controller;

class Enroll extends LoginCheck{
	function search(){
		$enroll = Model('Enroll')->finds($_GET["key"]);
		$page = isset($_GET['page'])?$_GET['page']:1;
		$this->assign('page',$page );
		$this->assign("enroll",$enroll);
		return $this->fetch('index');
	}
	function status(){
		$e["status"] =2;
		Model("enroll")->where(['id'=>$_GET['id']])->update($e);
		$this->redirect("admin/enroll/index");
	}
	function index(){
		if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;;
			if($page <1){
				$page  = 1;
			}
		$enroll = Model("Enroll")->findall($page);
		foreach ($enroll as $key => $value) {
			if($value['status']==1){
			$enroll[$key]['status'] ="未读";
		}else{
			$enroll[$key]['status'] ="已读";
		}
		}
		$this->assign('page',$page );
		$this->assign("enroll",$enroll);
		return $this->fetch();
		}
	}
}