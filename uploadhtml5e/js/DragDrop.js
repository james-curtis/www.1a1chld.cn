// JavaScript Document
/*
  2016-09-27到2018-06-12
  原创:惠聪网络
  原创QQ:632175205
  淘店a:http://91huicong.taobao.com/
  淘店b:https://congweb.taobao.com/
  不懂可以加我qq632175205,下午在线
  电话：13799835338，陈
*/;
function DragDrop(){
	 //整理来自：http://www.jq22.com/webqd2944
	 //http://www.vpsor.cn/product/vhost
           var DragDrop_={
			  init:function(opt){
				   var t=this;
				   var _this = this;
				   this.list=opt.list;
				   this.aPosXY = []; //原始位置
				   this.aPosXYClone = [];
				   this.moveStatus = false; //移动状态
				   this.editAble = false; //编辑状态
				   this.dashedBox = null;
				   this.moveItem = null;
				   this.moveItemH = null;
				   this.mouseDownPos = [];				
				   this.aPosXY = []; //原始位置
                   if(typeof(opt.success_huidiao)!="undefined"){
					    t.success_huidiao=opt.success_huidiao;
				   }	
					if(typeof(this.list.style.cssText)!="undefined"){
						this.list.setAttribute("old-style",this.list.style.cssText);
					}
				   this.input1=document.createElement("input");
				   this.input1.type="text";
			       if(typeof(this.list.id)=="undefined"){
					   this.list.id=this.newrand(7);
				   }
				   this.ismode=1;
				   this.isclearfloat=1;
				   if(typeof(opt.ismode)!="undefined"){
					    this.ismode=opt.ismode;
				   }
				   if(typeof(opt.isclearfloat)!="undefined"){
					    this.isclearfloat=opt.isclearfloat;
				   }
				   this.confbts=new Array();
				    this.omovefunc=function(event){
					   _this.mouseMove(event);
			       };
			       this.oupfunc=function(event){
					   _this.mouseUp(event);
			       };
			  },setBts:function(obj){
				this.confbts.push(obj);  
			  },mouseDown:function(e,obj){
				       var _this = this;
					    e=e||window.event;

 						//e.preventDefault();//阻止默认事件，取消文字选中 
//						//obj.setCapture&&obj.setCapture();//低版本IE阻止默认事件，取消文字选中  
						//console.log("mouseDown:",touches);
							var touches=[];
							var pageX=0,pageY=0;
							if(typeof(e.touches)!="undefined"&&e.touches.length>0&&e.touches[0].pageX!=0){//jq的
								   touches=e.touches;
							}else if(e.originalEvent){
								   touches=e.originalEvent.changedTouches; 
							}else if(e.changedTouches){
								   touches=e.changedTouches; 
							};
							if(touches&&touches.length>0){
								   pageX=touches[0].pageX; 
								   pageY=touches[0].pageY; 
							}else if(e.pageX){
							  pageX=e.pageX; 
							  pageY=e.pageY;   
							}else if(e.x){
							   pageX=e.x; 
							   pageY=e.y; 
							};
					   this.log("mouseDown:");
					   this.startxy={x:e.pageX,y:e.pageY};
					   this.movexy={x:e.pageX,y:e.pageY};
					   this.aPosXYClone=[];
					   this.aPosXY=[];
					   var zh=0;
					   var li_mtw=0;
                       var li_mbw=0;
					   var li_brw=0;
					   var li_blw=0;
					   var li_btw=0;
					   var li_bbw=0;
					   var li_mlw=0;
					   var li_mrw=0;
					   var li_ptw=0;
					   var li_pbw=0;
					   var li_plw=0;
					   var li_prw=0;
					   this.isonerow=true;
				       var offsetLeft=0;
                      var clearfloat1=document.getElementById("mylistclearfloat_"+this.list.id);
					  if(this.isclearfloat==1){
						   if(clearfloat1==null){
								   this.clearfloat=document.createElement("div");
								   this.clearfloat.style.cssText="height:0px;clear:both;width:100%;line-height:0px;";
								   this.clearfloat.className="clearfloat";
								   this.clearfloat.id="mylistclearfloat_"+this.list.id;
								   this.list.appendChild(this.clearfloat);
						   }else{
								  this.clearfloat=clearfloat1;
						   }
					  }

					  
					   
                       var listheight=this.list.offsetHeight;
					   var listwidth=this.list.offsetWidth;
					   this.curindex=null;
					     this.lis=_this.getchilds();
						// alert(this.lis.length);
					   this.vs=this.getStyleJson(this.lis[0]);
					   this.leftv=(this.vs.margin.left)+(this.vs.border.left);
					   this.topv=(this.vs.margin.top)+(this.vs.border.top);
					  // alert(Math.round(parseFloat(this.getStyleValue(this.lis[2],"border-left-width"))));
					   	for(var i=0;i<this.lis.length;i++){
							var li=this.lis[i];
							//alert(this.getStyleValue(li,"width"));
							
							if(typeof(li.style.cssText)!="undefined"){
							    li.setAttribute("old-style",li.style.cssText);
							}
							if(typeof(this.getStyleValue(li,"border-right-width"))!="undefined"){
								li_brw=parseFloat(this.getStyleValue(li,"border-right-width"));
							}
							if(typeof(this.getStyleValue(li,"border-left-width"))!="undefined"){
								li_blw=parseFloat(this.getStyleValue(li,"border-left-width"));
							}
							if(typeof(this.getStyleValue(li,"border-top-width"))!="undefined"){
								li_btw=parseFloat(this.getStyleValue(li,"border-top-width"));
							}
							if(typeof(this.getStyleValue(li,"border-bottom-width"))!="undefined"){
								li_bbw=parseFloat(this.getStyleValue(li,"border-bottom-width"));
							}
							if(typeof(this.getStyleValue(li,"margin-top"))!="undefined"){
							   li_mtw=parseFloat(this.getStyleValue(li,"margin-top"));
							   h+=li_mtw;
							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
							if(typeof(this.getStyleValue(li,"margin-left"))!="undefined"){
							   li_mlw=parseFloat(this.getStyleValue(li,"margin-left"));
							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
							if(typeof(this.getStyleValue(li,"margin-right"))!="undefined"){
							   li_mrw=parseFloat(this.getStyleValue(li,"margin-right"));

							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
							if(typeof(this.getStyleValue(li,"padding-top"))!="undefined"){
							   li_ptw=parseFloat(this.getStyleValue(li,"padding-top"));
							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
							if(typeof(this.getStyleValue(li,"padding-bottom"))!="undefined"){
							   li_pbw=parseFloat(this.getStyleValue(li,"padding-bottom"));
							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
							if(typeof(this.getStyleValue(li,"padding-left-width"))!="undefined"){
							   li_plw=parseFloat(this.getStyleValue(li,"padding-left-width"));
							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
							if(typeof(this.getStyleValue(li,"padding-right-width"))!="undefined"){
							   li_prw=parseFloat(this.getStyleValue(li,"padding-right-width"));
							   //this.log("marginTop",this.getStyleValue(li,"margin-top"));
							}
						    li.setAttribute('drop-index',i); 

						   var h=li.offsetHeight;
							 //t.log("offsetHeight",li.offsetHeight+"px");
							//this.log("marginTop"+(this.getStyleValue(li,"marginButtom")));

							if(typeof(this.getStyleValue(li,"margin-bottom"))!="undefined"){
								li_mbw=parseFloat(this.getStyleValue(li,"margin-bottom"));
								h+=li_mbw;

								//this.log("marginButtom",this.getStyleValue(li,"margin-bottom"));
							}
							if(typeof(this.getStyleValue(li,"border-bottom-width"))!="undefined"){
								h+=parseInt(this.getStyleValue(li,"border-bottom-width"));
								//t.log("borderBottom",this.getStyleValue(li,"border-bottom-width"));
							}
							if(typeof(this.getStyleValue(li,"border-top-width"))!="undefined"){
								h+=parseInt(this.getStyleValue(li,"border-top-width"));
								//t.log("borderTop",this.getStyleValue(li,"border-top-width"));
							}
							 zh+=h;
							 if(offsetLeft==0){
								 offsetLeft=this.lis[i].offsetLeft;
							 }
                             if(this.lis[i].offsetLeft!=offsetLeft&&this.isonerow){
								this.isonerow=false; 
							 }	
							 if(this.lis[i].offsetWidth+50<listwidth){
								  this.isonerow=false; 
							 }
                             offsetLeft=this.lis[i].offsetLeft;
							// this.log("offsetLeft",offsetLeft);
					   }
					   if(!this.isonerow){
					      zh=listheight;
					   }
					   if(listheight>0){
						   zh=listheight;
					   }
                  //this.log("isonerow",this.isonerow);
				        this.list.style.height = parseFloat(listheight)+"px";
					    this.list.style.position="relative";
					    var ite_w=0;
						var ite_h=0;
					   for (var i = 0; i < this.lis.length; i++) {
							this.log("height",this.lis[i].style.height);
						   var posXY = [];
						   if(this.getStyleValue(this.lis[i],"display")=="inline"){//兼容处理：当display为inline时offsetLeft获取到的就不是我们想要值
							  this.lis[i].style.display="block";
						   };
						   var posX = this.lis[i].offsetLeft; //获取当前元素相对父级元素的偏移量 x；
						   var posY = this.lis[i].offsetTop; //获取当前元素相对父级元素的偏移量 y；

						   posXY.id=this.lis[i].id;
						   posXY.index=i;
						   posY-=li_mtw;
						   posX-=li_mlw;
						   posXY.x = Math.round(posX);
						   posXY.y = Math.round(posY);
						   posXY.newx = posX;
						   posXY.newy = posY;	
						   posXY.offsetHeight =this.lis[i].offsetHeight;	
						   posXY.offsetWidth = this.lis[i].offsetWidth;	
						   posXY.obj=this.lis[i];
		
						   this.aPosXY.push(posXY);
						   this.lis[i].setAttribute("data-x",posX);
						   this.lis[i].setAttribute("data-y",posY);
						   this.removeClass(this.lis[i], 'edit-able');
					   };
					   
					   if(typeof(this.confbts)!="undefined"){
						   this.btsPosXY=[];
						   for (var i = 0; i < this.confbts.length; i++) {
							   var posXY = [];
							   if(typeof(this.confbts[i].style.cssText)!="undefined"&&typeof(this.confbts[i].getAttribute("old-style"))=="undefined"){
							      li.setAttribute("old-style",this.confbts[i].style.cssText);
							   }
							   if(this.getStyleValue(this.confbts[i],"display")=="inline"){//兼容处理：当display为inline时offsetLeft获取到的就不是我们想要值
								  this.confbts[i].style.display="block";
							   };
							   var posX = this.confbts[i].offsetLeft; //获取当前元素相对父级元素的偏移量 x；
							   var posY = this.confbts[i].offsetTop; //获取当前元素相对父级元素的偏移量 y；
							   posXY.id=this.confbts[i].id;
							   posXY.index=i;
							   posY-=li_mtw;
							   posX=posX-li_mlw;
							   posXY.x = Math.round(posX);
							   posXY.y = Math.round(posY);
							   posXY.newx = posX;
							   posXY.newy = posY;	
							   posXY.offsetHeight = this.confbts[i].offsetHeight;	
							   posXY.offsetWidth = this.confbts[i].offsetWidth;	
							   posXY.obj=this.confbts[i];
							   this.btsPosXY.push(posXY);
							   this.confbts[i].setAttribute("data-x",posX);
							   this.confbts[i].setAttribute("data-y",posY);
						   };
						   for (var i in this.btsPosXY) {
								   this.setCss(this.confbts[i], {
									   'position': 'absolute',
									   'left': this.confbts[i].x+"px",
									   'top': this.confbts[i].y+"px",
										'width': Math.round((this.confbts[i].offsetWidth-li_btw*2))+"px",
										'height': Math.round(this.confbts[i].offsetHeight-li_btw-li_bbw-li_pbw)+"px",
										'float': "none"
								   })
						   }
					   };
					
					   for (var i in this.aPosXY) {
						   if(this.isonerow){
							   this.setCss(this.lis[i], {
								   'position': 'absolute',
								   'left': this.aPosXY[i].x+"px",
								   'top': this.aPosXY[i].y+"px",
									'width':  Math.round(this.lis[i].offsetWidth)+"px",
									'height':  Math.round(this.lis[i].offsetHeight-li_mtw-li_pbw)+"px",
									'float': "none"
							   })
						   }else{
			                // alert(Math.round(this.aPosXY[i].offsetWidth-li_blw-li_brw-li_plw-li_prw));
							   this.setCss(this.lis[i], {
								   'position': 'absolute',
								   'left': this.aPosXY[i].x+"px",
								   'top': this.aPosXY[i].y+"px",
									'width': Math.round(this.aPosXY[i].offsetWidth-li_blw-li_brw-li_plw-li_prw)+"px",
									'height': Math.round(this.aPosXY[i].offsetHeight-li_btw-li_bbw-li_pbw)+"px",
									'float': "none"
							   })
						   }
					   }
					  
					   var vs=this.getStyleJson(this.lis[0]);
					   this.thisIndex = obj.getAttribute('drop-index'); //获取当前序号，
					   this.dashedBox = document.createElement('div'); //创建新元素
					   
					   var tWidth = (obj.offsetWidth-li_blw-li_brw) + 'px'; //获取当前点击元素宽
					   var tHeight = (obj.offsetHeight-li_btw-li_bbw) + 'px'; //设置新元素高等于当前点击元素高
					   this.dashedBox.className = 'dashed-box'; //为新元素增加类名
                       // this.log("offsetHeight",this.lis[i].offsetHeight);
		
					   this.setCss(this.dashedBox, {
						   'position': 'absolute',
						   'width': tWidth,
						   'height': tHeight,
						   'left': parseInt(this.aPosXY[this.thisIndex].x)+_this.leftv+"px",
						   'top': parseInt(this.aPosXY[this.thisIndex].y)+_this.topv+"px",
						   'border':"solid 1px #f5f2f2"
					   });
					  this.list.appendChild(this.dashedBox);
					   //this.log(tWidth+'  '+tHeight);
					   //this.log(this.thisIndex);
					   this.moveStatus = true; //开启可移动状态
					   this.moveItem = obj; //当前移动的元素
					   this.mouseDownPos.x = pageX - this.list.offsetLeft;
					   this.mouseDownPos.y = pageY - this.list.offsetTop;
					  // this.log("this.mouseDownPos.x:"+this.mouseDownPos.x);
					   // this.log("this.list.offsetLeft:"+this.list.offsetLeft);
					   obj.style.zIndex = 100;
					  // this.addClass(obj, 'move-item');
					   this.moveItemH = obj.offsetHeight;
					   //this.aPosXYClone.splice(0, this.aPosXYClone.length);
					   this.aPosXYClone=new Array();
					   for (var i = 0; i < this.aPosXY.length; i++) { //复制数组
					      
						   this.aPosXYClone.push(this.aPosXY[i]);
					   }
					  // this.removeClass(obj, 'edit-able');
					   this.obj=obj;//当前对象
					   this.isbool=true;
					   this.obj.style.zIndex=30000;
					   this.y=0;
//					   this.addEvent(_this.list,"mousemove",function(event){_this.mouseMove(event, _this.moveItem);});
//					   this.addEvent(_this.list,"mouseup",function(event){_this.mouseUp(event, _this.moveItem);});
//					//   document.ontouchmove=function(e){
//					//	   omovefunc(e);
//					 //  }
//					  // document.ontouchstart=function(e){
//					//	 e.preventDefault();//阻止默认事件，取消文字选中  
//					 //  }
//					   this.addEvent(_this.list,"touchmove",function(event){_this.mouseMove(event, _this.moveItem);});
//					   this.addEvent(_this.list,"touchend",function(event){ event.preventDefault();_this.mouseUp(event, _this.moveItem);});

                       if(this.ismode==1){
					   this.addEvent(window,"mousemove",_this.omovefunc);
					   this.addEvent(window,"touchmove",_this.omovefunc);
					   this.addEvent(window,"mouseup",_this.oupfunc);
					   this.addEvent(window,"touchend",_this.oupfunc);
					   }
//onselectstart="return false;" style="-moz-user-select:none;"
					   //e.preventDefault();//阻止默认事件，取消文字选中  
					   //t.log(this.mouseDownPos); 
				
			 
			  },getStyleValue:function(obj,key){  //获取最终的样式值
					 if (obj.style[key]){
						 return obj.style[key];  
					 }else if(obj.currentStyle){ 
					
						  return obj.currentStyle[key]; 
					 }else{
						 //ff:它使用传统的"text-Align"风格的规则书写方式，而不是"textAlign" 
						 key = key.replace(/([A-Z])/g,"-$1"); 
                         key = key.toLowerCase(); 
						return document.defaultView.getComputedStyle(obj,null)[key]; //
					  } 
			  },mouseMove:function(e){//鼠标按下
			          var _this=this;
					   this.log("mouseMove:");
					  // this.input1.select();
					   if (!this.moveStatus) {
                                 _this.Reset();
								return false;
					   };
                        var obj=this.moveItem;
					    e=e||window.event;
							var touches=[];
							var pageX=0,pageY=0;
							if(typeof(e.touches)!="undefined"&&e.touches.length>0&&e.touches[0].pageX!=0){//jq的
								   touches=e.touches;
							}else if(e.originalEvent){
								   touches=e.originalEvent.changedTouches; 
							}else if(e.changedTouches){
								   touches=e.changedTouches; 
							}
							if(touches&&touches.length>0){
								   pageX=touches[0].pageX; 
								   pageY=touches[0].pageY; 
							}else if(e.pageX){
							  pageX=e.pageX; 
							  pageY=e.pageY;   
							}else if(e.x){
							   pageX=e.x; 
							   pageY=e.y; 
							};
						//this.log("length:"+this.lis.length);
					   this.movexy={x:pageX,y:pageY};
					   if(this.movexy.x==this.startxy.x&&this.movexy.y==this.startxy.y){
						  //  console.log("startxy",this.startxy);
						   // console.log("movexy",this.movexy);
	
					   }else{
					       this.y++;
					   };
					  var _this=this;
                    
					   var relativeListX = pageX - this.list.offsetLeft; //鼠标相对ul的位置 x
					   var relativeListY = pageY - this.list.offsetTop; //鼠标相对ul的位置 y
					   var objIndex = parseInt(obj.getAttribute('drop-index')); //获取当前选中元素的下标
					   var objLeft =parseInt(obj.getAttribute("data-x"));//相对于父元素内的x坐标
					   var objTop = parseInt(obj.getAttribute("data-y"));//根据下标获取当前选中元素相对于父元素内的定位 x,y;
					   //      t.log('objLeft：'+objLeft+'  objTop：'+objTop); //  objLeft：10px  objTop：10px
					   var relativeObjX = this.mouseDownPos.x-objLeft; //鼠标按下时鼠标相对于选中元素的位置x
					   var relativeObjY = this.mouseDownPos.y-objTop; //鼠标按下时鼠标相对于选中元素的位置y
					   this.objIndex=objIndex;
					   var objMoveX = relativeListX - relativeObjX; //扣掉两点共同有的长度，从而得到相对于父元素内的定位 x,y
					   var objMoveY = relativeListY - relativeObjY;

					   this.setCss(obj, {
						   'left': objMoveX + 'px',
						   'top': objMoveY + 'px'
					   });
					  
//					   if(this.isbool==false){
//						   return false;
//					   };

					  // console.log(leftv);
					   for (var i = 0; i < this.aPosXYClone.length; i++) {
					
							var cli=this.lis[i];
						  // if (i!= objIndex) {
							  // t.log(i);
								  var c={
									   min_y:parseInt(this.aPosXYClone[i].y),
									   max_y:parseInt(this.aPosXYClone[i].y)+cli.offsetHeight/2,
									   min_x:parseInt(this.aPosXYClone[i].x),
									   max_x:parseInt(this.aPosXYClone[i].x)+cli.offsetWidth/2,
									   left:this.aPosXYClone[i].x,
									   offsetWidth:cli.offsetWidth,
									   x:objMoveX,
									   y:objMoveY
								    };
									var isbool=false;
								this.isonerow=false;
							  if(this.isonerow){
							      if (objMoveY + obj.offsetHeight >= c.max_y && objMoveY + obj.offsetHeight < parseInt(this.aPosXYClone[i].y) + cli.offsetHeight || objMoveY >= parseInt(this.aPosXYClone[i].y) && objMoveY < c.y) {
								   //            t.log(i);
                                        isbool=true;
							       }
							  }else if(objMoveX>c.min_x&&objMoveX<c.max_x&&objMoveY >= c.min_y&& objMoveY<c.max_y ){
								     isbool=true;
							  };
							  
								  if(isbool){
									       this.y++;
										   var ts = [];
										   ts.x = this.dashedBox.style.left;
										   ts.y = this.dashedBox.style.top;
										   var curXY={};
										   var old=this.aPosXYClone[objIndex];
										   var oldi=this.aPosXYClone[i];
										  // obj.setAttribute("drop-index",i);
										   //this.aPosXYClone[objIndex]= this.aPosXYClone[i];

//										   this.aPosXYClone[i].x= ts.x;
//										   this.aPosXYClone[i].y= ts.y;
				                           // var li=document.getElementById(posxy.id);
										   for(var k in this.aPosXYClone[i]){
											  curXY[k]=this.aPosXYClone[i][k];
										   }
										   var yuanXY={};
										   for(var k in this.aPosXYClone[objIndex]){
											   yuanXY[k]=this.aPosXYClone[objIndex][k];
										   }
										   this.setCss(this.dashedBox, {
											   'left': parseInt(this.aPosXYClone[i].x+_this.leftv)+"px",
											   'top': parseInt(this.aPosXYClone[i].y+_this.topv)+"px"
										   });
										   var newArr=new Array();
										   var objArr=new Array();
										   var index=0;
										   var startindex=0;
										   // console.log(i+"[=]"+objIndex);
										   var newArr2=new Array();
										   var objArr2=new Array();
										   if(i<objIndex){
											   //console.log("min");
											   startindex=i;
											   for(var j=0;j<i;j++){//新值数组
													   newArr.push(this.aPosXYClone[j]);
											   }
											   for(var j=0;j<i;j++){//新值数组对应的对象
													if(j!=objIndex){
															 objArr.push(this.aPosXYClone[j]);
															 index++;
													 }
											   }
											   
											   for(var j=i+1;j<this.aPosXYClone.length;j++){//新值数组
													   newArr2.push(this.aPosXYClone[j]);
											   }
											   
											   for(var j=i;j<this.aPosXYClone.length;j++){//新值数组对应的对象
													if(j!=objIndex){
															 objArr2.push(this.aPosXYClone[j]);
															 index++;
													 }
											   }
										   }else{
											   //console.log("max");
											    startindex=(objIndex+1);
											   for(var j=0;j<i;j++){//新值数组
													   newArr.push(this.aPosXYClone[j]);
											   }
											   for(var j=0;j<=i;j++){//新值数组对应的对象
													if(j!=objIndex){
															 objArr.push(this.aPosXYClone[j]);
													 }
											   }
											   for(var j=i+1;j<this.aPosXYClone.length;j++){//新值数组
													   newArr2.push(this.aPosXYClone[j]);
											   }
											   
											   for(var j=i+1;j<this.aPosXYClone.length;j++){//新值数组对应的对象
													if(j!=objIndex){
															 objArr2.push(this.aPosXYClone[j]);
													 }
											   }
										   }
						
										    for(var key in objArr){//对前面元素重新布局
                                                   var li=objArr[key].obj;
												   var newxy=newArr[key];
												   this.setCss(li, {'left':newxy.x+"px",'top': newxy.y+"px"});
											};
										    console.log(objArr.length+"="+objArr2.length);
											
										    for(var key in objArr2){//对后面元素重新布局
                                                   var li=objArr2[key].obj;
												   var newxy=newArr2[key];
												   this.setCss(li, {'left':newxy.x+"px",'top': newxy.y+"px"});
												    console.log("className="+li.className);
											};
											this.curindex=i;
											return false;
							  }
						  // }
					   }
					  
             },mouseUp:function(e,obj) {//鼠标弹起

			   //this.lis=this.getchilds();
			   var _this=this;
			   e=e||window.event;
							var touches=[];
							var pageX=0,pageY=0;

							if(typeof(e.touches)!="undefined"&&e.touches.length>0&&e.touches[0].pageX!=0){//jq的
								   touches=e.touches;
							}else if(e.originalEvent){
								   touches=e.originalEvent.changedTouches; 
							}else if(e.changedTouches){
								   touches=e.changedTouches; 
							}
							
							if(touches&&touches.length>0){
								   pageX=touches[0].pageX; 
								   pageY=touches[0].pageY; 
							}else if(e.pageX){
							  pageX=e.pageX; 
							  pageY=e.pageY;   
							}else if(e.x){
							   pageX=e.x; 
							   pageY=e.y; 
							};
			   // this.input1.select();
               this.log("mouseUp:");
				//return false;
				//  e.preventDefault();//阻止默认事件，取消文字选中	  

              if(this.ismode){
				  this.removeEvent(window,"mouseup",_this.oupfunc);
				  this.removeEvent(window,"touchend",_this.oupfunc);
				  this.removeEvent(window,"mousemove",_this.omovefunc);
				  this.removeEvent(window,"touchmove",_this.omovefunc);

			  }

             
			  
			   _this.moveItem=null;
			   if(!_this.moveStatus){
				   _this.Reset();
				   return false;
			   } ;

			   _this.moveStatus=false;

			    _this.upxy={x:pageX,y:pageY};
			   
			   if(_this.movexy.x==_this.startxy.x&&_this.movexy.y==_this.startxy.y){
					//_this.Reset();
					//this.moveStatus=false;
					//this.curindex=null;
					//return false;
			   };
			  
               
				
			  
			   if(_this.curindex!=null&&_this.objIndex!=_this.curindex){

							var newxy=_this.aPosXYClone[_this.curindex];
						    _this.setCss(_this.obj, {'left':newxy.x,'top': newxy.y});
							 if(_this.objIndex<_this.curindex){
								 if((_this.curindex+1)<_this.lis.length){
							        _this.li1=this.lis[_this.curindex+1];
						            _this.list.insertBefore(_this.obj,_this.li1);
							     } else{
									_this.list.appendChild(_this.obj); 
								 }
							 }else{
								_this.li1=_this.lis[_this.curindex];
								_this.list.insertBefore(_this.obj,_this.li1);
							 }
			   }else{
				   
//							 for (var i = 0; i < this.aPosXY.length; i++) {
//								   this.setCss(this.lis[i], {'left':this.aPosXY[i].x,'top':this.aPosXY[i].y});
//							 }
			   };
			   
				_this.curindex=null;

                    
						//this.list.style.height ="";
                         _this.Reset();
						_this.moveStatus=false;
						if(typeof(_this.success_huidiao)!="undefined"){
							_this.success_huidiao();
						}
						
					    _this.moveItem = null;

					   if(_this.dashedBox){
					    _this.list.removeChild(_this.dashedBox);
					   }
					   _this.dashedBox=null;

			  
			 },Reset:function(){
				     var _this=this;
					   if(this.dashedBox){
					      this.list.removeChild(this.dashedBox);
						   this.dashedBox=null;
					   };
					  
					    this.lis=this.getchilds();
						for (var i =0; i < this.confbts.length; i++) {
								this.setCss(this.confbts[i],{position:"",left:"",top:"",width:"",float:"",display:""});
								if(typeof(this.confbts[i].getAttribute("old-style"))!="undefined"){
								   this.confbts[i].style.cssText=this.confbts[i].getAttribute("old-style");
								}
						};

						for (var i =0; i < this.lis.length; i++) {
							this.setCss(this.lis[i],{position:"",left:"",top:"",width:"",float:"",display:""});
							if(typeof(this.lis[i].getAttribute("old-style"))!="undefined"){
							   this.lis[i].style.cssText=this.lis[i].getAttribute("old-style");
							}
						};
						
						this.list.style.float = "";
						if(typeof(this.list.getAttribute("old-style"))!="undefined"){
							this.list.style.cssText=this.list.getAttribute("old-style");
						};
				
						this.moveStatus=false;

						
					    this.moveItem = null;
					   if(this.clearfloat){
						    this.list.appendChild(this.clearfloat); 
					   };
					   if(_this.dashedBox){
					    _this.list.removeChild(_this.dashedBox);
					   }
					   _this.dashedBox=null;
					   
			  },setCss:function(obj,cssList){//设置样式
			           if(obj){
						   for(var attr in cssList) {
							 obj.style[attr] = cssList[attr];
						   }
					   }
			  },addClass:function(obj, _classname) { //增加类名
				   var classNames = obj.className; //获取当前按钮的class,返回的是字符串
				   var tf = classNames.search(_classname)>= 0 ? true : false; //查找匹配的类名位置，如果返回-1说明没有这个类名， classNames.search(_classname)>=0 == false
				   if (!tf) {
					    classNames = classNames + ' ' + _classname;
					    obj.className = classNames;
				   }
				   
				   
             },removeClass:function(obj, _classname) {//删除类名
			    if(typeof(obj.className)=="undefined"){
				 return false;
			    };
			    var classNames = obj.className.split(' ');
				var newclass="";
				for(var i=0;i<classNames.length;i++){
					if(classNames[i]!=_classname){
						if(newclass!=""){
							newclass+=" "+classNames[i];
						}else{
							newclass=classNames[i];
						}							
					}
				};
			    obj.className = newclass;

			 },getchilds:function(){//获取所有项
					 var t=this;
					 var childs=new Array();
					 for(var j=0;j<t.list.childNodes.length;j++){
						  if(t.list.childNodes[j]&&t.list.childNodes[j].getAttribute){
							var myparent=t.list.childNodes[j].getAttribute("myparent");
							var dragdrop=t.list.childNodes[j].getAttribute("dragdrop");
							if(typeof(myparent)!="undefined"&&myparent){
								 childs.push(t.list.childNodes[j]); 
							}else if(typeof(dragdrop)!="undefined"&&dragdrop){
								 childs.push(t.list.childNodes[j]); 
							}
							
						  }
					 };
					 return childs;
	          },log:function(s1,s2){
				  if(typeof(s2)=="undefined"){
					   console.log(s1);
				  }else{
					   console.log(s1,s2);
				  }
			  },offset:function(obj) {
							  var data = {
								top: 0,
								left: 0
							  };
							  // 递归获取 offset, 可以考虑使用 getBoundingClientRect
							  function getOffset(node, init) {
								// 非Element 终止递归
								if (node.nodeType !== 1) {
								  return;
								};
								_position = window.getComputedStyle(node)['position'];
							 
								// position=static: 继续递归父节点
								if (typeof(init) === 'undefined' && _position === 'static') {
								  getOffset(node.parentNode);
								  return;
								};
								data.top = node.offsetTop + data.top - node.scrollTop;
								data.left = node.offsetLeft + data.left - node.scrollLeft;
							 
								// position = fixed: 获取值后退出递归
								if (_position === 'fixed') {
								  return;
								};
								getOffset(node.parentNode);
							  };
							  var _position;
							  getOffset(obj, true);
							  return data;
			  },addEvent:function(obj,type,fn) {//添加事件
					  if (obj.addEventListener)
						  obj.addEventListener(type,fn,false);
					  else if (obj.attachEvent) {
						  obj["e"+type+fn] = fn;
						  obj.attachEvent( "on"+type, function(e) {
							   obj["e"+type+fn].call(obj,window.event);
						  } );
					  }
			  },removeEvent:function( obj, type, fn ) {//移除事件
						  if (obj.removeEventListener){
							  obj.removeEventListener(type,fn,false);
						  }else if (obj.detachEvent) {
							  obj.detachEvent("on" +type, obj["e"+type+fn] );
							  obj["e"+type+fn] = null;
						  }
			 },getStyleJson:function(obj){
						 var t=this;
						  var width=parseInt(obj.offsetWidth);
						  var height=parseInt(obj.offsetHeight);
						  var bilv=width/height;
						  var margin={left:parseInt(t.getStyleValue(obj,"margin-left")),right:parseInt(t.getStyleValue(obj,"margin-right")),top:parseInt(t.getStyleValue(obj,"margin-top")),bottom:parseInt(t.getStyleValue(obj,"margin-bottom"))};
						  var padding={left:parseInt(t.getStyleValue(obj,"padding-left")),right:parseInt(t.getStyleValue(obj,"padding-right")),top:parseInt(t.getStyleValue(obj,"padding-top")),bottom:parseInt(t.getStyleValue(obj,"padding-bottom"))};
						  var border={left:parseInt(t.getStyleValue(obj,"border-left-width")),right:parseInt(t.getStyleValue(obj,"border-right-width")),top:parseInt(t.getStyleValue(obj,"border-top-width")),bottom:parseInt(t.getStyleValue(obj,"border-bottom-width"))};
						  return {bilv:bilv,margin:margin,padding:padding,border:border,width:width,height:height};
			  
			 },getStyleValue:function(obj,key){  //获取最终的样式值
					 if (obj.style[key]){
						  return obj.style[key];  
					 }else if(obj.currentStyle){ 
						  return obj.currentStyle[key]; 
					 }else{
						 //ff:它使用传统的"text-Align"风格的规则书写方式，而不是"textAlign" 
						 key = key.replace(/([A-Z])/g,"-$1"); 
						 key = key.toLowerCase(); 
						return document.defaultView.getComputedStyle(obj,null)[key]; //
					  } 
	         },newrand:function(n){//产生N位随机数
					var rnd="";
					for(var i=0;i<n;i++){
					   rnd+=Math.floor(Math.random()*10);
					};
					return rnd;
			  }
		    };
		  return DragDrop_;
 };