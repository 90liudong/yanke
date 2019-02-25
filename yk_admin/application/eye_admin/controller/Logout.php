<?php
namespace app\eye_admin\controller;
use think\Controller;
class Logout extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }

    function logout_deal(){
    	session(null);
    	return $this->redirect("eye_admin/login/login");
    }
}




