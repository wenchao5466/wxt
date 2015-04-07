<?php
return array(
	//'配置项'=>'配置值'
        //数据库配置信息
        'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => 'localhost', // 服务器地址
        'DB_NAME'   => 'weixitie', // 数据库名
        'DB_USER'   => 'root', // 用户名
        'DB_PWD'    => '', // 密码
        'DB_PORT'   => 3306, // 端口
        'DB_PREFIX' => 'wxt_', // 数据库表前缀 
        'DB_CHARSET'=> 'utf8', // 字符集
		
		//Admin账户
        'ADMIN_NAME' => 'admin',
        'ADMIN_PWD' =>  'be28008b5f',
		'weichat' => array(
				'token'=>'thnki2536k5k6ji6h', //填写你设定的key
				//'encodingaeskey'=>'mnxg26kRcGE2imnNHY6wHB0vc8XGp5PHmND4iLzSToz', //填写加密用的EncodingAESKey，如接口为明文模式可忽略
				'appid'=>'wx710740d3f1228580',
				'appsecret'=>'a002be1dbe7bc23537e4e7dd0c615df5',
				'debug'=>true,
				'logcallback'=>'logfile',
		),
);