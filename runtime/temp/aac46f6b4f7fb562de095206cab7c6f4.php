<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:59:"D:\wwwroot\wxds/application/dsadmin/view/gonggao/index.html";i:1536907466;s:59:"D:\wwwroot\wxds/application/dsadmin/view/public/header.html";i:1550146424;s:59:"D:\wwwroot\wxds/application/dsadmin/view/public/footer.html";i:1550134066;}*/ ?>
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
<div class="wrapper wrapper-content animated fgonggaoeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>公告列表</h5>
        </div>
        <div class="ibox-content">        
            <div class="row">
                <div class="col-sm-12">   
                <div  class="col-sm-2" style="width: 100px">
                    <div class="input-group" >  
                        <a href="<?php echo url('add_gonggao'); ?>"><button class="btn btn-outline btn-primary" type="button">添加公告</button></a> 
                    </div>
                </div>                                            
                    <form name="gonggaomin_list_sea" class="form-search" method="post" action="<?php echo url('index'); ?>">
                        <div class="col-sm-3">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control" name="key" value="<?php echo $val; ?>" placeholder="输入需查询公告标题" />   
                                <span class="input-group-btn"> 
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> 搜索</button> 
                                </span>
                            </div>
                        </div>
                    </form>                         
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="example-wrap">
                <div class="example">
                    <table class="table table-bordered table-hover">
                        <thegonggao>
                            <tr class="long-tr">
                                <th>ID</th>
                                <th>标题</th>
                               
                               
                               
                                
                                <th>添加时间</th>
                                <th>状态</th>
								<th>弹窗</th>
                                <th width="15%">操作</th>
                            </tr>
                        </thegonggao>
                        <script id="arlist" type="text/html">
                            {{# for(var i=0;i<d.length;i++){  }}

                            <tr class="long-td">
                                <td>{{d[i].id}}</td>
                                <td>{{d[i].title}}</td>
                               
                                                      
                               
                                
                                <td>{{d[i].create_time}}</td>   
                                <td>
                                    {{# if(d[i].status==1){ }}
                                         <a class="red" href="javascript:;" onclick="gonggao_state({{d[i].id}});">
                                            <div id="zt{{d[i].id}}"><span class="label label-info">置顶</span></div>
                                        </a>
                                    {{# }else{ }}
                                        <a class="red" href="javascript:;" onclick="gonggao_state({{d[i].id}});">
                                            <div id="zt{{d[i].id}}"><span class="label label-danger">不置顶</span></div>
                                        </a>
                                    {{# } }}
                                </td>  
								<td>
                                    {{# if(d[i].tanchuang==1){ }}
                                         <a class="red" href="javascript:;" onclick="gonggao_tc({{d[i].id}});">
                                            <div id="tc{{d[i].id}}"><span class="label label-info">弹窗</span></div>
                                        </a>
                                    {{# }else{ }}
                                        <a class="red" href="javascript:;" onclick="gonggao_tc({{d[i].id}});">
                                            <div id="tc{{d[i].id}}"><span class="label label-danger">不弹窗</span></div>
                                        </a>
                                    {{# } }}
                                </td>     								
                                <td>
                                   
                                    <a href="javascript:;" onclick="del_gonggao({{d[i].id}})" class="btn btn-danger btn-xs btn-outline">
                                        <i class="fa fa-trash-o"></i> 删除</a>
                                </td>
                            </tr>
                            {{# } }}
                        </script>
                        <tbody id="article_list"></tbody>
                    </table>
                    <div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: right;"></div>
                </div>
            </div>
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
   
    /**
     * [Ajaxpage laypage分页]
     * @param {[type]} curr [当前页]
     */ 
    function Ajaxpage(curr){

        var key=$('#key').val();
        $.getJSON('<?php echo url("gonggao/index"); ?>', {
            page: curr || 1,key:key
        }, function(data){      //data是后台返回过来的JSON数据

            $(".spiner-example").css('display','none'); //数据加载完关闭动画           
            if(data==''){
                $("#article_list").html('<td colspan="20" style="pgonggaoding-top:10px;pgonggaoding-bottom:10px;font-size:16px;text-align:center">暂无数据</td>');
            }else{
                article_list(data); //模板赋值
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

    Ajaxpage();

/**
 * [article_list 接收异步获取的数据渲染到模板]

 */
function article_list(list){

    var tpl = document.getElementById('arlist').innerHTML;
    laytpl(tpl).render(list, function(html){
        document.getElementById('article_list').innerHTML = html;
    });
}


/**
 * [edit_gonggao 编辑公告]

 */ 
function edit_gonggao(id){

    location.href = './edit_gonggao/id/'+id+'.html';
}


/**
 * [del_gonggao 删除公告]

 */
function del_gonggao(id){
    layer.confirm('确认删除此公告?', {icon: 3, title:'提示'}, function(index){
        $.getJSON('./del_gonggao', {'id' : id}, function(res){
            if(res.code == 1){
                layer.msg(res.msg,{icon:1,time:1500,shgonggaoe: 0.1});
                Ajaxpage(1,5)
            }else{
                layer.msg(res.msg,{icon:0,time:1500,shgonggaoe: 0.1});
            }
        });

        layer.close(index);
    })

}


/**
 * [gonggao_state 公告状态]

 */
function gonggao_state(val){
    $.post('<?php echo url("gonggao_state"); ?>',
    {id:val},
    function(data){
         
        if(data.code==1){
            var a='<span class="label label-danger">不置顶</span>'
            $('#zt'+val).html(a);
            layer.msg(data.msg,{icon:2,time:1500,shgonggaoe: 0.1,});
            return false;
        }else{
            var b='<span class="label label-info">置顶</span>'
            $('#zt'+val).html(b);
            layer.msg(data.msg,{icon:1,time:1500,shgonggaoe: 0.1,});
            return false;
        }         
        
    });
    return false;
}

function gonggao_tc(val){
    $.post('<?php echo url("gonggao_tc"); ?>',
    {id:val},
    function(data){
         
        if(data.code==1){
            var a='<span class="label label-danger">不弹窗</span>'
            $('#tc'+val).html(a);
            layer.msg(data.msg,{icon:2,time:1500,shgonggaoe: 0.1,});
            return false;
        }else{
            var b='<span class="label label-info">弹窗</span>'
            $('#tc'+val).html(b);
            layer.msg(data.msg,{icon:1,time:1500,shgonggaoe: 0.1,});
            return false;
        }         
        
    });
    return false;
}
</script>
</body>
</html>