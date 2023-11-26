<?php require_once(dirname(__FILE__).'/inc/login.inc.php');

//检测版本号
if(phpversion() < '5.0')
{
	exit('用户您好，由于您的php版本过低，不能安装本软件，为了系统功能全面可用，请升级到5.0或更高版本再安装，谢谢！<br />您可以登录 phpMyWind.com 获取更多帮助');
}

//不限制响应时间
//error_reporting(0);
set_time_limit(0);

$urls=trim(htmlspecialchars($_REQUEST['urls']));
$appid=trim(htmlspecialchars($_REQUEST['appid']));
$userkey=trim(htmlspecialchars($_REQUEST['userkey']));
$fanhui=trim(htmlspecialchars($_REQUEST['fanhui']));
$jiekou=trim(htmlspecialchars($_REQUEST['jiekou']));
$adminname=trim(htmlspecialchars($_REQUEST['adminname']));
$password=trim(htmlspecialchars($_REQUEST['password']));

if ($urls=="" or $appid=="" or $userkey=="" or $jiekou=="" or $adminname=="" or $password==""){
exit("&#21442;&#25968;&#22635;&#20889;&#19981;&#27491;&#30830;&#35831;&#37325;&#26032;&#22635;&#20889;");
}else{

//验证数据库
$conn = mysqli_connect($db_host, $db_user, $db_pwd);
if($conn)
{

	if(mysqli_get_server_info($conn) < '4.0')
			{
				echo '<script>$("#install").append("检测到您的数据库版本过低，请更新！");</script>';
				exit();
			}
	//数据库创建完成，开始连接
	mysqli_select_db($conn, $db_name);

    $api = 1;
    if ($api == "1") {
        $sql = "create table `ld_ewmddh` (id int(11) not null auto_increment primary key,pay varchar(20) ,name varchar(255) ,zhanghao varchar(20) ,cny varchar(255),text1 varchar(255),text2 varchar(255),text3 varchar(255),text4 int(8) default '0',text5 int(8) default '0',uid varchar(255),appid varchar(255),timm varchar(255),timmt varchar(255),timme varchar(255),dingdanok int(8) default '0',ddh varchar(255))DEFAULT CHARSET=utf8";
        $sqll = "create table `ld_ewmszb` (id int(11) not null auto_increment primary key,pay varchar(20) ,name varchar(255) ,zhanghao varchar(20) ,cny varchar(255) ,appid varchar(255) ,picurl varchar(255) ,ewmurl varchar(255) ,fenzuid varchar(255) ,timm varchar(255),onoff int(6) default '0')DEFAULT CHARSET=utf8";
		$sql2 = "create table `ld_ewmzu` (id int(11) not null auto_increment primary key,zuname varchar(20) ,zhanghao varchar(20) ,money float(20) ,appid varchar(255),onoff int(6) default '0')DEFAULT CHARSET=utf8";
		$sql3 = "create table `ld_ewmadmin` (id int(11) not null auto_increment primary key,adminname varchar(255),password varchar(255),type varchar(255),custom1 varchar(255),custom2 varchar(255),custom3 varchar(255),custom4 varchar(255),custom5 varchar(255),custom6 varchar(255),urls varchar(255),appid varchar(255),userkey varchar(255),fkok int(2),jiekou varchar(255),fanhui varchar(255))DEFAULT CHARSET=utf8";
		$sql4 = "create table `ld_zhanghaozu` (id int(11) not null auto_increment primary key,zhanghao varchar(20) ,zfbewmurl varchar(255) ,qqewmurl varchar(255) ,wxewmurl varchar(255) ,type varchar(20) ,appid varchar(255))DEFAULT CHARSET=utf8";
		$sql5 = "create table `ld_failedlogin` (username char(30) not null primary key,ip char(15) ,time int(10) UNSIGNED ,num tinyint(1),isadmin tinyint(1))DEFAULT CHARSET=utf8";
		$sql6 = "create table `ld_zhanghaoon` (id int(11) not null auto_increment primary key,zhanghao varchar(20) ,onoff varchar(20) ,type varchar(20) ,appid varchar(255))DEFAULT CHARSET=utf8";
		$sql7 = "create table `ld_errorddh` (id int(11) not null auto_increment primary key,pay varchar(20) ,name varchar(255) ,zhanghao varchar(20) ,cny varchar(255),text1 varchar(255),text2 varchar(255),text3 varchar(255),text4 int(8) default '0',text5 int(8) default '0',paytimm varchar(255),appid varchar(255),timm varchar(255),timmt varchar(255),timme varchar(255),dingdanerror int(8) default '0',ddh varchar(255))DEFAULT CHARSET=utf8";
		
        mysqli_query($conn,$sql);
        mysqli_query($conn,$sqll);
		mysqli_query($conn,$sql2);
		mysqli_query($conn,$sql3);
		mysqli_query($conn,$sql4);
		mysqli_query($conn,$sql5);
		mysqli_query($conn,$sql6);
		mysqli_query($conn,$sql7);

		$password= md5(md5($password));
	    $types = "add_balance";
		$custom1= "1";
		$custom2= "approved";
		$custom3= time();
		$custom4= "1000000";
		$custom5= "0";
		$custom6=1;
		$fkok="1";

		$in_admin_pwd = "INSERT INTO `ld_ewmadmin` (`id`, `adminname`, `password`, `type`, `custom1`, `custom2`, `custom3`, `custom4`, `custom5`, `custom6`, `urls`, `appid`, `userkey`, `fkok`, `jiekou`, `fanhui`) VALUES(1, '". $adminname ."', '".$password ."', '". $types ."', '". $custom1."', '". $custom2 ."', '". $custom3 ."', '". $custom4 ."', '". $custom5 ."', '". $custom6 ."', '". $urls ."', '". $appid ."', '". $userkey ."', '". $fkok ."', '". $jiekou ."', '". $fanhui ."')";
        if(mysqli_query($conn,$in_admin_pwd))
		{}else{ die("&#28155;&#21152;&#25968;&#25454;&#20449;&#24687;&#38169;&#35823;&#44;&#35831;&#26816;&#26597;&#25968;&#25454;&#24211;&#26159;&#21542;&#23384;&#22312;&#32769;&#30340;&#25968;&#25454;&#24211;&#34920;&#65292;&#38656;&#35201;&#20808;&#21024;&#38500;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#25165;&#21487;&#20197;&#37325;&#26032;&#23433;&#35013;&#65292;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#26159;&#20197;&#8220;&#108;&#100;&#95;&#8221;&#24320;&#22987;&#30340;&#34920;&#38656;&#35201;&#20840;&#37096;&#21024;&#38500;&#21518;&#22312;&#37325;&#26032;&#23433;&#35013;&#65292;&#25110;&#26816;&#26597;&#25968;&#25454;&#24211;&#36830;&#25509;&#26159;&#21542;&#27491;&#30830;&#65292;&#25968;&#25454;&#24211;&#26159;&#21542;&#24050;&#32463;&#21019;&#24314;<br /><a href='javascript:history.go(-1);'>&#36820;&#22238;</a>");}
		
		$in_zhanghao = "INSERT INTO `ld_zhanghaozu` ( `zhanghao`, `type`, `appid`) VALUES(1,0, '". $appid ."')";
        if(mysqli_query($conn,$in_zhanghao))
		{}else{ die("&#28155;&#21152;&#25968;&#25454;&#20449;&#24687;&#38169;&#35823;&#44;&#35831;&#26816;&#26597;&#25968;&#25454;&#24211;&#26159;&#21542;&#23384;&#22312;&#32769;&#30340;&#25968;&#25454;&#24211;&#34920;&#65292;&#38656;&#35201;&#20808;&#21024;&#38500;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#25165;&#21487;&#20197;&#37325;&#26032;&#23433;&#35013;&#65292;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#26159;&#20197;&#8220;&#108;&#100;&#95;&#8221;&#24320;&#22987;&#30340;&#34920;&#38656;&#35201;&#20840;&#37096;&#21024;&#38500;&#21518;&#22312;&#37325;&#26032;&#23433;&#35013;&#65292;&#25110;&#26816;&#26597;&#25968;&#25454;&#24211;&#36830;&#25509;&#26159;&#21542;&#27491;&#30830;&#65292;&#25968;&#25454;&#24211;&#26159;&#21542;&#24050;&#32463;&#21019;&#24314;<br /><a href='javascript:history.go(-1);'>&#36820;&#22238;</a>");}
		
		$in_zhanghaoon = "INSERT INTO `ld_zhanghaoon` ( `zhanghao`, `onoff`, `type`, `appid`) VALUES(1,0,1, '". $appid ."')";
        if(mysqli_query($conn,$in_zhanghaoon))
		{}else{ die("&#28155;&#21152;&#25968;&#25454;&#20449;&#24687;&#38169;&#35823;&#44;&#35831;&#26816;&#26597;&#25968;&#25454;&#24211;&#26159;&#21542;&#23384;&#22312;&#32769;&#30340;&#25968;&#25454;&#24211;&#34920;&#65292;&#38656;&#35201;&#20808;&#21024;&#38500;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#25165;&#21487;&#20197;&#37325;&#26032;&#23433;&#35013;&#65292;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#26159;&#20197;&#8220;&#108;&#100;&#95;&#8221;&#24320;&#22987;&#30340;&#34920;&#38656;&#35201;&#20840;&#37096;&#21024;&#38500;&#21518;&#22312;&#37325;&#26032;&#23433;&#35013;&#65292;&#25110;&#26816;&#26597;&#25968;&#25454;&#24211;&#36830;&#25509;&#26159;&#21542;&#27491;&#30830;&#65292;&#25968;&#25454;&#24211;&#26159;&#21542;&#24050;&#32463;&#21019;&#24314;<br /><a href='javascript:history.go(-1);'>&#36820;&#22238;</a>");}
		
		$in_zhanghaoonq = "INSERT INTO `ld_zhanghaoon` ( `zhanghao`, `onoff`, `type`, `appid`) VALUES(1,0,2, '". $appid ."')";
        if(mysqli_query($conn,$in_zhanghaoonq))
		{}else{ die("&#28155;&#21152;&#25968;&#25454;&#20449;&#24687;&#38169;&#35823;&#44;&#35831;&#26816;&#26597;&#25968;&#25454;&#24211;&#26159;&#21542;&#23384;&#22312;&#32769;&#30340;&#25968;&#25454;&#24211;&#34920;&#65292;&#38656;&#35201;&#20808;&#21024;&#38500;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#25165;&#21487;&#20197;&#37325;&#26032;&#23433;&#35013;&#65292;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#26159;&#20197;&#8220;&#108;&#100;&#95;&#8221;&#24320;&#22987;&#30340;&#34920;&#38656;&#35201;&#20840;&#37096;&#21024;&#38500;&#21518;&#22312;&#37325;&#26032;&#23433;&#35013;&#65292;&#25110;&#26816;&#26597;&#25968;&#25454;&#24211;&#36830;&#25509;&#26159;&#21542;&#27491;&#30830;&#65292;&#25968;&#25454;&#24211;&#26159;&#21542;&#24050;&#32463;&#21019;&#24314;<br /><a href='javascript:history.go(-1);'>&#36820;&#22238;</a>");}
		
		$in_zhanghaoonw = "INSERT INTO `ld_zhanghaoon` ( `zhanghao`, `onoff`, `type`, `appid`) VALUES(1,0,3, '". $appid ."')";
        if(mysqli_query($conn,$in_zhanghaoonw))
		{}else{ die("&#28155;&#21152;&#25968;&#25454;&#20449;&#24687;&#38169;&#35823;&#44;&#35831;&#26816;&#26597;&#25968;&#25454;&#24211;&#26159;&#21542;&#23384;&#22312;&#32769;&#30340;&#25968;&#25454;&#24211;&#34920;&#65292;&#38656;&#35201;&#20808;&#21024;&#38500;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#25165;&#21487;&#20197;&#37325;&#26032;&#23433;&#35013;&#65292;&#32769;&#30340;&#20108;&#32500;&#30721;&#31995;&#32479;&#25968;&#25454;&#24211;&#34920;&#26159;&#20197;&#8220;&#108;&#100;&#95;&#8221;&#24320;&#22987;&#30340;&#34920;&#38656;&#35201;&#20840;&#37096;&#21024;&#38500;&#21518;&#22312;&#37325;&#26032;&#23433;&#35013;&#65292;&#25110;&#26816;&#26597;&#25968;&#25454;&#24211;&#36830;&#25509;&#26159;&#21542;&#27491;&#30830;&#65292;&#25968;&#25454;&#24211;&#26159;&#21542;&#24050;&#32463;&#21019;&#24314;<br /><a href='javascript:history.go(-1);'>&#36820;&#22238;</a>");}
		
		
        echo "&#23433;&#35013;&#25968;&#25454;&#20449;&#24687;&#23436;&#25104;&#65292;&#35831;&#24517;&#39035;&#21024;&#38500;install.php&#21644;newshujb.php&#25991;&#20214;&#21542;&#21017;&#21518;&#26524;&#33258;&#36127;&#65292;&#35831;<a href='index.php'><font color='#FF0000'>&#30331;&#38470;</font></a>&#28155;&#21152;&#37329;&#39069;&#20998;&#32452;";
     }
   }
	else
  {
	echo '<script>$("#install").append("数据库连接错误，请检查！");</script>';
	exit();
  }	 

}
?>