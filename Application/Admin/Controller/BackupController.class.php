<?php

namespace Admin\Controller;
use Think\Controller;

class BackupController extends Controller {

	public function index() {
		//查询数据
		$list = D('Database') -> backupList();
		$this -> assign('list', $list);

		$this -> display('admin_backup');
	}

	/**
	 * 增加
	 */
	public function add() {
		if (!IS_POST) {
			//查询数据
			$list = D('Database') -> loadTableList();
			$this -> assign('list', $list);
			$this -> display('admin_backup_add');
		} else {
			$type = I('post.type');
			switch ($type) {
				case 1 :
					$action = 'optimizeData';
					break;
				case 2 :
					$action = 'repairData';
					break;
				default :
					$action = 'backupData';
					break;
			}
			if ( D('Database') -> $action()) {
				$this -> success('数据库操作执行完毕！');
			} else {
				$msg =   D('Database') -> error;
				if (empty($msg)) {
					$this -> error('数据库操作执行失败');
				} else {
					$this -> error($msg);
				}

			}
		}
	}

	/**
	 * 导入
	 */
	public function import() {
		$time = I('post.data');
		if (empty($time)) {
			$this->ajaxReturn(['status'=>false,'msg'=>'参数不能为空！']);
		}
		//获取备份数量
		if ( D('Database') -> importData($time)) {
			$this->ajaxReturn(['status'=>true,'msg'=>'备份恢复成功！']);
		} else {
			$msg =   D('Database') -> error;
			if (empty($msg)) {
				
				
				$this->ajaxReturn(['status'=>false,'msg'=>'备份恢复失败！']);
				
			} else {
				
				$this->ajaxReturn(['status'=>false,'msg'=>$msg]);
				
			}
		}
	}

	/**
	 * 删除
	 */
	public function del() {
		$time = I('post.data');
		if (empty($time)) {
			$this->ajaxReturn(['status'=>false,'msg'=>'参数不能为空！']);
		}
		//获取备份数量
		if ( D('Database') -> delData($time)) {
			$this->ajaxReturn(['status'=>true,'msg'=>'备份删除成功！']);
		} else {
			$msg =   D('Database') -> error;
			if (empty($msg)) {
				$this->ajaxReturn(['status'=>false,'msg'=>'备份删除失败！']);
			} else {
				
				$this->ajaxReturn(['status'=>false,'msg'=>$msg]);
			}
		}
	}

}
