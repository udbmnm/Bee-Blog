<?php

namespace Admin\Controller;
use Think\Controller;
use Think\Page;
use Admin\Controller\AdminController;
class FriendsController extends AdminController {
	
	
 	public function index() {
 		
 		$Link = M('Links');
		$count = $Link->count();
		$Page = new Page($count,10);
		$Page->setConfig('prev', "上一页");//上一页
		$Page->setConfig('next', '下一页');//下一页
		$Page->setConfig('first', '首页');//第一页
		$Page->setConfig('last', "末页");//最后一页
		$nowPage = I('get.page',1);
	  	$show = $Page->show();
		$links = $Link->order('lid desc')->page($nowPage,$Page->listRows)->select();
		$this->assign('page',$show);
		$this->assign('links',$links);
        $this->display('admin_friends');
    }
		
 	public function add() {
 		if (IS_POST){
			$Link = M('Links');
			$data = [
				'name'=>I('post.name'),
				'url'=>I('post.url'),
				'created'=>time()
			];
			$isCreate = $Link->data($data)->add();
			if($isCreate === false) {
				return	$this->ajaxReturn(['status'=>false,'msg'=>'添加失败！']);
			}	
			$this->ajaxReturn(['status'=>true,'msg'=>'添加成功！']);
		}else{
			$lid = I('get.lid'); 
			
			if(is_numeric($lid)) {
				$Links = M('Links');
				$res = $Links->where('lid='.$lid)->find();
				if($res) {
					$this->assign('edit',TRUE);
					$this->assign('link',$res);
				}
			}
			
	        $this->display('admin_friends_add');
		}
    }


	public function delete() {
		if (IS_POST){
			$Links = M('Links');
			$lid = I('post.lid');
			if(is_numeric($lid)) {
				$res = $Links->where('lid='.$lid)->delete(); 
				if($res === FALSE) {
					$this->ajaxReturn(['status'=>false,'msg'=>'SQL错误！']);
				}elseif($res === 0) {
					$this->ajaxReturn(['status'=>false,'msg'=>'没有删除任何数据！']);
				}else {
					$this->ajaxReturn(['status'=>true,'msg'=>'删除成功！']);
				}
			}
		}else{
			$this->error('没有找到对应内容！');
		}
	}
	
	    
}


