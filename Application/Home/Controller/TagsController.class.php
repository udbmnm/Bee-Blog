<?php

namespace Home\Controller;
use Think\Controller;


class TagsController extends HomeController {

    
 	public function index() {
 		
		$Tags = M('tags');
		$list = $Tags->field('name')->select();
		$this->assign('list',$list);
		$this->display('home_tags');
		
    }
	
    	
}


