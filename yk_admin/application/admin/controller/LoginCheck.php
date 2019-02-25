<?php 
namespace app\admin\controller;
use think\Controller;

class LoginCheck extends Controller{
	function _initialize(){
		if(!session('?admin')){
			$this->redirect("location:admin/login/index");
			exit;
		}
	}
}