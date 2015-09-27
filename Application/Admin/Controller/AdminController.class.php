<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 后台公共类
 */
class AdminController extends Controller {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * 后台控制器初始化
	 */
	protected function _initialize() {
		// 检测用户登录
		define('ADMIN_ID', $this -> isLogin());
		if (!ADMIN_ID) {
			$this->error('请先登录！','/Admin/Login',3);
		}

	}

	/**
	 * 检测用户是否登录
	 * @return int 用户IP
	 */
	protected function isLogin() {
		$user = session('admin_user');
		if (empty($user)) {
			return false;
		} 
		return true;
	}

	/**
	 * 后台模板显示 调用内置的模板引擎显示方法，
	 * @access protected
	 * @param string $templateFile 指定要调用的模板文件
	 * @return void
	 */
	protected function adminDisplay($templateFile = '') {
		//获取菜单
		$menuList = D('Admin/Menu') -> getMenu($this -> loginUserInfo, $this -> infoModule['cutNav']['url'], $this -> infoModule['cutNav']['complete']);
		$this -> assign('menuList', $menuList);
		//复制当前URL
		$this -> assign('self', __SELF__);
		//嵌套模板
		$common = $this -> fetch(APP_PATH . 'Admin/View/common.html');
		$tpl = $this -> fetch($templateFile);
		echo str_replace('<!--common-->', $tpl, $common);
	}

}
