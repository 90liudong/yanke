<?php
namespace app\eye_admin\controller;
use think\Controller;
class Base extends controller{
	//判断是否登录
	function _initialize(){
		if (!session('?username')) {
			return $this->redirect("eye_admin/login/login");
		}
	}

}