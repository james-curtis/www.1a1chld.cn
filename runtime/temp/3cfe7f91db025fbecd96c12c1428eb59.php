<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/gongyou/shangchuan.html";i:1558455746;s:68:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/public/header.html";i:1550146424;s:68:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/public/footer.html";i:1550134066;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('WEB_SITE_TITLE'); ?></title>
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
<style>
.file-item{float: left; position: relative; width: 110px;height: 110px; margin: 0 20px 20px 0; padding: 4px;}
.file-item .info{overflow: hidden;}
.uploader-list{width: 100%; overflow: hidden;}
</style>
<body class="gray-bg">
	  
	<script>
	 var conf={
	     uploadsite:"/",
	     newnamepath:"<?php echo $newnamepath; ?>"
	 };
	 
	</script> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>上传视频</h5>
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
                    <form class="form-horizontal m-t" name="add" id="add" method="post" action="add">

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
								
								<span class="help-block m-b-none">最大可以上传500M的视频文件</span>
								<div style="display:none;">
								 <div id="fileList" class="uploader-list" style="float:right"></div>
                                <div id="imgPicker" style="float:left">选择文件</div>
								</div>
								
	                <div id="url_weizhi" style=" text-align:center; background-color:#3399FF; height:40px; width:100px; border-radius:3px;   cursor: pointer; color:#fff; line-height:40px; text-align:center; float:left; margin-right:10px;">上传视频</div>
	                <div id="url_panel" style="height:auto; width:auto; float:left; overflow:hidden;"></div>
                            </div>
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
				  isfull:1,
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
				  init_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:0,bg:0},
				  upload_show:{date:0,img:0,size:1,name:0,bar:1,baifenbi:1,del:0,bg:0},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条) del(删除按钮)
				  success_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:1,bg:0,see:1},//上传完后要显示的元素,1:显示,0不显
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
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> 保存</button>&nbsp;&nbsp;&nbsp;
                                <a class="btn btn-danger" href="javascript:history.go(-1);"><i class="fa fa-close"></i> 返回</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
  <script src="__JS__/jquery-ui.cs.js?v=1.32"></script>
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

<script type="text/javascript" src="/static/admin/webupload/webuploader.min.js"></script>

<script type="text/javascript">
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

     }

        function complete(data){
            if(data.code == 1){
                layer.msg(data.msg, {icon: 6,time:1500,shade: 0.1}, function(index){
                    layer.close(index);
                    window.location.href="<?php echo url('gongyou/index'); ?>";
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
