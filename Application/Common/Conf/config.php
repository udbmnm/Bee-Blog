<?php
return [
	/* 数据库配置 */
	'DB_TYPE'   => 'mysqli', 
	'DB_HOST'   => 'localhost', 
	'DB_NAME'   => 'hotdog',
	'DB_USER'   => 'root', 
	'DB_PWD'    => '0000', 
	'DB_PORT'   => 3306, 
	'DB_PREFIX' => 'hot_', 
	'DB_CHARSET'=> 'utf8', 
	'MODULE_ALLOW_LIST'=>['Home','Admin'],
	'TMPL_FILE_DEPR'=>'_',//url分隔符
	'SHOW_PAGE_TRACE' =>true,		//bug调试
	'VAR_PAGE'=>'page', //分页名
	'UPLOAD_SITEIMG_QINIU' => [
        'maxSize' => 5 * 1024 * 1024,//文件大小
        'rootPath' => './',
        'savePath' => 'Uploads/',
        'saveName' => ['uniqid', ''],
        'driver' => 'Qiniu',
        'driverConfig' => [
            'secrectKey' => '', 
            'accessKey' => '',
            'domain' => '',
            'bucket' => ''
    	]
    ],
    'URL_ROUTER_ON'   => true,
	'URL_ROUTE_RULES' => [
    	'detail/:did\d'  => 'Home/Detail/Index',
    	'tag/:name' => 'Home/Tag/Index?name=:1',
     ],
    'SITE_NAME' => "设置网站名",
    'SITE_KEYWORDS'=>"设置关键词",
    'SITE_DESC'=>"设置描述",
    'SITE_STAT'=>"设置统计代码",
];
