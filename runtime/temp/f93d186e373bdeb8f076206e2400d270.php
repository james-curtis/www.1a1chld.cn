<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:65:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/type/index.html";i:1558454484;s:68:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/public/header.html";i:1550146424;s:68:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/public/footer.html";i:1550134066;}*/ ?>
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
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <!-- Panel Other -->
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>视频分类(<?php echo $count; ?>个)</h5>
        </div>
        <div class="ibox-content">
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
							<th width="3%"><input type="checkbox" name="mmAll" onclick="All(this, 'del_id[]')" style="position:relative;clip: rect(6 15 15 6)"></th>
                                <th width="3%">ID</th>
                                <th width="15%">分类名称</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                                <tr class="long-td">
								 <td><input type="checkbox" title="1" name="del_id[]" value="{{d[i].id}}" id="del_id"></td>
                                    <td>{{d[i].id}}</td>
                                    <td><span id="name{{d[i].id}}">{{d[i].name}}</span> </td>
                                    <td>
                                        <a href="javascript:;" onclick="edit_gongyou({{d[i].id}})" class="btn btn-primary btn-xs btn-outline">
                                            <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                        <a href="javascript:;" onclick="del_gongyou({{d[i].id}})" class="btn btn-danger btn-xs btn-outline">
                                            <i class="fa fa-trash-o"></i> 删除</a>
                                    </td>
                                </tr>
                            {{# } }}
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style="text-align:right;"></div>
                    <div style="text-align: right;">
                       <span id="allpage"></span>
                    </div>
                </div>
				<div class="row">
					<div class="col-sm-12">   
					<div  class="col-sm-2" style="width: 100px">
						<div class="input-group" >  
							<a href="javascript:;"><button class="btn btn-outline btn-primary" id="plqr" type="button">批量删除</button></a> 
							<a href="<?php echo url('add'); ?>"><button class="btn btn-outline btn-primary" id="add" type="button">添加</button></a> 
						</div>
					</div>                                            
                                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- 加载动画 -->
<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
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

<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="utf-8"></script>

<script type="text/javascript">
   
    /**
     * [Ajaxpage laypage分页]
     * @param {[type]} curr [当前页]
     */
    Ajaxpage();

    function Ajaxpage(curr){
        var key=$('#key').val();
        $.getJSON('<?php echo url("type/index"); ?>', {
            page: curr || 1,key:key
        }, function(data){      //data是后台返回过来的JSON数据
			$(".spiner-example").css('display','none'); //数据加载完关闭动画
            if(data==''){
                $("#list-content").html('<td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
            }else{
                var tpl = document.getElementById('list-template').innerHTML;
                laytpl(tpl).render(data, function(html){
                    document.getElementById('list-content').innerHTML = html;
                });
                laypage({
                    cont: $('#AjaxPage'),//容器。值支持id名、原生dom对象，jquery对象,
                    pages:'<?php echo $allpage; ?>',//总页数
                    skip: true,//是否开启跳页
                    skin: '#1AB5B7',//分页组件颜色
                    curr: curr || 1,
                    groups: 3,//连续显示分页数
                    jump: function(obj, first){
                        if(!first){
                            Ajaxpage(obj.curr)
                        }
                        $('#allpage').html('第'+ obj.curr +'页，共'+ obj.pages +'页');
                    }
                });
            }
        });
    }
 

function edit_gongyou(id){
    location.href = './edit/id/'+id+'.html';
}


function del_gongyou(id){
    dashang.confirm(id,'<?php echo url("del"); ?>');
}

function show(id,name) {
var zt = $("#show"+id+"").html();
if(zt=='点击显示'){  
$("#name"+id+"").html(name);
$("#show"+id+"").html('点击隐藏');
}else if(zt=='点击隐藏'){  
$("#name"+id+"").html('****');
$("#show"+id+"").html('点击显示');
}
}

function All(e, itemName){
	var aa = document.getElementsByName(itemName);
	for (var i=0; i<aa.length; i++)
	aa[i].checked = e.checked; 
	}
	function checkdel(delid,formname){
	var flag = false;
	for(i=0;i<delid.length;i++){
	if(delid[i].checked == true){
	flag = true;
	break;
	}
	}
	if(!flag){
	return true;
	}else{
	formname.submit();
	}
}


 $("#plqr").click(function(){
	
	var aa = document.getElementsByName('del_id[]');
	var n=0;
	var ids="";
	for (var i=0; i<aa.length; i++){
		
		if(aa[i].checked == true){
			
			if(n>0){
                ids += ',';
            }
            ids += aa[i].value;
			n++;
		}
		
	}
	
	if(ids==''){
		layer.msg("请选择视频",{icon:0,time:1500,shade: 0.1});
	}else{
		 dashang.confirm(ids,'<?php echo url("del"); ?>');
	}
	
}) 

function play(url) {

var index1=url.lastIndexOf(".");
var index2=url.length;
var suffix=url.substring(index1+1,index2);
if(suffix==""||suffix=="m3u8"){

layer.alert('<div id="a1"  style="width:580px;height:360px;"></div>\
', {
skin: 'layui-layer-molv' ,
area: ['620px', '510px'] 
,closeBtn: 0,btn:['关闭'],
title:"视频预览",
}); 

 
	
	var videoObject = {
		container: '#a1',//“#”代表容器的ID，“.”或“”代表容器的class
		variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
		autoplay:true,//自动播放
		html5m3u8:true,
		video:url//视频地址
	};
	var player=new ckplayer(videoObject);

}else{

layer.alert('<div id="a1"  style="width:580px;height:360px;"></div>\
', {
skin: 'layui-layer-molv' ,
area: ['620px', '510px'] 
,closeBtn: 0,btn:['关闭'],
title:"视频预览",
}); 

 
	
	var videoObject = {
		container: '#a1',//“#”代表容器的ID，“.”或“”代表容器的class
		variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
		autoplay:true,//自动播放
		html5m3u8:true,
		video:url//视频地址
	};
	var player=new ckplayer(videoObject);
}
$('.layui-layer').css('top','10%');  
}
</script>
</body>
</html>