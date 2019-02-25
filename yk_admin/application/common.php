<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function mp($arr){
 	echo "<pre>";
 	print_r($arr);
 	exit();
 }

function mps($arr1,$arr2){
    header("Content-type:text/html;charset=utf-8");
    echo "<pre>";
    print_r($arr1);
    print_r($arr2);
    exit;
}
function ab($id){
		$res = model('user')->finddiscount($id);
		return $res;
	}
function one($id){
		$res = model('user')->findone($id);
		return $res;
	}
// user表查b1的id的递归
function digui($id){
	do{
		$item = db('user')->field('up_uid,id')->where(['id'=>$id])->find();
		$i = $item['id'];
		$id = $item['up_uid'];
		$up_uid = $item['up_uid'];
	}while($up_uid!=0);
	return $i;
}
function subProfit($uid,$oid){
	$res = db("profit")->field("money")->where(["uid"=>$uid,"oid"=>$oid])->find();
	return $res;
}

 // 生成token并保存到数据库
function makeToken($user_id){
	if($user_id){
		// 根据user_id生成token
		$token_value = md5($user_id .'-'. rand(10000,99999) .'-'. time());
		// 判断用户是否已经登录
		$cond['user_id'] = $user_id;
		$data = db('token')->where($cond)->find();
		if($data){
			$t = [
				"token" => $token_value,
				"time_out" => time() + 86400
			];
			$res = db('token')->where('user_id',$user_id)->update($t);
		}else{
			$t = [
				"token" => $token_value,
				"time_out" => time() + 86400,
				"user_id" => $user_id
			];
			$res = db('token')->where('user_id',$user_id)->insert($t);
		}
		if($res){
			return $token_value;
		}else{
			return false;
		}
		// 返回永久的token
		// $cond['user_id'] = $user_id;
		// $data = db('token')->where($cond)->find();
		// if($data){
		// 	return $data['token'];
		// }else{
		// 	return false;
		// }
	}
}
function failed($str){
	echo $str;
	exit;
}
// 验证token
function checkToken($token){
	$data = db('token')->where('token',$token)->find();
	if($data){
		$now = time();
		if($now<$data['time_out']){
			return $data['user_id'];
		}else{
			db('token')->where('user_id',$data['user_id'])->delete();
			failed("token过期，请重新登录");
		}
	}else{
		failed("token不存在");
	}
}

function destroyToken($token){
	$cond['token'] = $token;
	$res = db('token')->where('token',$token)->delete();
	// $res = 1;
	if($res){
		$res = [
			'status' => true,
			'content' => ""
		];
		ok("");
	}else{
		failed('注销失败');
	}
}

/**
 * 产生唯一字符串
 * @return string
 */
function getUniName(){
	return md5(uniqid(microtime(true),true));
}

// 分页功能
function getPage($maxPage,$page){
    if($page>$maxPage){
        $page = $maxPage;
    }
    if($page<1){
        $page = 1;
    }
    return $page;
}

function getPages($maxPage,$page){
    //限定首页和尾页的页数
    if($page>$maxPage){
        $page = $maxPage;
    }
    if($page<1){
        $page = 1;
    }
    //显示的页数的限定
    if($maxPage>=4){
        $showPage =4;
    }else{
        $showPage=$maxPage;
    }
    //
    $pages=[];
    if($showPage<4){
        for ($i=1; $i <=$showPage ; $i++) { 
            $pages[]=$i;
        }
    }else{
        if($page==1 || $page==2){
            for ($i=1; $i <=$showPage ; $i++) { 
                $pages[]=$i;
            }
        }
        else{
            $pp =$page;
            if($pp+2>$maxPage){
                $pages = [$maxPage-3,$maxPage-2,$maxPage-1,$maxPage];
            }else{
                $pages = [$page-1,$page,$page+1,$page+2];
            }
        }
    }
    return $pages;
}