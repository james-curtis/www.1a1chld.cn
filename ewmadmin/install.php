<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>安装</title>
</head>
<style type="text/css">
<!--
a {
	font-size: 12px;
}
body,td,th {
	font-size: 12px;
}
.STYLE1 {color: #FF0000}
-->
</style>

<body>
<form action="newshujb.php" method="POST" >
    <table width="500" border="0" align="center" cellspacing="3" bordercolor="#FFFFFF" style="border: #999999 solid 1PX; margin-top:100px;">
      <tr>
        <td height="30" colspan="2" bgcolor="#E3E3E3"><h2 align="center">二维码系统配置</h2></td>
      </tr>
      <tr>
        <td width="285" height="30"><label>网址:（xxx.xxxx.com）格式 <span class="STYLE1">(需要开通了会员)</span> 填写你二维码系统的网址<br />
        </label></td>
        <td width="200">  <input name="urls" type="text" id="urls" style="height:30; border:#330066 solid 1px;" value="" /></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#E3E3E3"><label>APPID:</label></td>
        <td bgcolor="#E3E3E3"><input name="appid" type="text" id="appid"  style="height:30; border:#330066 solid 1px;"  /></td>
      </tr>
      
      <tr>
        <td height="30"><label>KEY:</label></td>
        <td><input name="userkey" type="text" id="userkey"  style="height:30; border:#330066 solid 1px;" /></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#E3E3E3">返回值接收文件:</td>
        <td bgcolor="#E3E3E3"><input name="fanhui" type="text" id="fanhui"  style="height:30; border:#330066 solid 1px;" /></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#FFFFFF"><label>网站返回跳转文件:（就是支付成功后自动跳转回哪个页面，如果没有可以设置成首页）<span class="STYLE1">(网址格式：www.xxxx.com/tiaozhuan.php)</span><br />
        </label></td>
        <td bgcolor="#FFFFFF"><input name="jiekou" type="text" id="jiekou"  style="height:30; border:#330066 solid 1px;" /></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#E3E3E3"> <label>管理员:</label></td>
        <td bgcolor="#E3E3E3"><input name="adminname" type="text" id="adminname"   style="height:30; border:#330066 solid 1px;" /></td>
      </tr>
      <tr>
        <td height="30" bgcolor="#FFFFFF"><label>管理员密码:</label></td>
        <td bgcolor="#FFFFFF"><input name="password" type="text" id="password"   style="height:30; border:#330066 solid 1px;" /></td>
      </tr>
      <tr>
        <td height="30"></td>
        <td><input type='submit' value="配置生成" /></td>
      </tr>
    </table>
    </form>
</body>
</html>