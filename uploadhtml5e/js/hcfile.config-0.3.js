// JavaScript Document
/*
  2016-09-27到2018-05-25
  原创:惠聪网络
  原创QQ:632175205
  淘店a:http://91huicong.taobao.com/
  淘店b:https://congweb.taobao.com/
  不懂可以加我qq632175205,下午在线
  电话：13799835338，小聪
  asp .net php各版都有 20几个例子 可定制
*/
var cur_config_path="";
var scripts=document.getElementsByTagName("script"); //ie 6 ie 7 ie8 是不支持 document.scripts的
for(var i=0;i<scripts.length;i++){
	if(typeof(scripts[i].src)!="undefined"){
		if(scripts[i].src.indexOf("hcfile.config-0.3.js")){
	        cur_config_path=scripts[i].src;//获取当前文件 
		}
	}
};
var url2017site="";
var url2017="";
if(cur_config_path.indexOf("http")==0&&cur_config_path.indexOf(":")>-1){//判断是不是带http开头的,现在的浏览器都是完整的除ie 
	var arr2017=cur_config_path.split("/");
	for(var i=0;i<(arr2017.length-2);i++){ //获取插件所在文件夹
		  url2017+=arr2017[i]+"/";
	}
	for(var i=0;i<(arr2017.length-3);i++){ //获取当前域名
		  url2017site+=arr2017[i]+"/";
	}
}else{  //ie6 , ie 7 , ie 8情况
     var cururl=String(window.location);
	 var arra=cururl.split("/");
	 var curdir="";
	 var arrc=cur_config_path.split("/");
	 var cengci_count=0;
     for(var i=0;i<(arrc.length);i++){ //获取插件所在文件夹
		 if(arrc[i]==".."){
			  cengci_count++;
		 }
	}
	for(var i=0;i<(arra.length-1-cengci_count);i++){ //获取插件所在文件夹
		  curdir+=arra[i]+"/";
	}
	var cur_path=cur_config_path;
	cur_path=cur_path.replace(/\.\.\//g,"");//替换掉../
	cur_path=cur_path.replace(/\.\//g,"");//替换掉./
	var new_cur_config_path=curdir+cur_path;
	var arr2017=new_cur_config_path.split("/");
	for(var i=0;i<(arr2017.length-2);i++){ //获取插件所在文件夹
		  url2017+=arr2017[i]+"/";
	}
	for(var i=0;i<(arr2017.length-3);i++){ //获取当前域名
		  url2017site+=arr2017[i]+"/";
	}
}

var g_margin=4;
var g_exts=[];
var g_isshowbar=1;
var g_isfengmian=0;// 1:设为封面
var g_fenge="#";//多张用#分隔开
var g_siteurl="";//当前域名
var g_siteurl_file=""; //这个最好改一下 显示图片所在的网址 如http://www.hao123.com/file/1.jpg ,则是http://www.hao123.com/
var g_ico_path="";//默认图标所在文件夹 这个是处在上传时显示的默认图标 如jpg.png这个图标是uploadhtml5e/images里那么就要填写成  http://www.hao123.com/uploadhtml5e/images/
var g_moren_bgsrc="";
var g_isfull=0;//是否返回完整的路径
var g_moren_srcs={all:"class4.png",img:"class4.png",yinpin:"class4.png",shipin:"class4.png",file:"class4.png"};
var g_zifu_num=1024*150;//上传字符串长度 字节
var g_isshowsize=1;//显示文件大小
var g_isshowdata=0;//显示返回结果
var g_isdelfile=0; //默认不执行删除空间上的图片
var g_isnewsmall=0;//是否生成小图
var g_isyulan=1;//显示预览图片

var conf_yasuo_image={type:0,width:600,height:700,zhiliang:0.95,max_zijie:1024*200};//type 0为不压缩,1或w为按宽压缩，2或h为按高压缩,zijie 文件大小若超过max_zijie,zhiliang:压缩质量1为最大值 max_zijie:如大小超过这个则压缩
//得到当前域名
if(g_siteurl_file==""){g_siteurl_file=url2017site;}
if(g_siteurl==""){g_siteurl=url2017site; }
if(g_ico_path==""){g_ico_path=url2017+"images/"; }
// console.log(document);
//alert(g_siteurl_file);
//Content-Type 对照表
g_exts.push({type:"img",ext:"jpg",contenttype:"image/jpg",src:"jpg.png"});
g_exts.push({type:"img",ext:"jpeg",contenttype:"image/jpeg",src:"jpg.png"});
g_exts.push({type:"img",ext:"png",contenttype:"image/png",src:"png.png"});
g_exts.push({type:"img",ext:"gif",contenttype:"image/gif",src:"jpg.png"});
g_exts.push({type:"img",ext:"png",contenttype:"image/webp",src:"png.png"});

g_exts.push({type:"yinpin",ext:"mp3",contenttype:"video/mpeg",src:"video.png"});
g_exts.push({type:"yinpin",ext:"mp3",contenttype:"audio/mp3",src:"video.png"});


g_exts.push({type:"shipin",ext:"mp4",contenttype:"video/mp4",src:"mp4.png"});
g_exts.push({type:"shipin",ext:"mov",contenttype:"video/quicktime",src:"video.png"});
g_exts.push({type:"shipin",ext:"wma",contenttype:"audio/x-ms-wma",src:"wma.png"});
g_exts.push({type:"shipin",ext:"wmv",contenttype:"video/x-ms-wmv",src:"wmv.png"});
g_exts.push({type:"shipin",ext:"avi",contenttype:"video/avi",src:"avi.png"});
g_exts.push({type:"shipin",ext:"flv",contenttype:"",src:"avi.png"});
g_exts.push({type:"shipin",ext:"rmvb",contenttype:"",src:"video.png"});


g_exts.push({type:"file",ext:"xls",contenttype:"application/vnd.ms-excel",src:"xls.png"});
g_exts.push({type:"file",ext:"xlsx",contenttype:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",src:"xlsx.png"});
g_exts.push({type:"file",ext:"doc",contenttype:"application/msword",src:"doc.png"});
g_exts.push({type:"file",ext:"docx",contenttype:"application/vnd.openxmlformats-officedocument.wordprocessingml.document",src:"docx.png"});
g_exts.push({type:"file",ext:"zip",contenttype:"application/zip",src:"zip.png"});
g_exts.push({type:"file",ext:"zip",contenttype:"application/x-zip-compressed",src:"zip.png"});
g_exts.push({type:"file",ext:"rar",contenttype:"application/octet-stream",src:"rar.png"});
g_exts.push({type:"file",ext:"txt",contenttype:"text/plain",src:"txt.png"});
g_exts.push({type:"file",ext:"csv",contenttype:"text/plain",src:"csv.png"});
g_exts.push({type:"file",ext:"pdf",contenttype:"application/pdf",src:"pdf.png"});
g_exts.push({type:"file",ext:"cr2",contenttype:"",src:"txt.png"});
g_exts.push({type:"file",ext:"mov",contenttype:"",src:"mov.png"});

var g_conf={
	newsmall:{height:300},
	color:"#666666",
	rel:{bordercolor:"#CCCCCC",bordercolor1:"#FF0000"},
	bt:{bgcolor:"#f0f0f0",bgcolor1:"#FF0000"},
	fengmian:{bgcolor:"#f0f0f0",bgcolor1:"#FF0000",color:"#666666",color1:"#FFFFFF"},
	size:{bgcolor:"#000000",color:"#ffffff"},
	myitem:{cssText:"border:solid 0px #CCCCCC;position:relative;float:left;margin:2px;overflow:hidden;"},
	rel_img:{cssText:"position:absolute;top:0px;left:0px;height:100%;width:100%;z-index:199;background-color:#000;color:#ffffff; text-align:center;"},
	rel_baifenbi:{cssText:"display:none;position:absolute;top:50%;left:0px;height:100%;width:100%;z-index:205;color:#ffffff; text-align:center;margin-top:-7px;font-size:12px;"},
	rel_bar:{cssText:"position:absolute;top:0px;left:0px;height:100%;width:100%;z-index:199;background-color:#000;filter:alpha(opacity=50); -moz-opacity:0.5;opacity:0.5;color:#ffffff; text-align:center;"},
	rel_baifenbi:{cssText:"display:none;position:absolute;top:50%;left:0px;height:100%;width:100%;z-index:205;color:#ffffff; text-align:center;margin-top:-7px;font-size:12px;"},
	rel_size:{cssText:"position:absolute;cursor:pointer;padding:0px;border:0px;left:0px;bottom:0px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:20px;height:20px;color:#ffffff;background-color:#000000;z-index:200"},
	rel_filesize:{cssText:"position:absolute;cursor:pointer;padding:0px;border:0px;left:0px;bottom:0px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:80px;height:80px;color:#ffffff;background-color:#000000;z-index:200"},
	rel_name:{cssText:"dposition:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:0px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:20px;height:20px;color:#ffffff;background-color:#000000;z-index:200"},
	rel_date:{cssText:"position:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:20px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:20px;height:20px;color:#ffffff;background-color:#000000;z-index:200"},
	rel_chongchuan:{cssText:"dposition:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:40px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:20px;height:20px;color:#ffffff;background-color:#000000;z-index:200"},
    rel_del:{cssText:"border:0px;position:absolute;width:auto;min-width:20px;cursor:pointer; margin:0px; top:1px; text-align:center;right:1px;overflow:hidden;background-color:#f0f0f0;color:#666666;z-index:2050;line-height:18px;height:20px;"},
	rel_bg:{cssText:"position:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:20px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:0px; padding-left:5px;padding-right:5px;font-size:12px;display:block;height:50px;color:#ffffff;z-index:200"},
	rel_see:{cssText:"border:0px;position:absolute;width:auto;min-width:20px;cursor:pointer; margin:0px; top:1px; text-align:center;left:1px;overflow:hidden;background-color:#f0f0f0;color:#666666;z-index:200;line-height:18px;height:20px;"},
	rel_prev:{cssText:"position:absolute;cursor:pointer;padding:0px;border:0px;left:0px;top:50%;margin:0px;margin-top:-11px;overflow:hidden;text-align:center;filter:alpha(opacity=50);opacity:0.5;-webkit-opacity:0.5; -moz-opacity:0.5;padding:0px; padding-left:5px;padding-right:5px;font-size:18px;display:block;line-height:20px;height:20px;font-family:Arial, Helvetica, sans-serif;color:#ffffff;background-color:#000000;z-index:202"},
	rel_next:{cssText:"position:absolute;cursor:pointer;padding:0px;border:0px;right:0px; top:50%;margin:0px;margin-top:-11px;overflow:hidden;text-align:center;filter:alpha(opacity=50);opacity:0.5;-webkit-opacity:0.5; -moz-opacity:0.5;padding:0px; padding-left:5px;padding-right:5px;font-size:18px;display:block;line-height:20px;height:20px; font-family:Arial, Helvetica, sans-serif; color:#ffffff;background-color:#000000;z-index:202"},
	rel_insert:{cssText:"position:absolute;bottom:0px; cursor:pointer; text-align:center; left:0px; width:100%; white-space:nowrap;filter: alpha(opacity=80);background-color: #000000; color:#FFFFFF;opacity: 0.8; line-height:18px;z-index:208;"},
	rel_chongxuan:{cssText:""},
	rel_fengmian:{cssText:"position:absolute;cursor:pointer;font-weight:bold; top:1px;padding:0px;border:0px;left:1px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;line-height:18px;height:20px;width:20px;z-index:400;color:#666666;background-color: #f0f0f0;"},
	rel_meimiao:{cssText:"position:absolute;cursor:pointer;font-weight:bold; top:30px;padding:0px;border:0px;left:1px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;line-height:18px;height:20px;width:20px;z-index:400;color:#666666;background-color: #f0f0f0;"},
	rel_down:{cssText:"position:absolute;cursor:pointer;font-weight:bold; top:30px;padding:0px;border:0px;left:1px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;line-height:18px;height:20px;width:20px;z-index:400;color:#666666;background-color: #f0f0f0;"},
    tishi:{cssText:"filter:alpha(opacity=80);border-radius:5px;background-color:#000000;opacity:0.8;-webkit-opacity:0.8;left:50%;width:140px;top:50%;margin-left:-70px;margin-top:-50px; -moz-opacity:0.8;height:50px;line-height:50px;text-align:center;color:#fff;font-size:15px;position:fixed;z-index:5000;"},
    image:{cssText:"width:100%;height:100%;border:0px;"}
};
