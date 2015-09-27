<?php

namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\AdminController;
class PublishController extends AdminController {
	
 	public function index() {
 		
		if (IS_POST){
			
			$Doc = M('Documents');
			$post = [
				'title'=>I('post.title'),
				'contents'=>I('post.contents')
			];
			$did = I('post.did');
			if(is_numeric($did)) {
				$post['modified'] = time();//修改时间
				$isUpdate = $Doc->where('did='.$did)->save($post); 
				if($isUpdate === false) {
					return $this->ajaxReturn(['status'=>false,'msg'=>'更新失败！']);
				}
			}else{
				$post['created'] = time();//创建时间
				$did = $Doc->field('title,contents,created')->data($post)->add(); //did
				if($did === false) {
				 	return $this->ajaxReturn(['status'=>false,'msg'=>'创建失败！']);
				}			
			} 
			
			$tagsArr = explode(',',I('post.tags'));
			$Tags = M('tags');
			$Tag_doc = M('tags_documents');
			foreach ($tagsArr as $key => $value) {
				
			 	$existID =  $Tags->field('tid')->where(['name'=>$value])->select(); 
				if($existID !== null) {
					$relationship[] = ['tid' => $existID[0]['tid'],'did'=> $did];
				}else{
					$tid = $Tags->data(['name'=>$value])->add();
					$relationship[] = ['tid' => $tid,'did'=> $did];
				}
				
			 }
			
			$isDel = $Tag_doc->where('did='.$did)->delete();
			if($isDel === false) {
				return $this->ajaxReturn(['status'=>false,'msg'=>'删除标签出错！']);
			}
			
			$isOk = $Tag_doc->addAll($relationship);
			if($isOk){
				$this->ajaxReturn(['status'=>true,'did'=>$did,'tid'=>$isOk]);
			}else {
				$this->ajaxReturn(['status'=>false,'msg'=>'添加失败！']);
			}

			 
			 
		}else{
			$did = I('get.did'); 
			if(is_numeric($did)) {
// SELECT name,hot_tags_documents.tid FROM `hot_tags` INNER JOIN hot_tags_documents ON hot_tags.tid = hot_tags_documents.tid group by tid order by count(*) desc;
				$Doc = M('Documents');
				$res = $Doc->where('did='.$did)->find();
				if($res) {
					$M_Tags = M('tags');
					$tags = $M_Tags->join('__TAGS_DOCUMENTS__ ON __TAGS__.tid = __TAGS_DOCUMENTS__.tid')->where('did='.$did)->getField('name',true);
					$tags = implode(',', $tags);
					//常用标签读取
					$commonlytags = $M_Tags->alias('a')->join('__TAGS_DOCUMENTS__ ON a.tid = __TAGS_DOCUMENTS__.tid')->group('a.tid')->order('COUNT(*) desc')->getField('name',10);
					
					$this->assign('edit',TRUE);
					$this->assign('post',$res);
					$this->assign('tags',$tags);
					$this->assign('commonlytags',$commonlytags);
				}else {
					$this->error('没有找到对应内容！');
				}
				
			}
			
	        $this->display('admin_publish');
		}
		
    }
		
	public function delete() {
		if (IS_POST){
			$Doc = M('Documents');
			$did = I('post.did');
			if(is_numeric($did)) {
				$res = $Doc->where('did='.$did)->delete(); 
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


