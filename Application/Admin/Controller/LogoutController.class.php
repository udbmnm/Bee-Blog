<?php

namespace Admin\Controller;
use Think\Controller;

class LogoutController extends Controller {
	
 	public function index() {
		if(empty(session('admin_user'))) {
			return $this->error('已经退出了不能乱点！');
		}
		session('admin_user',null);
        $this->success('退出成功！','/Admin/Login',3);
    }
	
 
}


