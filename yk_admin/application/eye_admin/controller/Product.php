<?php
namespace app\eye_admin\controller;
use think\Controller;
class Product extends Base{
	// public function _initialize(){
 //         $this->judgeLogin();
 //    }

	//商品的添加页面
	function proadd(){
		return $this->fetch();
	}

	//商品的管理页面
	function promanage($each=15,$page=1){
		$item =model("goods")->getAll();
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'promanage?';
		$items =model("goods")->getAllPage($each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		$search=0;
		$this->assign("search",$search);
		return $this->fetch();
	}

	//商品的编辑页面
	function proeditor($id){
		$items = model("goods")->editor($id);
		// mp($items);
		$this->assign("items",$items);
		$this->assign("id",$id);
		return $this->fetch();
	}
	//商品的添加功能
	function add($sdetail){
		// 产品的上传功能
	    $file = request()->file('picture');
	    // 上传移动到的目录
	    if($file){
		        $info = $file->validate(['size'=>9999999,'ext'=>'bmp,jpg,png,tiff,pcx,tga,exif,fpx,svg,psd,cdr,pcd,dxf,gif'])->move(ROOT_PATH . 'public' . DS .'static'. DS.'uploads'.DS.'product_pic');
		        if($info){
		            // // 成功上传后 获取上传信息		      
		            $savename=$info->getSaveName();
		            // mp($savename);
		   //          $mimetype = exif_imagetype($savename);
					// if ($mimetype == IMAGETYPE_GIF || $mimetype == IMAGETYPE_JPEG || $mimetype == IMAGETYPE_PNG || $mimetype == IMAGETYPE_BMP)
					// {
					//  echo "是图片";
					// }
					// exit();
					$cond = model('goods');
					// 获取数据并添加进数据库
					$cond->data([
					    'name'  =>  $_POST["mytextarea"],
					    'image'  =>  $savename,
					    'sell_price1'  =>  $_POST["pri1"],
					    'sell_price2'  =>  $_POST["pri2"],
					    'retail_price'  =>  $_POST["pri3"],
					    'coupon_price'  =>  $_POST["pri4"],
					    'detail'  => $sdetail,
					    'time'  =>  time()
					]);
					$cond->save();
					//给B1用户添加新的商品的库存
					$gid=db("goods")->getLastInsID();
					$items = db("user")->select();
					for ($i=0; $i <count($items) ; $i++) {
						if ($items[$i]["type"]==1) {
						 	db("b1_goods")->insert(['uid'=>$items[$i]['id'],'gid'=>$gid,'num'=>0]);
						 } 
					}
					$this->success("上传成功","promanage","",1);
		        }else{
		            // 上传失败获取错误信息
		            // echo $file->getError();
		           $this->error("上传失败","promanage","",3);
		        }
		}else{
			// $savename =0;
			$this->error("上传失败","promanage","",3);
		}
		// $cond = model('goods');
		// // 获取数据并添加进数据库
		// $cond->data([
		//     'name'  =>  $_POST["mytextarea"],
		//     'image'  =>  $savename,
		//     'sell_price1'  =>  $_POST["pri1"],
		//     'sell_price2'  =>  $_POST["pri2"],
		//     'retail_price'  =>  $_POST["pri3"],
		//     'coupon_price'  =>  $_POST["pri4"],
		//     'detail'  => $sdetail,
		//     'time'  =>  time()
		// ]);
		// $cond->save();
		// $gid=db("goods")->getLastInsID();
		// $items = db("user")->select();
		// for ($i=0; $i <count($items) ; $i++) {
		// 	if ($items[$i]["type"]==1) {
		// 	 	db("b1_goods")->insert(['uid'=>$items[$i]['id'],'gid'=>$gid,'num'=>0]);
		// 	 } 
		// }
		// $this->success("上传成功","promanage","",1);
	}

	//商品的删除功能
	function delete($id){
		//$id是商品的ID
		$items = db("b1_goods")->select();
		// mp($items);
		for ($i=0; $i <count($items) ; $i++) { 
			if ($id==$items[$i]["gid"]) {
				$res[]=$items[$i]["num"];
			}
		}
		$result =array_sum($res);
		if ($result==0) {
			//删除商品
			model("goods")->destroy(['id' => $id]);
			//删除B1商品库存
			for ($i=0; $i <count($items) ; $i++) {
				model("b1_goods")->destroy(['gid' => $id]);
			}
			$this->success("删除成功","promanage","",1);
		}else{
			$this->error("删除失败，B1用户仍有该商品库存","promanage","",4);
		}
	}

	//商品的编辑功能
	function editor($id,$sdetail){
		// 产品的上传功能
	    $file = request()->file('picture');
	    // 上传移动到的目录
	    if($file){
		        $info = $file->validate(['size'=>9999999,'ext'=>'bmp,jpg,png,tiff,pcx,tga,exif,fpx,svg,psd,cdr,pcd,dxf'])->move(ROOT_PATH . 'public' . DS .'static'. DS.'uploads'.DS.'product_pic');
		        if($info){
		            // // 成功上传后 获取上传信息		      
		            $savename=$info->getSaveName();
		            $items = model("goods");
					$items->save([
						'name'  =>  $_POST["mytextarea"],
						'image'  =>  $savename,
						'sell_price1'  =>  $_POST["pri1"],
					    'sell_price2'  =>  $_POST["pri2"],
					    'retail_price'  =>  $_POST["pri3"],
					    'coupon_price'  =>  $_POST["pri4"],
					    'detail'  => $_POST["sdetail"] ,
					    'time'  =>  time()
					],["id"=>$id]);
				   	$this->success("修改成功","promanage","",1);
		        }else{
		            // 上传失败获取错误信息
		            // echo $file->getError();
		             $this->error("上传失败","promanage","",3);
		        }
		}else{
			$savename =0;
		}
		if($savename==0){
			$items = model("goods");
			$items->save([
				'name'  =>  $_POST["mytextarea"],
				'sell_price1'  =>  $_POST["pri1"],
			    'sell_price2'  =>  $_POST["pri2"],
			    'retail_price'  =>  $_POST["pri3"],
			    'coupon_price'  =>  $_POST["pri4"],
			    'detail'  => $sdetail,
			    'time'  =>  time()
			],["id"=>$id]);
		}
		$this->redirect('promanage');
	// 	$items = model("goods");
	// 	$items->save([
	// 		'name'  =>  $_POST["mytextarea"],
	// 		'image'  =>  $savename,
	// 		'sell_price1'  =>  $_POST["pri1"],
	// 	    'sell_price2'  =>  $_POST["pri2"],
	// 	    'retail_price'  =>  $_POST["pri3"],
	// 	    'coupon_price'  =>  $_POST["pri4"],
	// 	    'detail'  => $_POST["sdetail"] ,
	// 	    'time'  =>  time()
	// 	],["id"=>$id]);
	// $this->assign("items",$items);
 //   	$this->success("修改成功","promanage","",1);
    }
    
    //商品的搜索功能
    function search($search,$each=15,$page=1){
    	$item =model("goods")->search($search);
		$amount = count($item);
		$maxPage =ceil($amount/$each);
		$page =getPage($maxPage,$page);
		$pages =getPages($maxPage,$page);
		$href = 'search?';
		$items =model("goods")->searchPage($search,$each,$page);
		foreach ($items as $key => $value) {
			$items[$key]["i"] = $key+1; 
		}
		$this->assign("each",$each);
		$this->assign("maxPage",$maxPage);
		$this->assign("page",$page);
		$this->assign("pages",$pages);
		$this->assign("href",$href);
		$this->assign("amount",$amount);
		$this->assign("items",$items);
		$this->assign("search",$search);
		return $this->fetch("promanage");
    }


}

