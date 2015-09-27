<?php

namespace Home\Controller;
use Think\Controller;
use Think\Page;

class IndexController extends HomeController {

 	public function index() {

/* 		$Doc = M('Documents');
		$count = $Doc->count();
		$Page = new Page($count,10);
		$Page->setConfig('prev', "上一页");//上一页
		$Page->setConfig('next', '下一页');//下一页
		$Page->setConfig('first', '首页');//第一页
		$Page->setConfig('last', "末页");//最后一页
		$nowPage = I('get.page',1);
	  	$show = $Page->show();
		$list = $Doc->order('did desc')->page($nowPage,$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('data',$list);*/
        $this->display('home_app');
		
		
    }
	
    	
}


