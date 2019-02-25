<?php 
namespace app\admin\controller;
use think\Controller;

class Login extends Controller{
	function getarea($id){
		if($id==0){
			$p =model("hire")->finds();
			echo json_encode($p);
			exit;
		}else{
		$p = model("hire")->findarea($id);
		echo json_encode($p);
		}
		
	}
	function pagehomes(){
		$p = model("hire")->finds();
		echo json_encode($p);
	}
	function pa($name){
		$p = model("hire")->findname($name);
		for($i=0;$i<count($p);$i++){
			$p[$i]['welfare'] = explode(",", $p[$i]["welfare"]);
		}
		echo json_encode($p);
	}
	function pagehome(){
		$pagehome = model("profession")->findzero();
		$Area = Model("Area")->findcity();
		$homepoto = Model("Homepoto")->getpoto();
		for($i=0;$i<count($homepoto);$i++){
			$pages["poto"][]=$homepoto[$i];
		}
		for($i=0;$i<count($Area);$i++){
			$pages["area"][] = $Area[$i];
		}
		$pages["pagehome"] = $pagehome;
		echo json_encode($pages);
		//拿工种 pid=0的职位 ；招聘广告的名字和工资 福利还有地址 和公司名字
	}
	function other($pid){
		$other =model ("profession")->find($pid);
		$Area = Model("Area")->findcity();
		for($i=0;$i<count($Area);$i++){
			$others["area"][] = $Area[$i];
		}
		$others["other"] =$other;
		echo json_encode($others);
		//将工种的id 找到  在找第二类职位的pid；招聘广告的名字和工资 福利还有地址 和公司名字
	}
	function othertwo($aid=0,$name="",$id=0){
		$cond = [];
		if($aid!=0){
			$cond['area_id'] = $aid;
		}
		if($id!=0){
			$cond['profession_id']=$id;
		}
		if($name){
			$cond['title'] = ['like',"%".$name."%"];
		}
		$other =model ("hire")->find($cond);
		echo json_encode($other);
	}
	function vice($hid){
		$vice =model("hire")->findlast($hid);
		for($i=0;$i<count($vice);$i++){
			$vice[$i]['time'] =date('Y-m-d',$vice[$i]["time"]);
			$vice[$i]['welfare'] = explode(",", $vice[$i]["welfare"]);
		}
		echo json_encode($vice);
		//拿招聘广告的全部内容
	}
	function inEnroll(){
		if($_GET["qt"]==null){
			$qt = "";
		}
		$success = [];
		if($_GET["school"]== null|| $_GET["tel"]==null|| $_GET["name"]==null||$_GET["q"]==null){
			$success["back"] = 1;
			echo json_encode($success);
			exit;
		}
		$Enroll["school"]=$_GET["school"];
		$Enroll["qt"]=$_GET["qt"];
		$Enroll["q"] = $_GET["q"];
		$Enroll["hireid"] = $_GET["hid"];
		$Enroll["status"] = 1;
		$Enroll["time"] = time();
		$Enroll["name"]= $_GET['name'];
		$Enroll['tel'] = $_GET["tel"];
		Model("Enroll")->inEnroll($Enroll);
		$success["hid"] = $_GET["hid"];
		$success["back"] = 2;
		echo json_encode($success);	
	}
	
	function index(){
		return $this->fetch();
	}
	function logout(){
		session("admin",null);
		$this->redirect("admin/index/index");
	}
	function login($code){
		if(!captcha_check($code)){
			 //验证失败
			$this->error('验证码错误');
			}
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(Model("manager")->intrue($username,$password)){
			session('admin',$username);
			$this->redirect("admin/index/index");
			exit;
		}
		$this->error("账号或者密码错误!");
	}
}