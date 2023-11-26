<?php 
error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
date_default_timezone_set('PRC');//设成北京时间
header('Content-Type:text/html;charset=utf-8;');
$g_is_insert=0;
$g_is_small=1;//是否生成小图
$g_is_mid=0;//是否生成中图
$g_is_yuanming=0;//1为原标题
$g_is_jiequ=0;
$g_dirtou="uploads"; //这个头文件夹要设一下
$g_dir1="uploads/p/s50/";//小图文件夹
$g_dir2="uploads/p/s80/";//中图文件夹
$g_dir3="uploads/p/s100/";//大图文件夹
$g_dir4="uploads/img/";//图文件夹
$g_dir_audio="uploads/shipin/";//视频文件夹
$g_dir_other="uploads/data/"; //文件夹
$g_cengci="../../../"; //
$g_w1=300; //小图宽
$g_w2=400; //中图宽
$g_h1=300; //小图高
$g_h2=400; //中图高
$g_fenge="#";

?>