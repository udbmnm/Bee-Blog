<?php

namespace Home\Controller;
use Think\Controller;


class DetailController extends HomeController {

    
 	public function index() {
 		
		$did = I('get.did'); 
		if(is_numeric($did)) {
			$Doc = M('Documents');
			$res = $Doc->where('did='.$did)->find();
			$M_Tags = M('tags');
			$tags = $M_Tags->join('__TAGS_DOCUMENTS__ ON __TAGS__.tid = __TAGS_DOCUMENTS__.tid')->where('did='.$did)->getField('name',true);
			if($tags) {
			  $this->assign('tags',$tags);
			}
			if($res) {
			  $this->assign('post',$res);
		      return  $this->display('home_detail');
			}
		}
		
		$this->error('没有找到对应内容！'.$did);
    }
	
    	
}


	