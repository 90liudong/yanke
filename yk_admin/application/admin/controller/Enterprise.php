<?php 
namespace app\admin\controller;
use think\Controller;

class Enterprise extends Controller{
	function add(){
		if (request()->isGet()){
			return $this->fetch();
		}
		$e['name']=$_POST["name"];
		$e['tel']=$_POST["tel"];
		$e['contact']=$_POST["contact"];
		$e['addr']=$_POST["addr"];
		$e['type']=$_POST["type"];
		$e['intro']=$_POST["intro"];
		Model('Enterprise')->inEnterprise($e);
			//添加数据后返回添加页面
		$this->redirect("admin/Enterprise/index");
	}
	function update(){
		if (request()->isGet()){
			$ent = Model('Enterprise')->find($_GET['id']);
			$this->assign('ent',$ent);
			return $this->fetch();
			}
			$ent['name'] = $_POST['name'];
			$ent["type"] = $_POST['type'];
			$ent["addr"] = $_POST['addr'];
			// $ent["contact"] = $_POST['contact'];
			// $ent["tel"] = $_POST['tel'];
			$ent["intro"] = $_POST['intro'];
			model('Enterprise')->where(['id'=>$_POST['id']])->update($ent);
			$this->redirect("admin/Enterprise/index");
	}
	function del(){
		model('Enterprise')->destroy($_GET['id']);
		$this->redirect("admin/Enterprise/index");
	}
	function index(){
		if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;;
				if($page <1){
					$page  = 1;
				}
			$Ent = Model('Enterprise')->findAll($page);
			$this->assign('page',$page );
			$this->assign("ent",$Ent);
			return $this->fetch();
			}
		}	
}