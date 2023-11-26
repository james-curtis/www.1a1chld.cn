<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"/www/wwwroot/ppds5di18.ink/application/daili/view/siyou/fabushipin.html";i:1558456982;s:68:"/www/wwwroot/ppds5di18.ink/application/daili/view/public/header.html";i:1551521020;s:68:"/www/wwwroot/ppds5di18.ink/application/daili/view/public/footer.html";i:1536907466;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?>代理中心</title>
    <link href="/static/admin/css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="/static/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/static/admin/css/animate.min.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/chosen/chosen.css" rel="stylesheet">
    <link href="/static/admin/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="/static/admin/css/style.min.css?v=4.1.0" rel="stylesheet">
    <link href="/static/admin/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <style type="text/css">
    .long-tr th{
        text-align: center
    }
    .long-td td{
        text-align: center
    }
    </style>
<script src="/uploadhtml5e/js/hcfile.config-0.3.js?12"></script>
<script src="/uploadhtml5e/js/hcfile-0.3-min.js?37"></script>

<script src="/uploadhtml5e/js/exif.js?19"></script>
<link href="/uploadhtml5e/js/hcfile03.css?3" rel="stylesheet" type="text/css">
</head>
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/webuploader.css">
<link rel="stylesheet" type="text/css" href="/static/admin/webupload/style.css">
<link href="/static/admin/css/layui.css" rel="stylesheet">
<style>
.file-item{float: left; position: relative; width: 110px;height: 110px; margin: 0 20px 20px 0; padding: 4px;}
.file-item .info{overflow: hidden;}
.uploader-list{width: 100%; overflow: hidden;}
</style>
<body class="gray-bg">
<div class="<?php if($ismobile==0): ?>wrapper wrapper-content<?php endif; ?> animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>发布视频</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="form_basic.html#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal m-t" name="add" id="add" method="post" action="fabushipin">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频名称：</label>
                            <div class="input-group col-sm-4">
                                <input id="name" type="text" class="form-control" name="name" placeholder="输入视频名称">
                            </div>
                        </div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频分类：</label>
                            <div class="input-group col-sm-4">
                              <select class="form-control" name="type">
                                <?php foreach($type as $key=>$vo): ?>
  <option value ="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                                <?php endforeach; ?>
