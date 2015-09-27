<?php

namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
	
 	public function index() {
 		
		if(IS_POST){
			
			$username = I('post.username');
			$pass = I('post.password');
			
			if(empty($username) || empty($pass)) {
				return $this->error('用户名密码不能为空！','/Admin/Login',3);
			}else{
				$User = M('User');
				$isExistUser = $User->where(['username'=>$username])->find(); 
				
				if($isExistUser) {
					if($isExistUser['lock'] === '1') {
						return $this->error('该用户已锁定！！','/Admin/Login',3);
					}
					if($isExistUser['password'] === md5($pass)) {
						session('admin_user',$isExistUser['username']);
						$User->ip = get_client_ip();
						$User->where(['username'=>$username])->save();
						return $this->success('登录成功 ！','/Admin/Index',3);
					}else{
						return $this->error('密码错误！！','/Admin/Login',3);
					}
				}
				 return $this->error('用户名不存在！！','/Admin/Login',3);
			}
		
		}else{
			if(!empty(session('admin_user'))) {
				return $this->error('已经登录了不能乱点！','/Admin',3);
			}
	        $this->display('admin_login');			
		}

    }
	
 
}


