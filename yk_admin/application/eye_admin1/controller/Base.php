<?php
namespace app\eye_admin1\controller;
use think\Controller;
class Base extends controller{
	//判断是否登录
	function _initialize(){
		if (!session('?username')) {
			return $this->redirect("eye_admin1/login/login");
		}
	}

}