</select>
                            </div>
                        </div>
                      
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频文件：</label>
                            <div class="input-group col-sm-4">
                                <input id="url" type="hidden" class="form-control" name="url" placeholder="输入视频外链地址">
								<span class="help-block m-b-none">最大可以上传200M的视频文件</span>
								<div style="display:none;">
								 <div id="fileList" class="uploader-list" style="float:right"></div>
                                <div id="imgPicker" style="float:left">选择文件</div>
								</div>
								
	                <div id="url_weizhi" style=" text-align:center; background-color:#3399FF; height:40px; width:100px; border-radius:3px;   cursor: pointer; color:#fff; line-height:40px; text-align:center; float:left; margin-right:10px;">上传视频</div>
	                <div id="url_panel" style="height:auto; width:auto; float:left; overflow:hidden;"></div>

	<script>
	 var conf={
	     uploadsite:"/",
	     newnamepath:"<?php echo $newnamepath; ?>"
	 };
	 
	</script> 
	 <script>
		  hcfile().Init({
				  url:conf.uploadsite+"uploadhtml5e/include/php/ajax.php?act=up",
				  siteurl:conf.uploadsite,
				  
				  maxnum:1,//只能上传N张
				  type:"all",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
				  input_id:"url",//存多张图片路径的input的id
				  weizhi_id:"url_weizhi",//选择按钮位置对像id
				  panel_id:"url_panel",//图片文件显示对象id
				  input_fengmian_id:'',//存封面的图片路径input对象id
				
				  isnewsmall:0,//1为生成小图
				  img_fdsize:1024*1024*2,//每段图片的大小，最好不要超过1M
				  ischongxuan:0,//1显示重选按钮
				  fenge:"#",
				  isfull:1,//返回完整的地址
				  isdelfile:1,
				  exts:"3gp,mp4,rmvb,mov,avi,m4v,m3u8",
				  drop_to_id:"drop_div",//托入有效区域对象id,如填写成document则将整个网页做为有效区域
				  send_id:"send",//确定上传按钮位置对像id,不填写或填写auto则自动上传
				  item_class:"myitem_smallb", //样式 可以不填写，不填写为显示图片
				  select_num_id:"select_num", //可以不填写，显示当前要上传的文件个数的对象id
				  success_num_id:"success_num", //可以不填写，显示当前要已上传的文件总个数的对象id
				  max_num_id:"max_num", //可以不填写，显示允许上传的个数
				  down_url:conf.uploadsite+"uploadhtml5e/include/php/down.php",//可以不填写，下载的
				  bt_del_text:"删除",
				  init_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:0,bg:0,img:1},
				  upload_show:{date:0,size:1,name:0,bar:1,baifenbi:1,del:0,bg:0,img:0},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条) del(删除按钮)
				  success_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:1,bg:0,see:1,img:1},//上传完后要显示的元素,1:显示,0不显
				  start_before:function(op){
				      var t=this;
					 if(typeof( t.opt.post)=="undefined"){
					   t.opt.post={};
					  }
					  t.opt.post["newnamepath"]=conf.newnamepath;
					  return true;
				  },
				  success:function(op){
				      var obj=document.getElementById(this.input_id+"_num");
					  if(obj){
					     obj.innerHTML=""+op.num+"/"+op.maxnum;
					  }
				  },del_huidiao:function(op){
				       var obj=document.getElementById(this.input_id+"_num");
					   if(obj){
					      obj.innerHTML=""+op.num+"/"+op.maxnum;
					  }
				  }
		 });
	 </script>

                            </div>
                        </div>
                       
                        
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">视频图片：</label>
                            <div class="input-group col-sm-4">
                                <input id="photo" type="text" class="form-control" name="photo" placeholder="输入视频图片地址">
								<div style="display:none;">
                                <div id="fileList2" class="uploader-list" style="float:right"></div>
                                <div id="imgPicker2" style="float:left">选择图片</div> 
								</div>
								    <div id="photo_weizhi" style=" text-align:center; background-color:#3399FF; height:40px; width:100px; border-radius:3px;   cursor: pointer; color:#fff; line-height:40px; text-align:center; float:left; margin-right:10px;">上传图片</div>
	                                <div id="photo_panel" style="height:auto; width:auto; float:left; overflow:hidden;"></div>
                            </div>
	 <script>
	
		  hcfile().Init({
				  url:conf.uploadsite+"uploadhtml5e/include/php/ajax.php?act=up",
				  siteurl:conf.uploadsite,
				  
				  maxnum:1,//只能上传N张
				  type:"all",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
				  input_id:"photo",//存多张图片路径的input的id
				  weizhi_id:"photo_weizhi",//选择按钮位置对像id
				  panel_id:"photo_panel",//图片文件显示对象id
				  input_fengmian_id:'',//存封面的图片路径input对象id
				  height:40,
				  isnewsmall:0,//1为生成小图
				  img_fdsize:1024*200,//每段图片的大小，最好不要超过1M
				  ischongxuan:0,//1显示重选按钮
				  fenge:"#",
				  isfull:1,//返回完整的地址
				   isdelfile:1,
				  exts:"jpg,png,gif,jpeg,bmp",
				  drop_to_id:"drop_div",//托入有效区域对象id,如填写成document则将整个网页做为有效区域
				  send_id:"send",//确定上传按钮位置对像id,不填写或填写auto则自动上传
				  item_class:"myitem_small", //样式 可以不填写，不填写为显示图片
				  select_num_id:"select_num", //可以不填写，显示当前要上传的文件个数的对象id
				  success_num_id:"success_num", //可以不填写，显示当前要已上传的文件总个数的对象id
				  max_num_id:"max_num", //可以不填写，显示允许上传的个数
				  down_url:conf.uploadsite+"uploadhtml5e/include/php/down.php",//可以不填写，下载的
				  bt_del_text:"删除",
				  init_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:0,bg:0},
				  upload_show:{date:0,size:0,name:0,bar:1,baifenbi:1,del:0,bg:1},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条) del(删除按钮)
				  success_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:1,bg:0,see:1},//上传完后要显示的元素,1:显示,0不显
				  start_before:function(op){
				      var t=this;
				      var url=document.getElementById("url");
					  /*
				     if(url.value==""){
					    t.myalert("请先上传视频");
					   return false;
					 }
					  var arr0=url.value.split("uploads/");
					  var str="uploads/"+arr0[1];
					  var arr=str.split(".");
					  var newnamepath="";
					  for(var i =0;i<arr.length-1;i++){
					       if(newnamepath!=""){
						       newnamepath+="."+arr[i];
						   }else{
						      newnamepath+=arr[i];
						   }
					  };
					  */
					 if(typeof( t.opt.post)=="undefined"){
					   t.opt.post={};
					  }
					  t.opt.post["newnamepath"]=conf.newnamepath;
					  return true;
				  },
				  success:function(op){
				      var obj=document.getElementById(this.input_id+"_num");
					  if(obj){
					     obj.innerHTML=""+op.num+"/"+op.maxnum;
					  }
				  },del_huidiao:function(op){
				       var obj=document.getElementById(this.input_id+"_num");
					   if(obj){
					      obj.innerHTML=""+op.num+"/"+op.maxnum;
					  }
				  }
		 });
	 </script>
                        </div>


                       <div class="hr-line-dashed"></div>
                       <div class="form-group">
						 <label class="col-sm-3 control-label"> </label>
					    <div class="input-group col-sm-4">
                            <div class="layui-form-item" id='jg' <?php if(config("sfkqsims")==1): ?>style="display:none;"<?php endif; ?>>
                            <div class="layui-inline">
                            <label class="layui-form-label">打赏</label>
                            <div class="layui-input-inline" style="width: 100px;">
                            <input type="tel"  name="start"  oninput="gais()" id="s" lay-verify="phone"  class="layui-input" value="3" >
                            </div>
                            <div class="layui-form-mid">元 -</div>
                            <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" id="e" name="end"  oninput="gaie()"  class="layui-input" value="5" >
                            </div>
                            <div class="layui-form-mid">元</div>
                            </div>
                            </div>
                            <div class="layui-form-item" id='gd' <?php if(config("sfkqsims")==0): ?>style="display:none;"<?php endif; ?>>
                            <label class="layui-form-label">固定</label>
                            <div class="layui-input-inline">
                            <input type="text"  name="guding" oninput="gaiguding()"  id="g" value="3"  class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux">元</div>
                            </div>
                            <div class="foot4" <?php if(config("sfkqsims")==1): ?>style="display:none;"<?php endif; ?>>
                            <input  <?php if(config("sfkqsims")==0): ?>checked<?php endif; ?>  type="checkbox" onChange="dochange()" id="checkbox1" style="margin-right:5px;background:0;border:1px solid #333;" /><span id="suiji1">随机（<span id="start">3</span>到<span id="end">5</span>元)</span>
                            
                            </div>
                            <input type="hidden" name="issuiji" value="<?php if(config("sfkqsims")==0): ?>0<?php else: ?>1<?php endif; ?>" id="issuiji"/>

                            
                            </div>
						</div>
                       
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
  <script src="__JS__/jquery.min.js?v=2.1.4"></script>
