<?php

namespace Home\Controller;
use Think\Controller;


class FriendsController extends HomeController {

    
 	public function index() {
 		
		$Tags = M('links');
		$list = $Tags->field('name,url')->select();
		$this->assign('links',$list);
		$this->display('home_links');
		
    }
	
    	
}


