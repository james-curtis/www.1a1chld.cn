// JavaScript Document
var url2017site="",g_siteurl_file="",g_ico_path="",g_siteurl="";
var jss=document.scripts;
var cur_js_path=jss[jss.length-1].src.substring(0,jss[jss.length-1].src.lastIndexOf("/")+1);
var arr2017=cur_js_path.split("/"),url2017="";
for(var i=0;i<(arr2017.length-2);i++){url2017+=arr2017[i]+"/";}//获取默认图标所在路径
for(var i=0;i<(arr2017.length-3);i++){url2017site+=arr2017[i]+"/";}
if(g_siteurl_file==""){g_siteurl_file=url2017site;}
if(g_siteurl==""){g_siteurl=url2017site; }
if(g_ico_path==""){g_ico_path=url2017+"images/"; }
// console.log(document);
if(g_siteurl_file==""||g_siteurl_file=="/"){ //这个是针对 ie6 和ie7，他们没法获取当前js文件自身的完整url
     g_siteurl="http://"+document.domain+"/";
     if(String(window.location.href).indexOf("https://")!=-1){g_siteurl="https://"+document.domain+"/";}else{g_siteurl="http://"+document.domain+"/";}
	//g_siteurl="http://xiaocong201705.get.vip/";
	g_siteurl_file =g_siteurl;
	g_ico_path=g_siteurl+"uploadhtml5e/images/";
}
function hcupfile(){
	var hcupfile_={
			create:function(opt){
				  var t=this;
				  t.opt=opt;
				  t.conf={type:"all",maxnum:10000000,fdsize:1024*15,isnewsmall:0};
				  t.result={isfull:0,type:"path",fenge:"#",fenge_child:"[g]"};//配置
				  t.yasuo={status:0,type:"width",value:600};
				  t.upload_url=opt.upload_url;
				  t.input=$(opt.inputid);
				  t.fdsize=t.conf.fdsize;
				  t.auto=1;
				  t.limit=3;
				  t.myfiles={};
				  t.ofileid="file"+t.randnum(12);
				   t.panel=null;
				   t.input_fengmian=null;
				   if(typeof(opt.panelid)!="undefined"){
				     t.panel=$(opt.panelid);
				   }
				   t.input_id=t.input.attr("id");
				  t.ico_path=g_ico_path;
				  t.siteurl=g_siteurl;
				   t.siteurl_file=g_siteurl_file;
				  t.input.parent().append("<div style=\"position: relative; height: 0.1px; overflow: hidden;\"><input accept=\"*\"  id=\""+t.ofileid+"\" type=\"file\" multiple=\"true\" style=\"top: -100px; position: absolute;\"></div>");
				  t.inputfile=$("#"+t.ofileid);
				  

				  t.inputfile.change(function(){
						t.check_files({files:this.files});
				  });
				  if(typeof(opt.load_before)!="undefined"){
				    t.load_before=opt.load_before;
				  };
				  if(typeof(opt.upload_before)!="undefined"){
				    t.upload_before=opt.upload_before;
				  };	
				  if(typeof(opt.upload_progress)!="undefined"){
				    t.upload_progress=opt.upload_progress;
				  };	
				  if(typeof(opt.upload_success)!="undefined"){
				    t.upload_success=opt.upload_success;
				  };	
				  if(typeof(opt.delete_before)!="undefined"){
				    t.delete_before=opt.delete_before;
				  };	
				  if(typeof(opt.delete_success)!="undefined"){
				    t.delete_success=opt.delete_success;
				  }; 
				  if(typeof(opt.see_click)!="undefined"){
				    t.see_click=opt.see_click;
				  }; 
				  if(typeof(opt.delete_click)!="undefined"){
				     t.delete_click=opt.delete_click;
				  }; 
				  if(typeof(opt.type)!="undefined"){
					  if(opt.type=="img"){
						  if(typeof(opt.exts)=="undefined"){
				             t.opt.exts="gif,png,jpg,jpeg,bmp";
						  }
					  }
					  if(opt.type=="file"){
						  if(typeof(opt.exts)=="undefined"){
				             t.opt.exts="gif,png,jpg,jpeg,bmp,mp4,doc,rar,zip,pdf,docx,xls,xlsx";
						  }
					  }
				  }; 
				   if(typeof(opt.yasuo)!="undefined"){ 
				     for(var k in opt.yasuo){
					   t.yasuo[k]=opt.yasuo[k];
					 }
				   }
				 if(typeof(opt.isnewsmall)!="undefined"){
				     t.conf.isnewsmall=opt.isnewsmall;
				  }
				 if(typeof(opt.send_id)!="undefined"){
					   if($(opt.send_id).length>0){
						  t.auto=0;
						  $(opt.send_id).click(function(){
							     t.start();						 
						  });
					   }
				 };
				  if(typeof(FileReader)== 'undefined'){
					       t.create_submit_iframe();
				  }else{
						  $(opt.selectbt).each(function(){
								  $(this).click(function(){
									   var num_tishi="";
									   if(typeof(t.opt.maxnum)!="undefined"&&t.opt.maxnum!=""){
										  var items=t.panel.find(".hcupitem");
										  if(items.length+1>t.opt.maxnum){
											   num_tishi="最多只能上传"+t.opt.maxnum+"件";
											   isbool=false;
										  }
									   }
									   if(num_tishi!=""){
									   t.myalert(num_tishi);
									   }else{
									    t.inputfile[0].click();
									   }
								  });
						  });
				  }
				 if(typeof(opt.fengmianid)!="undefined"){
				     t.input_fengmian=$(opt.fengmianid);
				  }
				   if(t.input){
				      window["hcupfile"+t.input.attr("id")]=t;
				   }
				  if(t.input.val()!=""){
					      t.showitem({paths:t.input.val()});
				  }
		},showitem:function(opt){//显示项出来
					  var t=this;
					  if(typeof(opt.item_values)!="undefined"){
							  t.item_values=opt.item_values;
							   if(typeof(t.item_values)=="string"){
									 var arr=t.item_values.split(""+t.result.fenge);
									 t.item_values=[];
									 for(var i=0;i<arr.length;i++){
										var itema={};
										if(arr[i]!=""){
											var arr1=arr[i].split(""+t.result.fenge_child);
											if(typeof(t.item_values_fields)=="array"){
												for(var j=0;j<t.item_values_fields;j++){
													  var k=t.item_values_fields[j];
													   itema[k]="";
													   if(typeof(arr1[j])!="undefined"){
														   itema[k]=arr1[j];  
													   }
												}
											}else{
												itema["src"]=arr1[0];itema["title"]=arr1[0];
												if(arr1.length>1){itema["title"]=arr1[1];}
											}
											t.item_values.push(itema);   
										}
									 }
									 
							   }
							for(var i=0;i<t.item_values.length;i++){
								var row=t.item_values[i];
								t.num++;
								var small_src=t.GetSmallImg(row['src']);
								var big_src=small_src,arr2=small_src.split("."),ext=arr2[arr2.length-1];
								
								  var src=t.siteurl_file+small_src;
								   if(t.IsImg(ext)){
									   if(t.conf.isnewsmall==0){
											 big_src=small_src;
										}else{
											 big_src=t.GetBigImg(small_src);
										}
								  }else{
										   src=t.GetExtSrc(g_exts,ext)  ;
								  }
									   var arr2=src.split("/");
									   var name=arr2[arr2.length-1];
									   var fileid="item"+t.randnum(10);
									   var opt={fileid:fileid,src:src,small_src:small_src,big_src:big_src,name:name,row:row};
									   t.load_before(opt);
									   $("#"+fileid).attr("data-small_src",small_src);
									   $("#"+fileid).attr("data-filepath",big_src);
									   t.add_item_event({fileid:fileid});
									   if(typeof(t.input_fengmian)!="undefined"&&t.input_fengmian.val()==small_src){
									         t.SetFengMianInput({fileid:fileid});
									   }
									   if(typeof(t.opt.success_show)!="undefined"){
										  $("#"+fileid).children().hide();
										  $("#"+fileid).find(t.opt.success_show).show();
									   };
							}
					 }
					 if(typeof(opt.paths)!="undefined"){
							  var arr=opt.paths.split(t.result.fenge);
							  for(var i=0;i<arr.length;i++){
								   if(arr[i]!=""&&arr[i].indexOf("/")!=-1){
									   t.num++;
									   var small_src=t.GetSmallImg(arr[i]);
									   var big_src=arr[i],arr2=small_src.split("."),ext=arr2[arr2.length-1];
									   var src=t.siteurl_file+small_src;
									   if(t.IsImg(ext)){
										   if(t.conf.isnewsmall==0){
												 big_src=small_src;
											}else{
												 big_src=t.GetBigImg(small_src);
											}
									   }else{
										   src=t.getmorensrc(g_exts,ext);
									   }
									   var arr2=src.split("/");
									   var name=arr2[arr2.length-1];
									   var fileid="item"+t.randnum(10);
									   var opt={fileid:fileid,src:src,small_src:small_src,big_src:big_src,name:name};
									   t.load_before(opt);
									   $("#"+fileid).attr("data-small_src",small_src);
									   $("#"+fileid).attr("data-filepath",big_src);
									   
									   t.add_item_event({fileid:fileid});
									   if(typeof(t.input_fengmian)!="undefined"&&t.input_fengmian.val()==small_src){
									         t.SetFengMianInput({fileid:fileid});
									   }
									   if(typeof(t.opt.success_show)!="undefined"){
										  $("#"+fileid).children().hide();
										  $("#"+fileid).find(t.opt.success_show).show();
									   };
								   }
							  }

					 }
		
			 },randnum:function(n){
				var rnd="";
				for(var i=0;i<n;i++){
				   rnd+=Math.floor(Math.random()*10);
				}
				return rnd;
			},check_files:function(opt){//检查文件
				var t=this;
				var ext_tishi="";
				var num_tishi="";
				 for(var i=0;i<opt.files.length;i++){
								  var f=opt.files[i];
								 // console.log("f",f);
								 var isbool=false;
								 var ext=t.getfileext({file:f});
								 if(typeof(t.opt.exts)!="undefined"&&t.opt.exts!=""){
									  var arr=t.opt.exts.split(",");
									  for(var j=0;j<arr.length;j++){
										    if(arr[j]==ext){
												isbool=true;
											}
									  }
									  if(isbool==false){
										  if(ext_tishi!=""){
										     ext_tishi+=","+ext;
										  }else{
											  ext_tishi+=ext;
										  }
									  }
								 }else{
									  isbool=true;
								 }
								  if(typeof(t.opt.maxnum)!="undefined"&&t.opt.maxnum!=""){
									  var items=t.panel.find(".hcupitem");
									  if(items.length+1>t.opt.maxnum){
										   num_tishi="最多只能上传"+t.opt.maxnum+"件";
									       isbool=false;
									  }
								  }
								 
								 if(isbool){
									  var fileid="item"+t.randnum(10);
									  var item1={status:0,file:f,index:0,fileid:fileid};
									  t.myfiles[fileid]=item1;
									  if(typeof(t.load_before)!="undefined"){
											 t.load_before({fileid:fileid,src:t.getmorensrc({file:f}),name:f.name});
									  }
									  t.add_item_event({fileid:fileid});
								 }

				  };
				  if(ext_tishi!=""){
					  t.myalert("不允许上传\""+ext_tishi+"\"后缀文件");
				  }
				  if(num_tishi!=""){
					  t.myalert(num_tishi);
				  }
				  //console.log(t.myfiles);
				  if(t.auto||t.auto==1){
				     t.start();
				  }
		   },add_item_event:function(opt){
			   var t=this;
			   var fileid=opt.fileid;
				$("#"+fileid).children().hide();
				
				if(typeof(t.opt.load_show)!="undefined"){
				  $("#"+fileid).find(t.opt.load_show).show();
				};
				if(typeof(t.opt.item_delete_bt)!="undefined"){
					 $("#"+fileid).find(t.opt.item_delete_bt).attr("fileid",fileid);
					 $("#"+fileid).find(t.opt.item_delete_bt).click(function(e){
							 var fileid=$(this).attr("fileid");
							if(typeof(t.delete_before)!="undefined"){
									var isbool=t.delete_before({fileid:fileid});
									if(isbool||typeof(isbool)=="undefined"){
										t.deletefile({fileid:fileid});
										$("#"+fileid).remove();    
									}
							}else{
									 t.deletefile({fileid:fileid});
									 $("#"+fileid).remove();
							}
							if( e && e.stopPropagation ){e.stopPropagation();}else{window.event.cancelBubble = true;return false;}//取消事件冒泡
					 });
				};
			 if(typeof(t.opt.item_see_bt)!="undefined"){
				$("#"+fileid).find(t.opt.item_see_bt).attr("fileid",fileid);
				$("#"+fileid).find(t.opt.item_see_bt).click(function(e){
						var fileid=$(this).attr("fileid");
						if(typeof(t.see_click)=="undefined"){
							var filepath=$("#"+fileid).attr("data-filepath");
							if(filepath&&typeof(filepath)!="undefined"){
										  var bigsrc=t.GetBigImg(filepath);
										  var http='';
										  if(bigsrc.indexOf("http://")==-1){http=t.siteurl_file;}
										  if(bigsrc.indexOf("https://")==-1){http=t.siteurl_file;}
										  if(t.conf.isnewsmall==0){
												window.open(http+bigsrc);
										  }else{
												window.open(http+bigsrc);
										  }
	
							}else{
								t.myalert("查看不了");
							}
							if( e && e.stopPropagation ){e.stopPropagation();}else{window.event.cancelBubble = true;return false;}//取消事件冒泡
						}else{
							  t.see_click({fileid:fileid});
						}
						
				});
			 };
			 
			if(typeof(t.opt.item_fengmian_bt)!="undefined"){
				 $("#"+fileid).find(t.opt.item_fengmian_bt).attr("fileid",fileid);
				 $("#"+fileid).find(t.opt.item_fengmian_bt).click(function(e){
						var fileid=$(this).attr("fileid");
						t.SetFengMianInput({fileid:fileid});
						if( e && e.stopPropagation ){e.stopPropagation();}else{window.event.cancelBubble = true;return false;}//取消事件冒泡
				 });
				 if(t.opt.item_fengmian_bt.indexOf(".this")!=-1){
					 $("#"+fileid).click(function(e){
							var fileid=$(this).attr("id");
							t.SetFengMianInput({fileid:fileid});
							if( e && e.stopPropagation ){e.stopPropagation();}else{window.event.cancelBubble = true;return false;}//取消事件冒泡
					 });  
				 }
				 
			}
			if(typeof(t.opt.item_fengmian_bt)!="undefined"){
				 $("#"+fileid).find(t.opt.item_fengmian_bt).attr("fileid",fileid);
				 $("#"+fileid).find(t.opt.item_fengmian_bt).click(function(e){
						var fileid=$(this).attr("fileid");
						t.SetFengMianInput({fileid:fileid});
						if( e && e.stopPropagation ){e.stopPropagation();}else{window.event.cancelBubble = true;return false;}//取消事件冒泡
				 });
			}
		   },SetInput:function(opt){
			       var t=this;
				   var json=eval("("+opt.result+")");
				   var myitem=$("#"+opt.fileid);
					  var iscx=0;
					  var oldsmallsrc="";
					  if(myitem!=null){
						   if(typeof(myitem.attr("iscx"))!="undefined"&&myitem.attr("iscx")!=null){
							  iscx=parseInt(myitem.attr("iscx")); 
							  oldsmallsrc=myitem.attr("data-small_src");
						   }
					  }
					if(t.input){ 
					         if(typeof(t.opt.item_values_fields)!="undefined"&&t.opt.item_values_fields!=""){
								   var newval="";
								   for(var i=0;i<t.opt.item_values_fields.length;i++){
										  var val="";
										     if(t.opt.item_values_fields[i]=="src"){
												  val=t.ReturnSrc({small_src:json.small_src,myitem:myitem});
											 }else{
										     if(typeof(json[t.opt.item_values_fields[i]])!="undefined"){
											      val=json[t.opt.item_values_fields[i]];
											  }
											 }
									      if(newval!=""){newval+=t.result.fenge_child+val;}else{newval=val;}
								   }
								   if(iscx==1){
									   var arr=t.input.val().split(t.result.fenge);
									   var str="";
									   for(var j=0;j<arr.length;j++){
										   var val=arr[j];
										   if(val!=""){
											   if(val.indexOf(oldsmallsrc)!=-1){
												  val=newval;
											   }
										   }
										   if(str!=""){str+=t.result.fenge+val;}else{str=val;}
									   }
									    t.input.val(str);
								   }else{
									      var valstr=t.input.val();
								          if(valstr!=""){valstr+=t.result.fenge+newval; }else{valstr=newval;}
										  t.input.val(valstr);
								   }
							 }else{
								   var newval=t.ReturnSrc({small_src:json.small_src,myitem:myitem});
								   if(iscx==1){
									   var arr=t.input.value.split(t.result.fenge);
									   var str="";
									   for(var j=0;j<arr.length;j++){
										   var val=arr[j];
										   if(val!=""&&val.indexOf(oldsmallsrc)!=-1){
												  val=newval;
										   }
										   if(str!=""){str+=t.result.fenge+val;}else{str=val;}
									   }
									     t.input.val(str);
								   }else{
									      var valstr=t.input.val();
								          if(valstr!=""){valstr+=t.result.fenge+newval; }else{valstr=newval;}
										  t.input.val(valstr);
								   }
							 }
					}
					if(t.input_fengmian){
						      if(t.conf.maxnum==1){
							      t.input_fengmian.val(t.ReturnSrc({small_src:json.small_src,myitem:myitem}));
								  t.SetFengmianStyle({fileid:opt.fileid});
							  }else if(t.input_fengmian.val()==""){
								  t.input_fengmian.val(t.ReturnSrc({small_src:json.small_src,myitem:myitem}));
								 t.SetFengmianStyle({fileid:opt.fileid});
							  }
					}
					
	       },SetFengMianInput:function(opt){//设置封面值
					var t=this;
					var small_src=$("#"+opt.fileid).attr("data-small_src");
					if(t.input_fengmian){
						 t.input_fengmian.val(t.ReturnSrc(small_src));
					}
					t.SetFengmianStyle({fileid:opt.fileid});
		   },SetFengmianStyle:function(opt){
					 var obj=opt.obj;
					 var t=this;
					 var myitem=$("#"+opt.fileid);
					 t.panel.children().removeClass("fengmian_hover"); 
					 myitem.addClass("fengmian_hover");
			},myalert:function(text){
				if(typeof(layer)!="undefined"){
				    layer.msg(text);
				}else{
					 alert(text);
				}
			},deletefile:function(opt){
				var t=this;
				var newfiles=new Array();
				 for(var k in t.myfiles){
					 if(String(k)!=String(opt.fileid)){
					    newfiles[k]=t.myfiles[k]; 
					 }
				 }
				 t.myfiles=newfiles;
				 t.UpdateInput({fileid:opt.fileid});
				 if(typeof(t.opt.item_delete_url)!="undefined"){
					   var myitem=$("#"+opt.fileid);
					   if(myitem.length==0){
						    return false;
					   };
					  var attrs=myitem[0].attributes;
                     // console.log(myitem[0].attributes);
					  var data={act:"del"};
					  for(var k in attrs){
						  if(String(attrs[k].name).indexOf("data-")!=-1){
							 var arr=attrs[k].name.split("data-");
							 if(arr.length>1){
								 var k2=arr[1];
								 data[k2]=attrs[k].value;
							 }
						  }
					  };
			          $.ajax({
							url:t.opt.item_delete_url,
							type:"post",
							dataType:"html",
							data:data,
							success:function(res){
								if(typeof(t.delete_success)!="undefined"){
									 opt["result"]=res;
									 t.delete_success(opt);
								}
							}
					    });
				 }else{
					if(typeof(t.delete_success)!="undefined"){
						 t.delete_success(opt);
					}
				 }
			},getmorensrc:function(opt){//得到默认图标
				var t=this;
			    var imgurl="";
				var ext="";
                   ext=t.getfileext(opt);
				   imgurl=t.ico_path+ext+".png";
				return imgurl;
			},getfileext:function(opt){//获取文件后缀
			    var t=this;
                var ext="",arr;
				if(typeof(opt.file)!="undefined"){
				   arr=opt.file.name.split(".");
				   ext=arr[arr.length-1].toLowerCase();
				}
				if(typeof(opt.src)!="undefined"){
				   arr=opt.src.split(".");
				   ext=arr[arr.length-1].toLowerCase();
				}
				return ext;
			},getbaifenbi:function(data){//得到百分比
				        var t=this;
						var baifenbi_val=(data.size / data.file.size)*100;
						baifenbi_val=Math.round(baifenbi_val*Math.pow(10, 2))/Math.pow(10, 2);
						var arr=String(baifenbi_val).split(".");
						if(arr.length>1&&arr[1].length<2){baifenbi_val=baifenbi_val+"0";}
						return  baifenbi_val;
            },IsImg:function(str){
		          str=str.toLowerCase();
				  var arr=str.split(".");
				  var ext=arr[arr.length-1];
				  if(ext=="jpg"||ext=="jpeg"||ext=="gif"||ext=="png"||ext=="bmp"){
					   return true;
				  }else{
					   return false; 
				  }
		    },GetSmallImg:function(src){//得到小图路径
			  var small_src=src,t=this,arr2=src.split("."),ext=arr2[arr2.length-1];
			 if(t.conf.isnewsmall==1){
					if(t.IsImg(ext)){
						if(typeof(t.opt.conf)!="undefined"&&typeof(t.opt.conf.small_hz_name)!="undefined"&&t.opt.conf.small_hz_name!=""){
							small_src=src.replace("_"+t.opt.conf.small_hz_name+".",".");
							small_src=small_src.replace('.',"_"+t.opt.conf.small_hz_name+".");
						}else if(src.indexOf("/s80/")!=-1||src.indexOf("/s100/")!=-1){
							small_src=src.replace("/s80/","/s100/");
							small_src=src.replace("/s100/","/s50/");
						}
					}
			 }
			return small_src;
		  },GetBigImg:function(src){//得到大图路径
			var big_src=src,t=this,arr2=src.split("."),ext=arr2[arr2.length-1];
				if(t.conf.isnewsmall==1){
					if(t.IsImg(ext)){
						if(typeof(t.opt.conf)!="undefined"&&typeof(t.opt.conf.small_hz_name)!="undefined"&&t.opt.conf.small_hz_name!=""){
							big_src=src.replace("_"+t.opt.conf.small_hz_name+".",'.');
						}else if(src.indexOf("/s50/")!=-1||src.indexOf("/s80/")!=-1||src.indexOf("/s100/")!=-1){
							 big_src=big_src.replace("/s50/","/s100/");
							 big_src=big_src.replace("/s80/","/s100/");
						}else if(src.indexOf("/s/")!=-1||src.indexOf("/m/")!=-1){
							 big_src=big_src.replace("/s/","/b/");
							 big_src=big_src.replace("/s/","/b/");
						}else if(src.indexOf("_small")!=-1){
							 big_src=big_src.replace("_small","");
						}else {
							if(src.indexOf("."+ext+"."+ext+"."+ext)==-1&&src.indexOf("imgs")!=-1){
							   big_src=src+"."+ext+"."+ext;
							}
						}
					}
				}
			 return big_src;
			},start:function(){//开始上传文件
			   var t=this;
			    if(t.inputfile.length>0){t.inputfile[0].value="";}
				for(var k in t.myfiles){
						  var file=t.myfiles[k].file;
						  if(String(t.myfiles[k].status)=="0"){
								   if(file.type.indexOf("image")!=-1){
									   t.yasuo_file({fileid:k});
								   }else if(file.type.indexOf("video")!=-1){
									   t.myfiles[k].status=1;
								   }else{
									   t.myfiles[k].status=1;
								   } 
								  if(typeof(t.upload_before)!="undefined"){
									   t.upload_before({fileid:k});
								  }
						  }
				 };
				  window.clearInterval(t.timefp);
				  window.clearInterval(t.time1);
				  t.time1=window.setInterval(function(){
						   for(var k in t.myfiles){
							  if(String(t.myfiles[k].status)=="0"){
								  return false;
							  }
							};
							 var sendfp=function(maxnum){
                                     if(t.limit==0){
											 for(var k in t.myfiles){
											   if(String(t.myfiles[k].status)=="1"){
												t.upload({fileid:k,upload_url:t.upload_url});
											   } 
											 }
											 window.clearInterval(t.timefp); 
											 return false;
									 };
									 var dd_num=0;
									 var up_num=0;
									 for(var k in t.myfiles){
									   if(t.myfiles[k].status=="上传中"){
										   up_num++; 
									   };
									   if(String(t.myfiles[k].status)=="1"){
										   dd_num++; 
									   };
									 };
									 var ok_num=t.limit-up_num;
									 var n=0;
									 console.log("ok_num",ok_num);
									 if(ok_num>0){
											 for(var k in t.myfiles){
											  if(String(t.myfiles[k].status)=="1"){
												   if(n<ok_num){
													  t.upload({fileid:k,upload_url:t.upload_url});
												   }else{
													   break;
												   }
												   n++;
											   } 
											 };
									 }
									 if(dd_num==0){
										 
										console.log(t.myfiles);
										window.clearInterval(t.timefp);  
									 }
							 };
							 t.timefp=window.setInterval(function(){
                                     sendfp(t.limit);
							  },300);
							  sendfp(t.limit);
							window.clearInterval(t.time1);
				 },300);
			},yasuo_file:function(opt){
			                       var t=this;
								    var yasuo=t.yasuo;
									if(typeof(t.myfiles[opt.fileid])=="undefined"){
										return false;
									}
									if(yasuo.status==0){
									    t.myfiles[opt.fileid].status=1; 
									    return false;
									}
									var file=t.myfiles[opt.fileid].file;
									var convertBase64UrlToBlob=function(urlData){
										var arr=urlData.split(',')[1];
										var bytes=window.atob(urlData.split(',')[1]);        //去掉url的头，并转换为byte
										var arr = urlData.split(','), mime = arr[0].match(/:(.*?);/)[1];
										//处理异常,将ascii码小于0的转换为大于0
										//alert(mime);
										var ab = new ArrayBuffer(bytes.length);
										var ia = new Uint8Array(ab);
										for (var i = 0; i < bytes.length; i++) {
										ia[i] = bytes.charCodeAt(i);
										}
										return new Blob( [ab] , {type : mime});		
								   };
									 var reader = new FileReader();//读取客户端上的文件 
									 reader.readAsDataURL(file); 
									 reader.onload = function(){ 
										   var src = reader.result;
										   var img=new Image();
											   img.onload=function(){
													var w=img.width;
													var h=img.height;
													var bilv=w/h;
													var ys_width=0,ys_height=0;
													var  canvas = document.createElement("canvas");  
													ctx = canvas.getContext('2d');
													if(yasuo.type=="width"&&yasuo.value<w){
														  ys_width=yasuo.value;
														  ys_height=ys_width/bilv;
													}else if(yasuo.type=="height"&&yasuo.value<h){
														  ys_height=yasuo.value;
														  ys_width=ys_height*bilv;
													};
													if(ys_width>0){
														canvas.width=ys_width;
														canvas.height=ys_height;
														ctx.drawImage(img,0,0,canvas.width,canvas.height);
														var this_base64=canvas.toDataURL("image/jpeg",0.9);
														var oBlob=convertBase64UrlToBlob(this_base64);
														//console.log(file);
														oBlob["name"]=file.name;
														 for(var key in file){
														   if(key!="size"){
															 oBlob[key]=file[key];
														   }
														 }
														console.log(oBlob);
														t.myfiles[opt.fileid].file=oBlob;
														t.myfiles[opt.fileid].status=1; 
													}else{
														t.myfiles[opt.fileid].status=1; 
													}
											   };
										   img.src=src;
									 }
		 },UpdateInput:function(opt){//更新input值
				 var t=this;
				 //var myitem=t.GetParentItem(obj);
				 var myitem=document.getElementById(opt.fileid),small_src=myitem.getAttribute("data-small_src"),big_src=myitem.getAttribute("data-big_src");
				 if(typeof(t.myfiles[opt.fileid])!="undefined"){
					 var file=t.myfiles[opt.fileid].file;
					 if(typeof(hc_cookie)!="undefined"){hc_cookie.Del(file.name);}
				 }
				  var index=0,cur_index=0;
				  if(myitem){
					var items=myitem.parentNode.childNodes;
					for(var i=0;i<items.length;i++){
						 if(typeof(items[i].id)!="undefined"){
							   if(items[i].id==myitem.id){
								   cur_index=index;
								   break;
							   }
							   index++;
						 }
					}
				  }
				 var n=0;
				 if(t.input){
						  var big2=t.GetBigImg(small_src);
						  var arr=t.input.val().split(t.result.fenge);
						  var newvalue="";
						  for(var i=0;i<arr.length;i++){
							 // alert(t.GetBigImg(arr[i])+"="+t.GetBigImg(small_src));
							  var big1=t.GetBigImg(arr[i]);
							  var big2=t.GetBigImg(small_src);
							   if(i!=cur_index){
									 if(newvalue!=""){newvalue+=t.result.fenge+arr[i];}else{ newvalue=arr[i];}
									 n++;
							   }
						  }
						  if( t.input){
							 t.input.val(newvalue);
						  }
						   if(t.input_fengmian){
							 var big3=t.GetBigImg(t.input_fengmian.val());
							  if(big3==big2){
								t.input_fengmian.val("");
							  }
						   }
				 }
			},
			upload:function(opt){
							//var reader=new FileReader();
							var t=this;
                            var opt=opt;
							var fileid=opt.fileid;
							
							if(typeof(t.opt.upload_show)!="undefined"){
							  $("#"+fileid).children().hide();
							  $("#"+fileid).find(t.opt.upload_show).show();
							}
							var file=t.myfiles[fileid].file;//文件
							var title=file.name;//文件名
							var type=file.type;
							var cur_size=0;//当前大小
							var name = file.name;        //文件名
							var size = file.size;       //总大小
							var shardSize = t.fdsize//分片长度
							var shardCount = Math.ceil(size / shardSize);  //总片数
							t.myfiles[fileid].status="等待";
							if(typeof(t.upload_before)){
								t.upload_before({file:file,fileid:fileid}); 
							};
							var sendPost=function(op){
										if(op.i >= shardCount){
											//alert(shardCount);
											return;
										};
										t.myfiles[fileid].status="上传中";
										//计算每一片的起始与结束位置
										var start = op.i * shardSize,
										end = Math.min(size, start + shardSize);
										
										//构造一个表单，FormData是HTML5新增的
										t.myfiles[fileid].index=op.i;
										var index=op.i + 1;
										var form = new FormData();//这个html5浏览器才支持的
										var contentType=false;
										var processData=false;
										var blob;
										if(file.webkitSlice) {
											blob = file.webkitSlice(start, end);
										} else if(file.mozSlice) {
											blob = file.mozSlice(start,end);
										} else if(file.slice) {
											blob = file.slice(start,end);
										} else {
											alert('不支持分段读取！');
											return false;
										}
										var ext="";
										var arr=file.name.split(".");
										ext=arr[arr.length-1];
										ext=ext.toLowerCase();
										form.append("file", blob,file.name);  //slice方法用于切出文件的一部分
										form.append("title", file.name);//标题
										form.append("ext", ext);  //后缀名 
										form.append("fileid",fileid);//唯一标识
										form.append("act","up");
										form.append("total", shardCount);  //总片数
										form.append("index", index);        //当前是第几片
										form.append("isnewsmall", t.conf.isnewsmall);
										if(typeof(t.myfiles[opt.fileid].file1)!="undefined"&&shardCount==index){
										  form.append("file1", t.myfiles[fileid].file1,t.myfiles[fileid].file1.name);
										}
										if(typeof(opt.post)!="undefined"){
											 for(var k in opt.post){
												  form.append(k,opt.post[k]); 
											 }
										}
	
										cur_size=(index)*shardSize;
										if(cur_size>file.size){cur_size =file.size;}
										 //ajax提交后端进行保存
										$.ajax({
											url: t.upload_url,//提交给这个后端接口
											type: "POST",
											data: form,
											async: true,        //异步
											dataType: "html",
											processData: processData,  //很重要，告诉jquery不要对form进行处理
											contentType: contentType,  //很重要，指定为false才能形成正确的Content-Type
											success: function(result){//返回过来result字符串
													 //console.log(result);
													 var json1=eval("("+result+")");
													if(typeof(t.myfiles[opt.fileid])=="undefined"){
														return false;
													}
													if (result.indexOf("dengdai") != -1) {
														 var baifenbi=t.getbaifenbi({file:file,size:cur_size});
														 if(typeof(t.upload_progress)!="undefined"){
															 t.upload_progress({fileid:fileid,file:file,size:cur_size,baifenbi:baifenbi});
														 }
														 var i=op.i+1;
														 t.myfiles[fileid].status="上传中";
														 sendPost({i:i});
													}else if(result.indexOf("success")!=-1) {
														  
														  cur_size=file.size;
														  var baifenbi=t.getbaifenbi({file:file,size:cur_size});
														  if(typeof(t.upload_progress)!="undefined"){
															 t.upload_progress({fileid:fileid,file:file,size:cur_size,baifenbi:baifenbi});
														  }
														  if(typeof(t.upload_success)!="undefined"){
															 t.upload_success({fileid:fileid,file:file,size:cur_size,result:result});
														  }
														  t.myfiles[fileid]["status"]="成功";
														  
														  t.SetInput({fileid:fileid,file:file,result:result});
														  var myitem=$("#"+fileid);
														  for(var k in json1){
															  myitem.attr("data-"+k,json1[k]);  
														  }
			
															
															if(typeof(t.opt.success_show)!="undefined"){
															  $("#"+fileid).children().hide();
															  $("#"+fileid).find(t.opt.success_show).show();
															}
													}else if(result.indexOf("error")!=-1){
														  t.myfiles[fileid].status="错误";
														  if(typeof(t.upload_error)!="undefined"){
															 t.upload_error({fileid:fileid,file:file,size:cur_size,result:result});
														  }
															if(typeof(t.opt.error_show)!="undefined"){
															  $("#"+fileid).children().hide();
															  $("#"+fileid).find(t.opt.error_show).show();
															}
													}else{
														  t.myfiles[fileid].status="错误";
														  if(typeof(t.upload_error)!="undefined"){
															 t.upload_error({fileid:fileid,file:file,size:cur_size,result:result});
														  }
															if(typeof(t.opt.error_show)!="undefined"){
															  $("#"+fileid).children().hide();
															  $("#"+fileid).find(t.opt.error_show).show();
															}
													}
											},error:function(e){
														   t.myfiles[fileid].status="错误";
														   t.myfiles[fileid].msg=e.message;
														   if(typeof(t.upload_error)!="undefined"){
															  t.upload_error({fileid:fileid,file,size:cur_size,result:"{\"msg\":\""+e.message+"\"}"});
														   }
															if(typeof(t.opt.error_show)!="undefined"){
															  $("#"+fileid).children().hide();
															  $("#"+fileid).find(t.opt.error_show).show();
															}
											}
										});
							}
							sendPost({i:t.myfiles[opt.fileid].index});
		},load_before:function(data){
			var t=this;
		   // var file=this.myfiles[data.fileid].file;//文件
			//if(typeof(this.myfiles[data.fileid])!="undefined"){
			//}
			var newitem=$("<div class=\"myitem_small\" id=\""+data.fileid+"\"><div class=\"rel_img\"><img src=\""+data.src+"\"/></div><div class=\"rel_bg\"></div><div class=\"rel_size\"></div><div class=\"rel_date\"></div><div class=\"rel_name\">"+data.name+"</div><div class=\"rel_baifenbi\">0%</div><div class=\"rel_del\">删除</div><div class=\"rel_see\">查看</div><div class=\"rel_fengmian\">封面</div></div>");
			this.panel.append(newitem);
			
			if(typeof(t.opt.item_class)!="undefined"){
				   newitem.removeClass("myitem_small");
				   newitem.addClass(t.opt.item_class);
			}
			newitem.addClass("hcupitem");
		},upload_before:function(data){

		},upload_progress:function(data){
		    var t=this;
			var myitem=$("#"+data.fileid);
			myitem.find(".rel_baifenbi").html(""+data.baifenbi+"%");	
		},upload_success:function(data){
			var t=this;
			var json=eval("("+data.result+")");
			console.log(json);
			var myitem=$("#"+data.fileid);
			myitem.find(".rel_img img").attr("src",t.siteurl_file+json.filepath);
		},delete_before:function(data){
			//删除之前
		},delete_success:function(data){
			//删除成功
		   //alert("已删除");
	    },ReturnSrc:function(opt){
				var t=this,filename="",src="";
				if(typeof(opt)=="string"){
					src=opt;
				}else{
					src=opt.small_src;
					if(typeof(opt.small_src)!="undefined"){
						src=opt.small_src;
					}else if(typeof(opt.myitem)!="undefined"){
					   src=opt.myitem.attr("data-small_src");
					};
					if(typeof(opt.myitem)!="undefined"){
					    filename=opt.myitem.attr("data-title");
					}
				}
				var val=src,t=this,arr2=src.split("."),ext=arr2[arr2.length-1],path="";
				 if(t.conf.isnewsmall==1){
						if(t.IsImg(ext)){
							if(typeof(t.opt.conf)!="undefined"&&typeof(t.opt.conf.return_value)!="undefined"&&t.opt.conf.return_value=="大图"){
								if(typeof(t.opt.conf)!="undefined"&&typeof(t.opt.conf.small_hz_name)!="undefined"&&t.opt.conf.small_hz_name!=""){
									 val=val.replace("_"+t.opt.conf.small_hz_name+".",".");
								}else if(src.indexOf("/s50/")!=-1){ 
									 val=val.replace("/s50/","/s100/");
								}
							}
						}
			  }
			   if(t.result.isfull==1&&val.indexOf("http://")==-1){
					path=t.siteurl_file+val;
			   }else{
					path=val;
			   }
			   if(t.result.type=="html"){
					var obj_moban=null,moban_html="",obj_title=null;
					if(typeof(t.result.moban_id)!="undefined"){obj_moban=document.getElementById(t.result.moban_id);}
					if(typeof(t.result.title_id)!="undefined"){obj_title=document.getElementById(t.result.title_id);}
					if(obj_moban){
						moban_html=obj_moban.value;
					}else if(typeof(t.result.moban_html)!="undefined"){
						moban_html=t.result.moban_html;
					}
					if(obj_title){
						var title=filename;
						if(obj_title.value!=""){title=obj_title.value;}
						 return "<img src=\""+path+"\" alt=\""+title+"\"/>";
					}else if(moban_html!=""){
						  html=moban_html;
						  html=html.replace(/{src}/,path);
						  html=html.replace(/{path}/,path);
						  html=html.replace(/{alt}/,filename);
						  html=html.replace(/{title}/,filename);
						  html=html.replace(/{filename}/,filename);
						  return html;
					 }else{
					   return "<img src=\""+path+"\" alt=\""+filename+"\"/>";
					 }
			   }else{
					return path;
			   }
		},create_submit_iframe:function(opt){
			         var t=this;
					t.weizhi=$(t.opt.selectbt);
					 var url="";
					 var arr=t.opt.upload_url.split("/");
					 for(var i=0;i<(arr.length-1);i++){ //获取当前域名
	                   url+=arr[i]+"/";
                     }; 
					 var name="";
					 if(t.opt.upload_url.indexOf(".php")!=-1){
						   url+="uploadiframe.php";
					 }else if(t.opt.upload_url.indexOf(".asp")!=-1){
						   url+="uploadiframe.asp";
					 }else{
						   url+="uploadiframe.aspx"; 
					 };
	
					 var uploadiframe=url+"?inputid="+t.input_id+"&func=hcupfilehuidiao&issmall="+t.conf.isnewsmall;
					 if(typeof(t.opt.conf)!="undefined"&&typeof(t.opt.conf.small_hz_name)!="undefined"){
					     uploadiframe+="&small_hz_name="+t.opt.conf.small_hz_name;
					 };
					 t.weizhi.html("<iframe src='"+uploadiframe+"' style='width:100%;height:100%;' frameborder=0  allowtransparency='true' scrolling='no'></iframe>");
					 
		}
	};
	return hcupfile_;
};
function hcupfilehuidiao(opt){//给iframe网页回调用的
		 var t=window["hcupfile"+opt.inputid];
		 if(typeof(opt.small)=="undefined"){
			 return false;
		 }
		 var small_src=t.GetSmallImg(opt.small);
		 var big_src=small_src,arr2=small_src.split("."),ext=arr2[arr2.length-1];
		 t.showitem({paths:small_src});
       // t.Success({myitem:myitem,ext:ext,data:result});
	
}