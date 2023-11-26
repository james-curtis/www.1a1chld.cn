
/*
**************************
(C)2010-2015 uozhifu.com
update: 2012-1-2 10:09:06
person: Feng
**************************
*/

$(function(){}).keydown(function(event){

	//快捷键
	if(event.keyCode == 27){
		window.top.location.href = 'logout.php';
	}
});


//验证管理员修改
function cfm_upadmin()
{
	if($("#oldpwd").val()!="" || $("#password").val()!="" || $("#repassword").val()!="")
	{
		if($("#oldpwd").val() == "")
		{
			alert("请填写旧密码！");
			$("#oldpwd").focus();
			return false;
		}
		else if($("#password").val() == "")
		{
			alert("请填写新密码！");
			$("#password").focus();
			return false;
		}
		else if($("#repassword").val() == "")
		{
			alert("请填写重复密码！");
			$("#repassword").focus();
			return false;
		}

		if($("#oldpwd").val()!="" && $("#password").val()!="" && $("#repassword").val()!="")
		{
			if($("#oldpwd").val().length<5 || $("#oldpwd").val().length>20)
			{
				alert("密码由5-20个字符组成，区分大小写！");
				$("#oldpwd").focus();
				return false;
			}
			if($("#password").val().length<5 || $("#password").val().length>20)
			{
				alert("密码由5-20个字符组成，区分大小写！");
				$("#password").focus();
				return false;
			}
			if($("#repassword").val() == "")
			{
				alert("请填写确认密码！");
				$("#repassword").focus();
				return false;
			}
			if($("#password").val() != $("#repassword").val())
			{
				alert("两次密码不同！");
				$("#repassword").focus();
				return false;
			}
		}

	}
}




