<?php
namespace app\eye_admin\controller;
use think\Controller;
class Login extends controller{
	//显示登录页面
	function login(){
		return $this->fetch();
	}

	//登录功能
	function login_deal($username,$password){
		if(!captcha_check($_POST['code'])){
			$this->error('验证码错误');
		}
		$res = model("admin")->get(['username' => $username,'password'=>$password]);
		if ($res) {
			session('username', $res["username"]);
			session('user_type',$res["type"]);
			$this->success("登录成功","eye_admin/admin/admin","",1);
			
		}else{
			$this->error("登录失败");
		}

	}
	// function login(){

	// 		if (request()->isGet()) {
	// 			return $this->fetch();
	// 		}else{

	//       if(!captcha_check($_POST['code'])){
	//               //验证码错误
	//               $this->error('验证码错误');
	//       }
	// 			$username = $_POST['name'];
	// 			$password = $_POST['password'];
	// 			// echo "string";exit;
	// 			$admin = model('communityManage');
	// 			$result = $admin -> findAdministrator($username);
	//       if(empty($result)){
	//           return $this->error('用户名没注册，请先注册');
	//         }else{
	//           if($result['password']!=$password){
	//            return $this->error('密码错误');
	//            }else{          
	//               session("admin_community",$result['name']);
	//               session("cid",$result['id']);
	//               $this->redirect('community_community/manage/index');
	            
	// 			}
	// 		}
	// 	}
	// }

}
	