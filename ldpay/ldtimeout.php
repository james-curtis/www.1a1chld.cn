<?php
error_reporting(0);
@session_start();
define('TIME_OUT', $cfg_ldtimeout); //定义重复操作最短的允许时间，单位秒
$out_order_id2=trim(htmlspecialchars($_REQUEST['out_order_id']));//接收订单号
$ldtime = time();
if( isset($_SESSION['ldtimeout']) )
{
 if( $ldtime - $_SESSION['ldtimeout'] <= TIME_OUT ) //判断超时
 {
  //echo $_SESSION['ldtimeout'];
  //$ldurlout = "http://".$_SERVER['HTTP_HOST'];
  $ldurlout = "http://".$_SERVER['HTTP_HOST']."/index.php/onepay/returnurl?out_order_id=".$out_order_id2;
  echo '<script type=text/javascript>alert("在'.TIME_OUT.'秒内只能访问一次！");</script>';
  echo '<script type=text/javascript>window.location.href="'.$ldurlout.'";</script>';
  exit();
 }
}
$_SESSION['ldtimeout'] = $ldtime;
?>
