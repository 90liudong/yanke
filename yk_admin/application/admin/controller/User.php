<?php 
namespace app\admin\controller;
use think\Controller;

class User extends LoginCheck
{
	function index(){
		if (request()->isGet()){
			$page = isset($_GET['page'])?$_GET['page']:1;
			if($page <1){
				$page  = 1;
			}			
			$user = Model('User')->findsuser($page);
			$this->assign('page',$page );
			$this->assign('user',$user);
			return $this->fetch();
			exit;
		}
	}
	function search(){
		$user = Model('User')->finds($_GET["key"]);
		$page = isset($_GET['page'])?$_GET['page']:1;
		$this->assign('page',$page );
		$this->assign('user',$user);
		return $this->fetch('index');
	}
	function add(){
		if (request()->isGet()){
			return $this->fetch();
		}
			 // 获取表单上传文件 
		    $file = request()->file('img');
		    // 移动到框架应用根目录/public/uploads/ 目录下
		    $info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS . 'uploads');
		    if($info){
		        $img = $info->getSaveName();
		    }else{
		        // 上传失败获取错误信息
		        $this->error('上传失败');
		    }
			$User['username'] = $_POST['name'];
			$User['tel']= $_POST['tel'];
			$User['mailbox']= $_POST['mailbox'];
			$User['password']= $_POST['password'];
			$User['sex']= $_POST['sex'];
			$User['time']= time();
			$User['headimg'] = $img;
			Model('User')->inUser($User);
			//添加数据后返回添加页面
			$this->redirect("admin/User/add");

	}
	function update(){
		if (request()->isGet()){
			$user = Model('User')->find($_GET['id']);
			$this->assign('user',$user);
			return $this->fetch();
			}
			//更新数据
			$User['username'] = $_POST['name'];
			$User['tel']= $_POST['tel'];
			$User['mailbox']= $_POST['mailbox'];
			$User['sex']= $_POST['sex'];
			model('User')->where(['id'=>$_POST['id']])->update($User);
			$this->redirect("admin/User/index");
	}

	function dell(){
		model('User')->destroy($_GET['id']);
		$this->redirect("admin/User/index");
	}
}