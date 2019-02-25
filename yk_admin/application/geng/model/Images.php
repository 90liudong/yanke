<?php
namespace app\geng\model;
use think\Model;

class Images extends Model
{
	function findimage(){
		$item = db('images')-> select();
		for($i=0; $i <count($item) ; $i++){
			$image[$i] = $item[$i]['image'];
		}
		return $image;
		
		
	}
	
}