<?php
namespace app\eye_admin\controller;
use think\Controller;
class Slider extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }
	
	//轮播图管理页面
	function slider(){
		$items = model("images")->getall();
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$this->assign("items",$items);
		return $this->fetch();
	}

	//轮播图片上传功能
	function upload_deal(){
		$items = model("images")->getall();
		$amount = count($items);
		if($amount<5){
			// 产品的上传功能
		    $file = request()->file('picture');
		    // 上传移动到的目录
		    if($file){
		        $info = $file->validate(['size'=>9999999,'ext'=>'bmp,jpg,png,tiff,pcx,tga,exif,fpx,svg,psd,cdr,pcd,dxf,gif'])->move(ROOT_PATH . 'public' . DS .'static'. DS.'uploads'.DS.'slider_pic');
		        if($info){
		            // // 成功上传后 获取上传信息		      
		            $savename=$info->getSaveName();
		            $cond = model('images');
					// 获取数据并添加进数据库
					$cond->data([
					    'image'  =>  $savename
					]);
					$cond->save();		
					$this->success("上传成功","slider","",1);
		        }else{
		            // 上传失败获取错误信息
		            // echo $file->getError();
		           $this->error("上传失败","slider","",4);
		        }
			}else{
				$this->error("上传失败","slider","",4);
			}
			// $cond = model('images');
			// // 获取数据并添加进数据库
			// $cond->data([
			//     'image'  =>  $savename
			// ]);
			// $cond->save();		
			// $this->success("上传成功","slider","",1);
		}else{
			// 产品的上传功能
		    $file = request()->file('picture');
		    // 上传移动到的目录
		    if($file){
		    	$this->error("上传图片数量超过限制","slider","",6);
		    }
		}
	    
	}

	//轮播图片的删除功能
	function delete($id){
		model("images")->destroy(['id' => $id]);
		$this->success("删除成功","slider","",1);
	}

	//轮播图添加的页面
	function add_view(){
		return $this->fetch();
	}
}