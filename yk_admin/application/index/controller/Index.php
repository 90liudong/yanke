<?php 
namespace app\index\controller;
use think\Controller;

class Index extends Controller
{
	function index(){
		$url ="admin/index/index";
		$this->redirect($url);
	}
	function aa(){
		echo 2;
	}
	
}