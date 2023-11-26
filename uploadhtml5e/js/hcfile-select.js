// JavaScript Document
function hcfileselect(){
	  var hcfileselect_={
		   init:function(opt){
			    var t=this;
			     var hz=document.documentElement.clientHeight||document.body.clientHeight; 
			     var wz=document.documentElement.clientWidth||document.body.clientWidth; 
				
				 t.parentid="hcfileselect_"+opt.input_id;
				 t.parent=document.getElementById(t.parentid);
				 if(t.parent){
					 t.parent.style.display="block";  
					 return false;
				 }
				 t.parent=t.create({tagName:"div",className:"hcfileselect",id:t.parentid});
				 t.body1=document.getElementsByTagName("body")[0];
				 t.body1.appendChild(t.parent);
				 var panel_id="hcfileselectpanel_"+opt.input_id;
				 var weizhi_id="hcfileselectpanel_"+opt.input_id+"_bt";
				 var html="<div class='hcfsp_rel'>";
				 html+="<div class='hcfsp_main'>";
				 html+="<div class='hcfsp_tag'>";
				 html+="<div class='tag'>在线上传</div><div class='tag'>本地文件</div><div class='tag'>远程文件</div><div class='close'>×</div>";
				 html+="</div>";
				 html+="<div class='hcfileselectpanel'>";

				 html+="<div class='panel'><span id='"+weizhi_id+"' style='width:120px;  height:40px; background-color:#666; display:block; text-align:center;color:#fff;margin:5px;'><center style='line-height:40px;'>选择文件</center></span><div id='"+panel_id+"' ></div></div>";
				 html+="<div class='panel' style='display;none;'></div>";
				 html+="<div class='panel' style='display;none;'></div>";
				 html+="</div>";
				 html+="</div>";
				 html+="</div>";
				 t.parent.innerHTML=html;
				 $(t.parent).find(".tag").click(function(){
					$(t.parent).find(".panel").hide().eq($(this).index()).show();						   
				 });
				  $(t.parent).find(".close").click(function(){
				   t.parent.style.display="none"; 
				});
				 t.list1=document.getElementById(panel_id);
				 var h1=parseInt(t.parent.offsetHeight-90);
				 t.list1.style.cssText="height:"+h1+"px;overflow:auto;";
				 var myhcfile=hcfile().Init({
						//  item_values:item_values,
						  url:opt.url,
						  width:79,//按钮宽度
						  height:78,//按钮高度
						  maxnum:100,//只能上传N张
						  isfull:0,//1为返回带http的完整地址
						  isnewsmall:0,//1为生成小图
						  isdelfile:1,
						  zifu_num:0.1*1024*1024,//指分片上传，每片每次上传多少字符
						  type:"img",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
						  input_id:opt.input_id,//存多张图片路径的input的id
						  weizhi_id:weizhi_id,//按钮位置对像id
						  panel_id:panel_id,//图片显示对象id
						  nullstr:"<div style='text-align:center;line-height:"+h1+"px;background-color:#f5f5f5; font-size:15px;'>请上传图片</div>",
						  drop_to_id:panel_id,//拖曳的对象id
						  send_id:"",//上传按钮位置对像id,填写空表示选好自动上传
						  item_class:"",
						  yasuo:{type:"width",width:500},//压缩配置
						  init_show:{date:0,size:0,img:1,name:0,bar:1,baifenbi:1,del:0,bg:1,fengmian:0,see:0},
						  upload_show:{date:0,size:0,name:1,bar:1,baifenbi:1,del:0},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条)
						  success_show:{date:0,size:0,name:0,bar:0,baifenbi:0,del:1,fengmian:0},//上传完后要显示的元素,1:显示,0不显示
						  upload_defore:function(op){ //上传之前验证
							   console.log(op);

						  },
						  del_before:function(op){
							   if(confirm("是否要删除")){
								  return true;
							   }else{
								  return false;
							   };
							   return true;
						  },click_img:function(op){
							 t.parent.style.display="none";   
						  }
				 });
		   },css:function(obj,opt){
			   if(obj){ for(var k in opt){obj.style[k]=opt[k]; }}
		   },create:function(opt){
				 var obj=document.createElement(opt.tagName); 
				 if(typeof(opt.className)!="undefined"){obj.className=opt.className;}
				 if(typeof(opt.type)!="undefined"){obj.type=opt.type; }
				 if(typeof(opt.cssText)!="undefined"){obj.style.cssText=opt.cssText;}
				 if(typeof(opt.id)!="undefined"){ obj.id=opt.id;}
				 if(typeof(opt.html)!="undefined"){obj.innerHTML=opt.html;}
				 if(typeof(opt.value)!="undefined"){ obj.value=opt.value;}
				 if(typeof(opt.style)!="undefined"){
				   for(var key in opt.style){obj.style[key]=opt.style[key];}
				 };
				 return obj;
		   }
	  };
	  return hcfileselect_;
}