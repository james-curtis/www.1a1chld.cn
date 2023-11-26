<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2015 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author:[dashang]
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

if(file_exists("./public/install") && !file_exists("./public/install/install.lock")){
    // 组装安装url
    $url=$_SERVER['HTTP_HOST'].trim($_SERVER['SCRIPT_NAME'],'index.php').'public/install/index.php';
    // 使用http://域名方式访问；避免./Public/install 路径方式的兼容性和其他出错问题
    header("Location:http://$url");
    die;
}
// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');
// 定义上传目录

// 定义应用缓存目录
define('RUNTIME_PATH', __DIR__ . '/runtime/');

// 开启调试模式
define('APP_DEBUG', false);

// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';
