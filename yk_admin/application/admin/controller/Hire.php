<?php 
namespace app\admin\controller;
use think\Controller;

class Hire extends LoginCheck{
		function index(){
				if (request()->isGet()){
				$page = isset($_GET['page'])?$_GET['page']:1;
				if($page <1){
					$page  = 1;
				}			
				$hire = Model('Hire')->findhire($page);
				$this->assign('page',$page );
				$this->assign('hire',$hire);
				return $this->fetch();
				exit;
			}
		}
		function del(){
			model('hire')->destroy($_GET['id']);
			$this->redirect("admin/hire/index");
		}
		function update(){
		if (request()->isGet()){
			$hire = Model("hire")->findh($_GET['id']);
			$Area = Model("Area")->findcity();
			$enterprise =Model("Enterprise")->findenterprise();
			$profession =Model('profession')->findp();
			foreach ($hire as $key => $value) {
				$hire = $value;
			}
			// cm($hire);
			$this->assign('hire',$hire);
			$this->assign('profession',$profession);
			$this->assign('enterprise',$enterprise);
			$this->assign('area',$Area);
			return $this->fetch();
		}
			
		    $file = request()->file('image');
		    if($file!=null){
				$info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS .'enterprise'. DS . 'uploads');
			    if($info){
			        $img = $info->getSaveName();
			    }else{
			       
			        $this->error('Upload_failed');
			    }
			    $hire['image'] = $img;
		    }
		    $hire['salary']= $_POST['salary'];
		    $welfare= $_POST['welfare'];
		    $hire['welfare']=$welfare;
			$hire['title'] = $_POST['title'];
			$hire['intro']= $_POST['intro'];
			$hire['area_id']= $_POST['area_id'];
			$hire['profession_id']= $_POST['profession_id'];
			$hire['enterprise_id']= $_POST['enterprise_id'];
			$hire['time']= $_POST["time"];
			$hire['balance']= $_POST['balance'];
			$hire['addr']= $_POST['addr'];
			$hire['requirement']= $_POST['requirement'];
			$hire['role']= $_POST['role'];
			// $hire['validity']= $_POST['validity'];
			model('hire')->where(['id'=>$_POST['id']])->update($hire);
			$this->redirect("admin/hire/index");
	}
		function add(){
			if (request()->isGet()){
			$Area = Model("Area")->findcity();
			$enterprise =Model("Enterprise")->findenterprise();
			$profession =Model('profession')->findp();
			$this->assign('profession',$profession);
			$this->assign('enterprise',$enterprise);
			$this->assign('area',$Area);
			return $this->fetch();
		}
			 $file = request()->file('image');
			 if($_POST['salary1']==null||$_POST['salary2']==null||$_POST['title']==null||$_POST['intro']==null||$_POST['addr']==null||$_POST['balance']==null||$_POST['requirement']==null||$_POST['role']==null||$_POST['welfare']==null||$_POST['validity']==null||$file==null){
					$this->error('填写内容not null !');
				}
		    if($file!=null){
				$info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS .'enterprise'. DS . 'uploads');
			    if($info){
			        $img = $info->getSaveName();
			    }else{
			       
			        $this->error('Upload_failed');
			    }
			    $hire['image'] = $img;
		    }
		    if($_POST['salary1']<$_POST['salary2']){
		    	$salary1 = $_POST['salary1']+"";
		    	$salary2 = $_POST['salary2']+"";
		    }
		    if($_POST['salary1']==$_POST['salary2']){
		    	$salary = $_POST['salary1'];
		    }
		    $salary1 = $_POST['salary2']+"";
		    $salary2 = $_POST['salary1']+"";		    		    
		    $salary = $salary1."-".$salary2;
		    $hire['salary']= $salary;
			$hire['title'] = $_POST['title'];
			$hire['intro']= $_POST['intro'];
			$hire['area_id']= $_POST['area_id'];
			$hire['profession_id']= $_POST['profession_id'];
			$hire['enterprise_id']= $_POST['enterprise_id'];
			$hire['time']= time();
			$hire['balance']= $_POST['balance'];
			$hire['addr']= $_POST['addr'];
			$hire['requirement']= $_POST['requirement'];
			$hire['role']= $_POST['role'];
			$hire['welfare']= $_POST['welfare'];
			$hire['validity']= $_POST['validity'];
			Model('hire')->inhire($hire);
			
			$this->redirect("admin/hire/index");
		}
}