<?php

namespace Home\Model;
use Think\Model;

class FormModel extends Model {
	 protected $tableName  = 'detail';
    // 定义自动验证
    protected $_validate =  [
       ['title','require','标题必须填写'],
       ['content','require','内容必须填写']
    ];
    
    protected $_auto    =   [
        ['createAt','time',1,'function']
    ];


}






