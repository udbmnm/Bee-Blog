<?php

namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\AdminController;
class SettingController extends AdminController {
	
	
 	public function index() {
 		
		if(IS_POST) {
			
			$name = I('post.name');
			$keywords= I('post.keywords');
			$desc= I('post.desc');
			$stat= I('post.stat');
			$Metas = M('Metas');
			$data[] = ['contents'=>$name,'type'=>'name'];
			$data[] = ['contents'=>$keywords,'type'=>'keywords'];
			$data[] = ['contents'=>$desc,'type'=>'desc'];
			$data[] = ['contents'=>$stat,'type'=>'stat'];
			
			$is = $Metas->addAll($data,[],true);
			
			if($isModify === false) {
				return $this->ajaxReturn(['status'=>false,'msg'=>'保存数据出错！']);
			}
			
			return $this->ajaxReturn(['status'=>true,'msg'=>'添加成功！']);
		}else {
			$Metas = M('Metas');
			$res =  $Metas->where('type="name" OR type="keywords" OR type="desc" OR type="stat"')->select(); 
			foreach($res as $k => $v) {
				$item[$v['type']] = $v['contents'];
			}
			$this->assign('item',$item);
	        $this->display('setting_index');
		}
    }
		
		
 	public function about() {
 		
		$About = M('Metas');
		 
		if(IS_POST) {
			
			$contents = I('post.contents');
			
			$isModify =  $About->where("type='about'")->save(['contents'=>$contents]);
			
			if($isModify === false) {
				return $this->ajaxReturn(['status'=>false,'msg'=>'保存数据出错！']);
			}
			return $this->ajaxReturn(['status'=>true,'msg'=>'添加成功！']);
		}else {
			$contents = $About->field('contents')->where("type='about'")->find();
			$this->assign('contents',$contents['contents']);
		}
		
        $this->display('setting_about');
    }
	
    
}


