<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/yun.chinaeaglepower.cn/application/index/view/index/hezi.html";i:1558461496;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>Список видео.</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="UTF-8"></script>
<script type="text/javascript" src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script>
<link href="/static/index/css/style.css?v=0.1" rel="stylesheet">
<link href="/static/index/weui.min.css" rel="stylesheet">
<link href="/static/admin/css/style.min.css?v=0.1" rel="stylesheet">
</head>
<body style="max-width:460px; margin:0 auto;">
<div style="
height: 42px;
    width: 100%;
    background-color: #ff83bf;
    float: left;
    display: block;
    opacity: 0.8;
    line-height: 42px;
    font-size: 22px;
    text-align: center;
    color: #FFF;margin-bottom: 8px;
">Список видео. </div>
<div style="padding: 0px 8px 8px; ">

<?php if(!empty($tui['url'])): ?>

<div class="rich_media_content"  id="video" style="width: 100%; height: 250px;border: solid 1px #323136;padding-left:1px;"></div>
<?php endif; ?>
  <style>
    .top_menu_list{
    text-align: center;
    }
    .top_menu_list a{
    	width: 19%;
      text-align: center;
    margin-left: 5px;
    margin-right: 5px;
    margin-top: 5px;
    }
            .btn.cur {
                color: #fff;
                background: #d00;
            }
            .btn {
              margin: 0px;
    			padding: 0 8px;
    width: auto;
    color: #fff;
    background: #e66ca7;
    border: none;
    border-radius: 3px;
    float: left;
    display: block;
    overflow: hidden;
    padding: 5px;
    font-size: 18px;
            }
  </style>
                    <div class="top_menu_list">
					<a href="<?php echo url('',['userid'=>$userid,'ddh'=>$ddh,'id'=>$id]); ?>" class="btn <?php echo $gettype?'':'cur'; ?>">全部</a>
                                <?php foreach($type as $key=>$vo): ?>
  <a href="<?php echo url('',['userid'=>$userid,'ddh'=>$ddh,'type'=>$vo['id'],'id'=>$id]); ?>" class="btn <?php echo $gettype==$vo['id']?'cur':''; ?>"><?php echo $vo['name']; ?></a>
                                <?php endforeach; ?>
                    </div>
    
<div id="gdt_area" >
<div style="padding-top:10px;font-size:16px;">
<!-- <div style="margin: 0 1px 12px;text-align: center;line-height: 12px;"><span style="position: relative;top: 10px;background: #fff;color: #868686;font-size: 17px;padding: 0 8px">视频列表</span></div> -->
<div style=" background: #fff">
<div>


<section id="container">
    <div class="h_playlist_box" id="article_list">
    </div>
</section>

<div style="clear: both">
</div>
<div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: center; background: #fff"></div>
</div>
<script id="arlist" type="text/html">
	 {{# for(var i=0;i<d.length;i++){  }}
	
     <dl onclick="window.open('{{d[i].dwz}}')" style="width: 100%;"><dt style="height: 88.3365px;"><em></em><img src="{{d[i].photo}}" style="height: 88.3365px; display: inline;" onerror="this.src='/public/moren.jpg'"></dt><dd>
<span style="min-height: 58.3365px;">{{d[i].name}}</span>
<p><i><a>查看详情</a></i></p> 
</dd></dl>

	  {{# } }}
</script>
 
</div>
</div>
</div>

<style type="text/css">
    .spiner-example{height:200px;padding-top:70px}

</style>

<div class="spiner-example">
    <div class="sk-spinner sk-spinner-three-bounce">
        <div class="sk-bounce1"></div>
        <div class="sk-bounce2"></div>
        <div class="sk-bounce3"></div>
    </div>
</div>


<?php if(!empty($tui['url'])): ?>
<script type="text/javascript">
var videoObject = {
container: '#video',
variable: 'player', 
loop: true,
//autoplay: true, 
poster: '', 
video:'<?php echo $tui['url']?>'
};
var player = new ckplayer(videoObject);
</script>
<?php endif; ?>
<script type="text/javascript">
function run () {
var index = Math.floor(Math.random()*10);
pmd(index);
};
var times = document.getElementsByClassName('fuckyou').length;
//setInterval('run()',times*200);
function pmd (id) {
var colors = new Array('#FF5151','#ffaad5','#ffa6ff','#d3a4ff','#2828FF','#00FFFF','#1AFD9C','#FF8000','#81C0C0','#B766AD');
var color = colors[id];
var tmp = document.getElementsByClassName('fuckyou');
for (var i = 0; i < tmp.length; i++) {
var id = tmp[i];
var moren = id.style.color;
setTimeout(function(id){
id.style.color = color;
},i*200,id);
setTimeout(function(id,moren){
id.style.color = moren;
},i*200+180,id,moren);
};
}


function Ajaxpage(curr){

        var userid='<?php echo $userid; ?>';
        var ddh='<?php echo $ddh; ?>';
        var type='<?php echo $gettype; ?>';
        $.getJSON('<?php echo url("hezi"); ?>', {
            page: curr || 1,userid:userid,ddh:ddh,type:type
        }, function(data){      //data是后台返回过来的JSON数据

           $(".spiner-example").css('display','none');
            if(data==''){
               
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


 function article_list(list){

    var tpl = document.getElementById('arlist').innerHTML;
    laytpl(tpl).render(list, function(html){
        document.getElementById('article_list').innerHTML = html;
    });
}

</script>


<div id="dg" style="z-index: 9999;
    position: fixed ! important;
    right: 10px;
    bottom: 100px;
    background: #de4d4d;
    color: #fff;
    width: 35px;
    text-align: center;
    padding: 5px;
    font-size: 18px;
    border-radius: 50px;" onclick="location.href='<?php echo url('rec'); ?>'">
已打赏视频
</div>

</body>
</html>