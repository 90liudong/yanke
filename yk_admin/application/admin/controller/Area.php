<?php 
namespace app\admin\controller;
use think\Controller;

class Area extends LoginCheck
{
	function index(){
		if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;;
			if($page <1){
				$page  = 1;
			}
			$Area = Model('Area')->findArea($page);
			foreach ($Area as $key => $value) {
					$a = $Area[$key]['pid'];
					$a = Model('Area')->findpid($a);
					$Area[$key]['pro'] = $a[0]['name'];
				}	
			$this->assign('area',$Area);
			$this->assign('page',$page);
			return $this->fetch();
		}
	}
	function update(){
		if (request()->isGet()){
			$area = Model('Area')->find($_GET['id']);
			$this->assign('area',$area);
			return $this->fetch();
			}
			$area['name'] = $_POST['name'];
			model('Area')->where(['id'=>$_POST['id']])->update($area);
			$this->redirect("admin/Area/addprovince");
	}		
	function del(){
		model('Area')->destroy($_GET['id']);
		$this->redirect("admin/Area/index");
	}
	function addprovince(){
		if (request()->isGet()){
			$area = Model('Area')->findprovine();
			$this->assign('area',$area);
			return $this->fetch();
		}
		Model('Area')->inprovine($_POST['name']);
		$this->redirect("admin/Area/addprovince");
	}

	function addcity(){
		if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;;
			if($page <1){
				$page  = 1;
			}
			$Area = Model('Area')->findArea($page);
			foreach ($Area as $key => $value) {
					$a = $Area[$key]['pid'];
					$a = Model('Area')->findpid($a);
					$Area[$key]['pro'] = $a[0]['name'];
				}	
			$this->assign('area',$Area);
			$this->assign('page',$page);
			$provine = Model('Area')->findprovine();
			$this->assign("provine",$provine);
			return $this->fetch();
		}
		Model('Area')->incity($_POST['name'],$_POST['pid']);
		$this->redirect("admin/Area/addcity");
	}

	
}