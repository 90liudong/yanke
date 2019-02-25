<?php 
namespace app\admin\controller;
use think\Controller;

class Homepoto extends LoginCheck{
	function dell(){
		model('Homepoto')->destroy($_GET['id']);
		$this->redirect("admin/Homepoto/index");
	}
	 function update(){
	 	if (request()->isGet()){
	 		$Homepoto = Model("Homepoto")->findid($_GET["id"]);
	 		$homepoto = $Homepoto[0];
	 		$this->assign("homepoto",$homepoto); 
	 		return $this->fetch();
	 	}
	 	$file = request()->file('image');
		    if($file!=null){
				$info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS .'poto'. DS . 'uploads');
			    if($info){
			        $img = $info->getSaveName();
			        $Homepoto["name"]= $img;
					model('Homepoto')->where(['id'=>$_POST['id']])->update($Homepoto);
			    }else{
			       
			        $this->error('Upload_failed');
			    }
			}    
			// cm($img);
			$this->redirect("admin/Homepoto/index");
		
	 } 
	 function index(){
	 	if (request()->isGet()){
	 		$poto = model("Homepoto")->getpoto();
		 	$this->assign('poto',$poto );
		 	return $this->fetch();
	 }
	 	 	$img = [];
	 	 	$files= request()->file('image');
	 	 	// cm($files);
	 	 	if($files){
		 	 		foreach($files as $file){
				    // 移动到框架应用根目录/public/uploads/ 目录下
				    if($file){
				        $info = $file->move(ROOT_PATH . 'public' . DS .'static'. DS .'poto'. DS . 'uploads');
				        if($info){
						        $img[] = $info->getSaveName();
					    }else{
					        $this->error('Upload_failed');
					    }
				    }
			    }
	 	 	}else{

		 		$this->error("请添加图片");
	 	 	}
    		foreach ($img as $key => $value) {
    			$imgs = ["name"=>$img[$key]];
    			Model("Homepoto")->inpoto($imgs);
    		}
    		// cm($homepoto);
		    
		    $this->redirect("admin/Homepoto/index");
	 	}
	}