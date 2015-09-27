<?php

namespace Home\Controller;
use Think\Controller;


class AboutController extends HomeController {

    
 	public function index() {
 		
		$About = M('Metas');
		$contents = $About->field('contents')->where("type='about'")->find();
		$this->assign('contents',$contents['contents']);
        $this->display('home_about');
    }
	
    	
}


