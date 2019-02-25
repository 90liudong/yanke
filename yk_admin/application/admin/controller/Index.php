<?php 
namespace app\admin\controller;
use think\Controller;

class Index extends LoginCheck
{
	function index(){
		return $this->fetch();
	}

}