<script src="__JS__/bootstrap.min.js?v=3.3.6"></script>
<script src="__JS__/content.min.js?v=1.0.0"></script>
<script src="__JS__/plugins/chosen/chosen.jquery.js"></script>
<script src="__JS__/plugins/iCheck/icheck.min.js"></script>
<script src="__JS__/plugins/layer/laydate/laydate.js"></script>
<script src="__JS__/plugins/switchery/switchery.js"></script><!--IOS开关样式-->
<script src="__JS__/jquery.form.js"></script>
<script src="__JS__/layer/layer.js"></script>
<script src="__JS__/laypage/laypage.js"></script>
<script src="__JS__/laytpl/laytpl.js"></script>
<script src="__JS__/dashang.js"></script>
<script>
    $(document).ready(function(){$(".i-checks").iCheck({checkboxClass:"icheckbox_square-green",radioClass:"iradio_square-green",})});
</script>

<script type="text/javascript" src="/static/admin/webupload/webuploader.css"></script>
<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>
<script type="text/javascript">

	 function dochange(){
if(document.getElementById("checkbox1").checked){
$('#issuiji').val('0');
$('#gd').css('display',"none");
$('#jg').css('display',"block");
}else{
$('#issuiji').val('1');
$('#jg').css('display',"none");
$('#gd').css('display',"block");
}
}
function gais(){
var zuidi=<?php echo config("zuidijiage"); ?>;
var s=$('#s').val();
if(s<zuidi && s!=''){
layer.msg('最低价格不能小于'+zuidi, {icon: 5,time:2000});
return;
}
$('#start').html(s);
}
function gaie(){
var s=$('#s').val();
var e=$('#e').val();
var zuigao=<?php echo config("zuidajiage"); ?>;
if(e>zuigao && e!=""){
layer.msg('最高价格不能大于'+zuigao+'元', {icon: 5,time:2000});
return;
}
$('#end').html(e);
}
function gaiguding(){
var zuidi= <?php echo config("zuidijiage"); ?>;
var zuigao= <?php echo config("zuidajiage"); ?>;
var val=$('#g').val();
var g = parseInt(val);
if(g!="" && g<zuidi){
layer.msg('固定价格不能小于'+zuidi, {icon: 5,time:2000});
$('#g').val(zuidi);
return;
}
if(g!="" && g>zuigao){
layer.msg('固定价格不能大于'+zuigao, {icon: 5,time:2000});
$('#g').val(zuigao);
return;
}
$('#gudingmoney').html(g+"元");
}



    var $list = $('#fileList');
    //上传图片,初始化WebUploader
    var uploader = WebUploader.create({
     
        auto: true,// 选完文件后，是否自动上传。   
        swf: '/static/admin/webupload/Uploader.swf',// swf文件路径 
        server: "<?php echo url('Upload/uploadshipin'); ?>",// 文件接收服务端。
        duplicate :true,// 重复上传图片，true为可重复false为不可重复
        pick: '#imgPicker',// 选择文件的按钮。可选。

        accept: {
            title: '视频上传',
            extensions: '3gp,mp4,rmvb,mov,avi,m4v,m3u8',
            mimeTypes: 'video/*,audio/*,application/*'
        },

        'onUploadSuccess': function(file, data, response) {
		
			if(data.code==0){
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                $( '#'+file.id ).find('p.state').text(data.msg);
            }else{
            $("#url").val("/uploads/shipin/"+data._raw);
            }
        }
    });

    uploader.on( 'fileQueued', function( file ) {
        $list.html( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">正在上传...</p>' +
        '</div>' );
    });
    uploader.on( 'uploadProgress', function( file, percentage ) {  
        var $li = $( '#'+file.id ),  
            $percent = $li.find('.progress span');  
      
        // 避免重复创建  
        if ( !$percent.length ) {  
            $percent = $('<p class="progress"><span></span></p>')  
                    .appendTo( $li )  
                    .find('span');  
        }  
        $percent.css( 'height',   '20px' );  
        $percent.css( 'display',   'block' );
         $percent.css( 'background',   '#00cc00' );   
        $percent.css( 'width', percentage * 100 + '%' );  
    }); 
    // 文件上传成功
    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传成功！');
    });

    // 文件上传失败，显示上传出错。
    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错!');
    }); 


    var $list2 = $('#fileList2');
    //上传图片,初始化WebUploader
    var uploader2 = WebUploader.create({
     
        auto: true,// 选完文件后，是否自动上传。   
        swf: '/static/admin/webupload/Uploader.swf',// swf文件路径 
        server: "<?php echo url('Upload/upload'); ?>",// 文件接收服务端。
        duplicate :true,// 重复上传图片，true为可重复false为不可重复
        pick: '#imgPicker2',// 选择文件的按钮。可选。

        accept: {
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/jpg,image/jpeg,image/png'
        },

        'onUploadSuccess': function(file, data, response) {
            $("#photo").val('/uploads/images/'+data._raw);
            //$("#img_data").attr('src', '/uploads/images/' + data._raw).show();
        }
    });

    uploader2.on( 'fileQueued', function( file ) {
        $list2.html( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">正在上传...</p>' +
        '</div>' );
    });

    // 文件上传成功
    uploader2.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传成功！');
    });

    // 文件上传失败，显示上传出错。
    uploader2.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('上传出错!');
    }); 





