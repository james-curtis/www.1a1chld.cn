<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:67:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/member/index.html";i:1536907466;s:68:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/public/header.html";i:1550146424;s:68:"/www/wwwroot/rdyhue.shop/application/dsadmin/view/public/footer.html";i:1550134066;}*/ ?>
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
            <h5>代理列表</h5>
        </div>
        <div class="ibox-content">
            <!--搜索框开始-->           
            <div class="row">
                <div class="col-sm-12">   
                <div  class="col-sm-2" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('add_member'); ?>"><button class="btn btn-outline btn-primary" type="button">添加代理</button></a> 
                    </div>
                </div>                                    
                    <form name="admin_list_sea" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="输入需查询的代理ID/账号/昵称/qq/微信" />   
                                <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button> 
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
								<th width="5%">邀请代理ID</th>
                                <th width="4%">代理ID</th>
                                <th width="9%">账号</th>
                                <th width="9%">昵称</th>
                                <th width="5%">密码</th>
                                <th width="6%">qq</th>
                                <th width="5%">微信</th>
                               
                                <th width="5%">余额</th>
                                <th width="5%">已提现金额</th>
								<th width="5%">提现费率</th>
                                <th width="5%">登录次数</th>
                                <th width="6%">状态</th>
                                <th width="10%">注册时间</th>
                                <th width="5%">操作</th>
                            </tr>
                        </thead>
                        <script id="list-template" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}
                            <tr class="long-td">
								 <td>{{# if(d[i].pid==0){ }}无{{# }else{ }} {{d[i].pid}}{{# } }}         </td>
                                <td>{{d[i].id}}</td>
                                <td>{{d[i].account}}</td>
                                <td>{{d[i].nickname}}</td>
                                <td>
                                    {{d[i].password}}
                                </td>
                                <td>{{d[i].qq}}</td>
                                <td>
                                    {{d[i].weixin}}                          
                                </td>
                                                           
                                <td>{{d[i].money}}</td>
								<td>{{d[i].txmoney}}</td>       
                                <td>{{d[i].txfeilv}}%</td>
                                <td>{{d[i].login_num}}</td>                                                                
                                <td>                             
                                    {{# if(d[i].status==1){ }}
                                        <a class="red" href="javascript:;" onclick="member_status({{d[i].id}});">
                                            <div id="zt{{d[i].id}}"><span class="label label-info">开启</span></div>
                                        </a>
                                    {{# }else{ }}
                                        <a class="red" href="javascript:;" onclick="member_status({{d[i].id}});">
                                            <div id="zt{{d[i].id}}"><span class="label label-danger">禁用</span></div>
                                        </a>
                                    {{# } }}                               
                                </td>
                                <td>{{d[i].create_time}}</td> 
                                <td>                                  
                                    <a href="javascript:;" onclick="edit_member({{d[i].id}})" class="btn btn-primary btn-outline btn-xs">
                                        <i class="fa fa-paste"></i> 编辑</a>&nbsp;&nbsp;
                                    <a href="javascript:;" onclick="del_member({{d[i].id}})" class="btn btn-danger btn-outline btn-xs">
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

<script type="text/javascript">
   
    //laypage分页
    Ajaxpage();
    function Ajaxpage(curr){
        var key=$('#key').val();
        $.getJSON('<?php echo url("Member/index"); ?>', {page: curr || 1,key:key}, function(data){
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

//编辑代理
function edit_member(id){
    location.href = './edit_member/id/'+id+'.html';
}

//删除代理
function del_member(id){
    dashang.confirm(id,'<?php echo url("del_member"); ?>');
}

//用户代理
function member_status(id){
    dashang.status(id,'<?php echo url("member_status"); ?>');
}

</script>
</body>
</html>