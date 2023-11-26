<?php
/**
 * 安装向导
 */
header('Content-type:text/html;charset=utf-8');
// 检测是否安装过
if (file_exists('./install.lock')) {
    echo '你已经安装过该系统，重新安装需要先删除./public/install/install.lock 文件';
    die;
}
// 同意协议页面
if(@!isset($_GET['c']) || @$_GET['c']=='agreement'){
    require './agreement.html';
}
// 检测环境页面
if(@$_GET['c']=='test'){
    require './test.html';
}
// 创建数据库页面
if(@$_GET['c']=='create'){
    require './create.html';
}
// 安装成功页面
if(@$_GET['c']=='success'){
    // 判断是否为post
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $data=$_POST;
        // 连接数据库
        $link=@new mysqli("{$data['DB_HOST']}:{$data['DB_PORT']}",$data['DB_USER'],$data['DB_PWD']);
        // 获取错误信息
        $error=$link->connect_error;
        if (!is_null($error)) {
            // 转义防止和alert中的引号冲突
            $error=addslashes($error);
            die("<script>alert('数据库链接失败:$error');history.go(-1)</script>");
        }
        // 设置字符集
        $link->query("SET NAMES 'utf8'");
        $link->server_info>5.0 or die("<script>alert('请将您的mysql升级到5.0以上');history.go(-1)</script>");
        // 创建数据库并选中
        if(!$link->select_db($data['DB_NAME'])){
            $create_sql='CREATE DATABASE IF NOT EXISTS '.$data['DB_NAME'].' DEFAULT CHARACTER SET utf8;';
            $link->query($create_sql) or die('创建数据库失败');
            $link->select_db($data['DB_NAME']);
        }
        // 导入sql数据并创建表
        $dsadmin_str=file_get_contents('./dashang.sql');
        $sql_array=preg_split("/;[\r\n]+/", str_replace('ds_',$data['DB_PREFIX'],$dsadmin_str));
        foreach ($sql_array as $k => $v) {
            if (!empty($v)) {
                $link->query($v);
            }
        }
        $link->close();
        $db_str=<<<php
<?php

return [
    
    'type'           => 'mysql',	     // 数据库类型   
    'hostname'       => '{$data['DB_HOST']}',     // 服务器地址   
    'database'       => '{$data['DB_NAME']}',     // 数据库名
    'username'       => '{$data['DB_USER']}',	 // 用户名  
    'password'       => '{$data['DB_PWD']}',	 // 密码
    'hostport'       => '{$data['DB_PORT']}',	         // 端口
    'dsn'            => '',	             // 连接dsn
    'params'         => [],	             // 数据库连接参数   
    'charset'        => 'utf8',	         // 数据库编码默认采用utf8   
    'prefix'         => '{$data['DB_PREFIX']}',	     // 数据库表前缀   
    'debug'          => false,	         // 数据库调试模式  
    'deploy'         => 0,	             // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)   
    'rw_separate'    => false,	         // 数据库读写是否分离 主从式有效   
    'master_num'     => 1,	             // 读写分离后 主服务器数量  
    'slave_no'       => '',	             // 指定从服务器序号   
    'fields_strict'  => true,	         // 是否严格检查字段是否存在   
    'resultset_type' => 'array',	     // 数据集返回类型 array 数组 collection Collection对象   
    'auto_timestamp' => false,	         // 是否自动写入时间戳字段  
    'sql_explain'    => false,	         // 是否需要进行SQL性能分析
	// +----------------------------------------------------------------------
    // | auth配置
    // +----------------------------------------------------------------------
    'auth_config'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => '{$data['DB_PREFIX']}auth_group', // 用户组数据不带前缀表名
        'auth_group_access' => '{$data['DB_PREFIX']}auth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => '{$data['DB_PREFIX']}auth_rule', // 权限规则不带前缀表
        'auth_user'         => '{$data['DB_PREFIX']}admin', // 用户信息不带前缀表
    ],
	'auth_config2'  => [
        'auth_on'           => 1, // 权限开关
        'auth_type'         => 1, // 认证方式，1为实时认证；2为登录认证。
        'auth_group'        => '{$data['DB_PREFIX']}dlauth_group', // 用户组数据不带前缀表名
        'auth_group_access' => '{$data['DB_PREFIX']}dlauth_group_access', // 用户-用户组关系不带前缀表
        'auth_rule'         => '{$data['DB_PREFIX']}dlauth_rule', // 权限规则不带前缀表
        'auth_user'         => '{$data['DB_PREFIX']}member', // 用户信息不带前缀表
    ],
];
php;
        // 创建数据库链接配置文件
        file_put_contents('../../application/database.php', $db_str);
        @touch('./install.lock');
        require './success.html';
    }

}

