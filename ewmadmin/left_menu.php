<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧菜单</title>
<link href="templates/style/menu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/tinyscrollbar.js"></script>
<script type="text/javascript" src="templates/js/leftmenu.js"></script>
</head>
<body>
<div class="tGradient"></div>
<div id="scrollmenu">
	<div class="scrollbar">
		<div class="track">
			<div class="thumb">
				<div class="end"></div>
			</div>
		</div>
	</div>
	<div class="viewport">
		<div class="overview">
			<!--scrollbar start-->
			<div class="menubox">
				<div class="title on" id="t1" onclick="DisplayMenu('leftmenu01');" title="点击切换显示或隐藏"> 二维码系统管理 V9.0.1 </div>
				<div id="leftmenu01"> 
				<a href="admin.php" target="main">&#20108;&#32500;&#30721;&#31649;&#29702;&#31995;&#32479;</a> 
				<a href="site.php" target="main">&#20462;&#25913;&#37197;&#32622;</a> 
				<a href="web_config.php" target="main">系统功能配置</a> 
				<a href="admin_update.php?id=<?php $row = $dosql->GetOne("SELECT `id` FROM `#@__ewmadmin` WHERE adminname='".$_SESSION['admin']."'");echo $row['id'];?>" target="main">密码修改</a> 
				<a href="paylist.php" target="main">订单数据管理</a> 
				<a href="tongji.php" target="main">数据统计信息</a>
				<a href="delryewm.php" target="main">清除自动生成二维码记录</a> 
				<a href="renzheng.php" target="main">微信认证登陆配置方法</a> 
	<?php
	if($xianail==1){
	?>
				<a href="news-20.php" target="main">支付宝二维码制作方法</a> 
	<?php
	}
	if($xianwx==1){
	?>	
				<a href="news-38.php" target="main">微信二维码制作方法</a> 
	<?php
	}
	if($xiancft==1){
	?>
				<a href="news-34.php" target="main">QQ钱包二维码制作方法</a> 
	<?php
	}
	?>
				<a href="http://www.uozhifu.com/ewm2018/index.php" target="main">常用问题帮助</a> 
				</div>
			</div>
			<!--scrollbar end-->
		</div>
	</div>
</div>
<div class="bGradient"></div>

<div class="copyright">&nbsp;</div>
</body>
</html>
