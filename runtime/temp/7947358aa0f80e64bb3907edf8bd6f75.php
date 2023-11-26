<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"/www/wwwroot/www.658166.vip/application/dsadmin/view/ename/index.html";i:1546985112;s:71:"/www/wwwroot/www.658166.vip/application/dsadmin/view/public/header.html";i:1550146424;s:71:"/www/wwwroot/www.658166.vip/application/dsadmin/view/public/footer.html";i:1550134066;}*/ ?>
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
            <h5>域名列表</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                <div class="col-sm-12">   
                <div  class="col-sm-2" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('add'); ?>"><button class="btn btn-outline btn-primary" type="button">添加域名</button></a> 
                    </div>
                </div>                                            
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="col-sm-3" style="width:40%;">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="输入需查询的域名" /> 
                                 								
                                <span class="input-group-btn"> 
								
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button> 
									 <input style="margin-left:8px;" type="button" class="btn btn-danger" id="jc_0" value="拦截检查" /> 
                                </span>
								
                            </div>
                        </div>
                    </form>                         
                </div>
            </div>
            <!--搜索框结束-->
            <div class="hr-line-dashed"></div>

            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="long-tr">
                                <th>ID</th>
                                <th>域名</th>
                               
                                <th>状态</th>
								<th>检查结果</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}

                            <tr class="long-td">
                                <td>{{d[i].id}}</td>
                                <td>{{d[i].ename}}</td>
                                                          
                                <td>
                                  
                                        {{# if(d[i].status==1){ }}
                                            <a class="red" href="javascript:;" onclick="ename_status({{d[i].id}});">
                                                <div id="zt{{d[i].id}}"><span class="label label-info">开启</span></div>
                                            </a>
                                        {{# }else{ }}
                                            <a class="red" href="javascript:;" onclick="ename_status({{d[i].id}});">
                                                <div id="zt{{d[i].id}}"><span class="label label-danger">禁用</span></div>
                                            </a>
                                        {{# } }}
                                   
                                </td>
								 <td ><span id="jc_{{d[i].id}}" class="jc" data-name="{{d[i].ename}}"  data-id="{{d[i].id}}">单击检查</span></td>
                                <td>
                                   
                                        <a href="javascript:;" onclick="enameEdit({{d[i].id}})" class="btn btn-primary btn-xs">
                                            <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                            
                                        <a href="javascript:;" onclick="enameDel({{d[i].id}})" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash-o"></i> 删除</a>
                                   
                                </td>
                            </tr>
                            {{# } }}
                        </script>
                        <tbody id="list-content"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
            <!-- End Example Pagination -->
        </div>
    </div>
</div>
<!-- End Panel Other -->
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
<style>
.jc{ color:#666;border-radius:5px; border:solid 1px #666;padding:2px;font-size:12px;cursor:pointer; }
.jc66{ color:#00CC33;border:solid 1px #00CC33;}
.jc0{ color:#ff0000;border:solid 1px #ff0000;}
.jc88{ color:#ff0000;border:solid 1px #ff0000;}
</style>
<script type="text/javascript">
   
    //laypage分页
    Ajaxpage();
						  $("#jc_0000").on("click",function(){
					          var obj=$(this);
							  var url=$("#key").val();
							  var id=obj.data("id");
							   if(url==""){
							    alert("请输入不带https或http的域名");
								return false;
							   };
							   obj.val("正在检查");
							  $.ajax({
								url:"<?php echo Url('jcsite'); ?>",
								data:{"url":""+url,"id":0},
								type:"post",
								dataType:"json",
								success:function(res){
									//$("#jc_"+res.id).html(res.msg);  
									//var obj=$("#jc_"+res.id);
									layer.msg(res.msg);
									  obj.val("检查");
									//obj.addClass("jc"+res.state);
								}
							  });
							  
					  });
					    $("#jc_0").on("click",function(){
					  $(".jc").each(function(){
					       var obj=$(this);
							  var url=obj.data("name");
							  var id=obj.data("id");
							  obj.html("正在检查");
							  $.ajax({
								url:"<?php echo Url('jcsite'); ?>",
								data:{"url":""+url,"id":id},
								type:"post",
								dataType:"json",
								success:function(res){
									$("#jc_"+res.id).html(res.msg);  
									var obj=$("#jc_"+res.id);
									obj.addClass("jc"+res.state);
								}
							  });
					  });
					});
    function Ajaxpage(curr){
        var key=$('#key').val();
        $.getJSON('<?php echo url("index"); ?>', {page: curr || 1,key:key}, function(data){
            $(".spiner-example").css('display','none'); //数据加载完关闭动画 
            if(data==''){
                $("#list-content").html('<td colspan="20" style="padding-top:10px;padding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
            }else{
                var tpl = document.getElementById('list-template').innerHTML;
                laytpl(tpl).render(data, function(html){
                    document.getElementById('list-content').innerHTML = html;
					$(".jc").each(function(){
					
					 
					  $(this).on("click",function(){
					       var obj=$(this);
							  var url=obj.data("name");
							  var id=obj.data("id");
							  obj.html("正在检查");
							  $.ajax({
								url:"<?php echo Url('jcsite'); ?>",
								data:{"url":""+url,"id":id},
								type:"post",
								dataType:"json",
								success:function(res){
									$("#jc_"+res.id).html(res.msg);  
									var obj=$("#jc_"+res.id);
									obj.addClass("jc"+res.state);
								}
							  });
					  })

					});
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

//编辑用户
function enameEdit(id){
    location.href = './edit/id/'+id+'.html';
}

//删除用户
function enameDel(id){
    dashang.confirm(id,'<?php echo url("del"); ?>');
}

//用户状态
function ename_status(id){
    
    dashang.status(id,'<?php echo url("status"); ?>');
}

</script>
</body>
</html>