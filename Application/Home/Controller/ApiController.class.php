<?php

namespace Home\Controller;
use Think\Controller;
use Think\Page;


class ApiController extends HomeController {



	public function Index() {
		
		$this->redirect('/');
		
	}
	    
 	public function Menu() {
 		
		$menu = [[
			'url' => '/app',
			'name' => 'Bees'
		], [
			'url' => 'tags',
			'name' => '标签'
		], [
			'url' =>'friends',
			'name' =>'好友'
		], [
			'url' =>'about',
			'name' =>'关于'
		], [
			'url' =>'rainymood',
			'name' =>'RainyMood'
		]];
		
		 $this->ajaxReturn(['status'=>true,'data'=> $menu ]);
		
    }
	
	
	public function ArticleList () {
		
 		$Doc = M('Documents');
		$count = $Doc->count();
		$Page = new Page($count,10);
		$Page->setConfig('prev', "上一页");//上一页
		$Page->setConfig('next', '下一页');//下一页
		$Page->setConfig('first', '首页');//第一页
		$Page->setConfig('last', "末页");//最后一页
		$nowPage = I('get.page',1);
	//  $show = $Page->show();
		$list = $Doc->page($nowPage,$Page->listRows)->field('did,title,contents,created,views')->order('did desc')->select();
	//	$this->assign('page',$show);
		
		 $this->ajaxReturn(['status'=>true,'data'=> $list]);
	}
	
	public function ArticleDetail() {
		
		$did = I('get.did'); 
		if(is_numeric($did)) {
			$Doc = M('Documents');
			$res = $Doc->where('did='.$did)->find();
			$M_Tags = M('tags');
			$tags = $M_Tags->join('__TAGS_DOCUMENTS__ ON __TAGS__.tid = __TAGS_DOCUMENTS__.tid')->where('did='.$did)->getField('name',true);
			
			if($res) {
				if($tags) {
				  $res['tags'] = $tags;
				}	
			   $this->ajaxReturn(['status'=>true,'data'=> $res]);
			}
		}
		
		 $this->ajaxReturn(['status'=>false,'data'=> '没有找到对应内容！']);
		
	}
		
		
 	public function tag() {
 		
		$name = I('get.name'); 
		$Tags = M('tags');
		$existID =  $Tags->where(['name'=>$name])->getField('tid');
		if($existID !== null) {
			$Doc = M('Documents');
			$list = $Doc->join('__TAGS_DOCUMENTS__ b ON __DOCUMENTS__.did = b.did')->where('tid='.$existID)->select();
			$this->ajaxReturn(['status'=>true,'data'=> $list]);
		}else{
			$this->ajaxReturn(['status'=>false,'data'=> '标签不存在！']);
		}
		
    }
	
	
    	
}



