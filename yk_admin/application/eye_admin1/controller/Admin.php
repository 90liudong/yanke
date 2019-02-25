<?php
namespace app\eye_admin1\controller;
use think\Controller;
class Admin extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }

	//主页的页面显示
	function admin(){
		return $this->fetch();
	}

	function index_v1(){
		return $this->fetch();
	}

	//管理员账户页面显示
	function administrator(){
		$items = model("admin")->administrator();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$this->assign("items",$items);
		return $this->fetch();
	}

	//修改管理员密码页面显示
	function editor_view($id){
		$this->assign("id",$id);
		return $this->fetch();
	}

	//修改管理员密码页面显示
	function add_view(){
		return $this->fetch();
	}

	//增加管理员
	function add($username,$password,$confirm_password){
		$res = model("admin")->get(['username' => $username]);
		if ($res) {
			$this->error("此账号已存在","administrator","",3);
		}else{
			if ($password==$confirm_password) {
				$user = model('admin');
				$user->data([
				'username'  =>  $username,
				'password'  =>  $password,
				'type'		=>  0
				]);
				$user->save();
				$this->success("添加成功","administrator","",3);
			}else{
				$this->error("密码不一致","administrator","",3);
			}
		}
	}

	//修改管理员密码
	function editor($id,$new_password,$old_password,$confirm_password){
		$res = model("admin")->get(['password' => $old_password,'id'=>$id]);
		if ($res) {
			if ($new_password==$confirm_password) {
				$cond = model("admin");
				// save方法第二个参数为更新条件
				$cond->save([
				    'password'  => $new_password
				],['id' => $id]);
				$this->success("修改成功","administrator","",3);
			}else{
				$this->error("密码不一致","administrator","",3);
			}
		}else{
			$this->error("旧密码不正确","administrator","",3);
		}
	}

	//删除管理员
	function delete($id){
		model("admin")->destroy(['id' => $id]);
		$this->success("删除成功","administrator","",3);
	}

}