<?php

namespace Home\Controller;
use Think\Controller;


class NotfoundController extends HomeController {

    
 	public function index() {
 		
		$this->display('home_404');
		
    }
	
    	
}


