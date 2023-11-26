/*
**************************
(C)2010-2015 uozhifu.com
update: 2014-5-22 00:05:34
person: Feng
**************************
*/


$(function(){

		//用户信息
		userInfo();

		//左侧菜单
		LeftMenuToggle();

		//锁屏按钮
		bindLockScreen();

		//快捷菜单
		bindQuickMenu();


	}).keydown(function(event){

	//快捷键
	if(event.keyCode == 27){
		window.top.location.href = 'logout.php';
	}
});



//用户信息
function userInfo(){
	$(".userPanel").mouseover(function(){
		$(".userPanel .arrow").addClass("on");
		$(".userPanel .panel").fadeIn(200);
	}).mouseout(function(){
		hidequcikmenu = setTimeout('$(".userPanel .panel").fadeOut(200);$(".userPanel .arrow").removeClass("on");',100);
		$(this).mouseover(function(){clearTimeout(hidequcikmenu);});
	});
}



//权限切换
function SelPrivID(id)
{
	$.get("ajax_do.php?action=selpriv&privid="+id+"&rnd="+parseInt(Math.random()*999),function(data){
		if(data == 1){
			window.top.location.reload(true);
		}
	});
}



//左侧菜单
function LeftMenuToggle()
{
	$("#logo").click(function(){
		if($(this).attr("class") == "logo"){
			$(".left").animate({width:"0"},300,function(){$(this).hide()});
			$(".right").animate({left:"0"},300);
			$(this).addClass("logoOn");
		}else{
			$(".left").show().animate({width:"218px"},300);
			$(".right").animate({left:"219px"},300);
			$(this).removeClass("logoOn");
		}
	});
}



//站点选择
function SelSite(sitekey)
{
	$.get("ajax_do.php?action=selsite&sitekeyvalue="+sitekey,function(data){
		if(data == 1){
			window.top.main.location.reload();
		}else if(data == 2){
			window.top.menu.location.reload();
			window.top.main.location.reload();
		}
	});

	$(".siteList a").attr("class","");
	$("#"+sitekey).attr("class","on");
}


//快捷菜单
function bindQuickMenu(){
	$(".quick").mouseover(function(){
		$(".quick .quickNav").addClass("on");
		$(".quick .quickmenu").fadeIn(200);
	}).mouseout(function(){
		hidequcikmenu = setTimeout('$(".quick .quickmenu").fadeOut(200);$(".quick .quickNav").removeClass("on");',100);
		$(this).mouseover(function(){clearTimeout(hidequcikmenu);});
	}).find("a").click(function(){
		$(this).blur();
		$(".quick .quickmenu").fadeOut(100);
	});
}