<?php	if(!defined('IN_UOZHIFU')) exit('Request Error!');

//数据库服务器
$db_host = 'localhost';

//数据库用户名
$db_user = 'www_658166_vip';

//数据库密码
$db_pwd = '2YW8JhxscWwZJpyB';

//数据库名
$db_name = 'www_658166_vipp';

//数据表前缀
$db_tablepre = 'ld_';

//数据表编码
$db_charset = 'utf8';

//以下参数如果对系统不了解请不要随意修改//
$zhifubaotype=1; //0 表示支付宝备注区分模式 1表示支付宝金额区分模式
$weixintype=1; //0 表示微信备注区分模式 1表示微信金额区分模式  微信认证码模式只能选用1 微信金额区分模式  微信扫码登陆模式可以选择备注或金额模式

?>
