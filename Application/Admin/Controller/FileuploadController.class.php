<?php

namespace Admin\Controller;
use Think\Controller;
use Admin\Controller\AdminController;

class FileuploadController extends AdminController {

	public function index() {
		$setting = C('UPLOAD_SITEIMG_QINIU');
		$Upload = new \Think\Upload($setting);
		$info = $Upload -> upload($_FILES);
		$this->ajaxReturn($info['file']);
	}

}
