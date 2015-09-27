<?php

namespace Home\Controller;
use Think\Controller;


class TagController extends HomeController {

    
 	public function index() {
 		
		$name = I('get.name'); 
		$Tags = M('tags');
		$existID =  $Tags->where(['name'=>$name])->getField('tid');
		if($existID !== null) {
			$Doc = M('Documents');
			$list = $Doc->join('__TAGS_DOCUMENTS__ b ON __DOCUMENTS__.did = b.did')->where('tid='.$existID)->select();
			$this->assign('data',$list);
			$this->display('home_index');
		}else{
			$this->error('标签不存在！');
		}
		
    }
	
    	
}