</script>
   
<script type="text/javascript">

    $(function(){
        $('#add').ajaxForm({
            beforeSubmit: checkForm, // 此方法主要是提交前执行的方法，根据需要设置
            success: complete, // 这是提交后的方法
            dataType: 'json'
        });

        function checkForm(){
            if( '' == $.trim($('#url').val())){
                layer.msg('视频文件不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
			if( '' == $.trim($('#name').val())){
                layer.msg('视频名称不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
			
			if(1 == $.trim($('#issuiji').val())){
				if( '' == $.trim($('#g').val())){
					layer.msg('固定金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
			
			
			}
			
			if(0 == $.trim($('#issuiji').val())){
				if( '' == $.trim($('#s').val())){
					layer.msg('随机最小金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
				
				if( '' == $.trim($('#e').val())){
					layer.msg('随机最大金额不能为空', {icon: 5,time:1500,shade: 0.1}, function(index){
						layer.close(index);
					});
					return false;
				}
			
			
			}
			

     }

        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.href="<?php echo url('siyou/index'); ?>";
                });
            }else{
                layer.msg(data.msg, {icon: 5,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                });
                return false;
            }
        }

    });


    //IOS开关样式配置
   var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, {
            color: '#1AB394'
        });
    var config = {
        '.chosen-select': {},                    
    }
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }



</script>
</body>
</html>
