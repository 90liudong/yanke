<?php 
namespace app\admin\controller;
use think\Controller;

class Profession extends LoginCheck{
	function two(){
		if (request()->isGet()){
			if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;;
				if($page <1){
					$page  = 1;
				}
			$Profession = Model('Profession')->findPro($page);
				foreach ($Profession as $key => $value) {
						$p = $Profession[$key]['pid'];
						$p = Model('Profession')->findpid($p);
						$Profession[$key]['pro'] = $p[0]['name'];
					}
			$pro = Model('Profession')->findzero();	
			$this->assign('Profession',$Profession);
			$this->assign('page',$page);
			$this->assign('pro',$pro);
			return $this->fetch();
			}
		}
	}

	function index(){
		if (request()->isGet()){
			if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;;
				if($page <1){
					$page  = 1;
				}
			
			$Profession = Model('Profession')->findProfession($page);

				// foreach ($Profession as $key => $value) {
				// 		$p = $Profession[$key]['pid'];
				// 		$p = Model('Profession')->findpid($p);
				// 		$Profession[$key]['pro'] = $p['name'];
				// 	}

			$this->assign('Profession',$Profession);
			$this->assign('page',$page);
			return $this->fetch();
			}
		}
	}

	function add(){
		$name = $_POST['name'];
		Model('Profession')->inprofession($name);
		$this->redirect("admin/Profession/index");
	}
	function push(){
		$name = $_POST['name'];
		$pid = $_POST['pid'];
		Model('Profession')->infession($name,$pid);
		$this->redirect("admin/Profession/two");
	}
	function dell(){
		model('Profession')->destroy($_GET['id']);
		$this->redirect("admin/Profession/index");
	}

	function update(){
		if (request()->isGet()){
			$profession = Model('Profession')->findid($_GET['id']);
			$profession = $profession[0];
			$this->assign('profession',$profession);
			return $this->fetch();
			}
			$pro['name'] = $_POST['name'];
			model('Profession')->where(['id'=>$_POST['id']])->update($pro);
			$this->redirect("admin/Profession/two");
		}

}