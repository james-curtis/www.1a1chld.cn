<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"/www/wwwroot/667628.vip/application/index/view/index/hezi.html";i:1563331957;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title>热门视频</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<script type="text/javascript" src="/ckplayer/ckplayer.js" charset="UTF-8"></script>
<script type="text/javascript" src="/static/admin/js/jquery.min.js?v=2.1.4"></script>
<script src="/static/admin/js/plugins/layer/laydate/laydate.js"></script>
<script src="/static/admin/js/laypage/laypage.js"></script>
<script src="/static/admin/js/laytpl/laytpl.js"></script>
<!--link href="/static/index/css/style.css?v=0.1" rel="stylesheet">
<link href="/static/index/weui.min.css" rel="stylesheet">
<link href="/static/admin/css/style.min.css?v=0.1" rel="stylesheet"-->
  <style>
    
body{ padding:0; margin:0; font-family: "微软雅黑", "宋体";background:#191919;}
ul,li,input,span{ padding:0; margin:0; list-style-type:none;}
.clear{ clear:both;}
input[type=button], input[type=submit], input[type=file], button { cursor: pointer; -webkit-appearance: none;}

.header{ height:70px; position:relative;width:100%;}
.head{ height:70px; background:#f4f4f4; border-bottom:1px solid #eeeeee; position:fixed; width:100%;}
.logo{ padding-left:20px; padding-top:15px;}
.h30{ height:30px;}
.h30a{ height:30px;}
.h10{ height:10px;}
.h10a{ height:10px;}
.mass{ width:100%; margin:0 auto; } 

.h_h50{ height:50px;}
.h_h20{ height:20px;}

.login_h1{ line-height:30px; height:30px; font-weight:bold; text-align:center; font-family:"微软雅黑", "宋体";color:#333;}
.login_h1 font{ font-size:12px; color:#FFF;}
 .login_txt{line-height:20px;color:red; font-size:12px; background:#FC6; border-bottom:1px dashed #CCC;font-family:"微软雅黑", "宋体"; padding-left:5px;padding-top:5px; padding-bottom:5px;}
  
.login_coty{ margin:0 auto; width:96%; text-align:left; line-height:20px; font-size:12px; color:#999; margin-top:10px; }
.login_coty li{ float:left; width:100%; }
  
.img_a{ float:left; width:150px; height:100px; overflow:hidden; margin-bottom:20px;}
.img_b{ margin-left:90px;  margin-bottom:20px; display: -webkit-flex; display: flex; flex-direction: column; justify-content: space-between; -webkit-justify-content: space-between; height:100px; }
.img_b_a{ line-height:10px; font-size:12px; overflow: hidden;}
.z1 {color:#666;}
.z1 a{ color: #ffa500; text-decoration:none;line-height:15px;} 
.z1 a:hover{ color:#F00; text-decoration:underline;}
.z2 {color:#F0F;}
.z2 a{ color:#F0F; text-decoration:none;line-height:30px;} 
.z2 a:hover{ color:#F00; text-decoration:underline;}
.z3 {color:#3F0;}
.z3 a{ color:#3F0; text-decoration:none;line-height:30px;} 
.z3 a:hover{ color:#F00; text-decoration:underline;} 
.z4 {color:#0FF;}
.z4 a{ color:#0FF; text-decoration:none;line-height:30px;} 
.z4 a:hover{ color:#F00; text-decoration:underline;}
.img_b_b{ padding-top:5px; font-size:12px; display: flex; display: -webkit-flex; -webkit-justify-content: space-between; justify-content: space-between; align-items:flex-end; }
.img_b_b a{ color:#FF0; text-decoration:none;} 
.img_b_b a:hover{ color:#F00; text-decoration:underline;}

.hc{ margin:0 auto; width:120px; height:120px; border-radius:60px 60px; text-align:center; color:#FFF; background:#f96160; font-size:50px; line-height:120px; font-family: Georgia, Times, serif;}
.hc{ margin:0 auto; width:120px; height:120px; border-radius:60px 60px; text-align:center; color:#FFF; background:#f96160; font-size:50px; line-height:120px; font-family: Georgia, Times, serif;}
.foot{ background:#302f34; height:40px; line-height:38px; text-align: center; width:100%; position: absolute; bottom:0px;color:#CCC;}
.foot img{ position:relative;top:3px; padding-right:5px;}
.foot a{color:#CCC; text-decoration:none;}
.foot a:hover{color:#CCC; text-decoration:none;}

.index_pages{ line-height:40px; text-align:center; }
.index_pages a{ color:#FFF; text-decoration:none; background:#999;border-radius:4px; font-size:12px; padding:5px 5px; margin:5px 5px;}
.index_pages a:hover{ color:#FFF; text-decoration:none;}

.vjs-big-play-button {
  line-height: 1.5em !important;
  height: 1.5em !important;
  width:1.5em !important;

  /* 0.06666em = 2px default */
  border: 0.06666em solid #FFF !important;
  /* 0.3em = 9px default */
  border-radius: 50% !important;
  left: 50%;
  top: 50%;
  margin-left: -20.5px !important;
  margin-top: -20.5px !important;  
}

.vjs-control-bar {
  background-color: rgba(0,0,0,0) !important;
}
.vjs-poster {
  background-size: contain !important;
}
  
@media screen and (max-width:900px) {
.login_coty{ width:96%;}
.mass{ width:96%;}
.reg{ display:none;}  
.login{ float: none; width:96%;}
.login_account{ display:block;}
.login_bd2{display:block;}
.h_navn_l{ display: none;}
.h_navn_r{ margin-left:0px;}
.h30a{ display:none;}
.h_menu_nav{ display:block;}
.foot{width:100%;}
}
a {
  text-decoration:none;
}
    .top_menu_list{
    text-align: center;
      padding: 5 0px;
    }
    .top_menu_list a{
    	width: 18%;
      text-align: center;
    margin-left: 5px;
    margin-right: 5px;
    margin-top: 5px;
    margin-bottom: 5px;
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
    background: #ec127f;
    border: none;
    border-radius: 10px;
    float: left;
    display: block;
    overflow: hidden;
    padding: 5px;
    font-size: 15px;
            }
    </style>
       <script>
var array = ["广东",
  "北京", 
  "福建", 
  "浙江", 
  "上海", 
  "湖北", 
  "湖南", 
  "江西", 
  "海南", 
  "天津", 
  "重庆", 
  "河北", 
  "河南", 
  "安徽", 
  "广西", 
  "四川", 
  "贵州", 
  "山西", 
  "辽宁", 
  "吉林", 
  "黑龙江",
  "江苏", 
  "山东", 
  "云南", 
  "陕西", 
  "甘肃", 
  "青海", 
  "台湾", 
  "内蒙古",
  "宁夏", 
  "新疆", 
  "西藏", 
  "香港", 
  "澳门"];
          $(function () {
              setInterval(function () {
                  if (document.getElementById("float_div")) {
                    $("#float_div").height(0);
                    $("#float_div").css("top", "0");
                    $("#float_div").remove();
                  }else {
                    $("#float_div_parent").append("<div id='float_div' style='width: 250px; text-align: center; height: 10px; position: relative; color: #FFF; font-size: 16px; padding: 5px 10px; transition: all 0.5s; '> 来自"+array[Math.floor(Math.random()*(33+1)+0)]+"的用户打赏"+Math.floor(Math.random()*(5)+3)+"元</div>");
                    $("#float_div").height(30);
                    $("#float_div").css("top", "0");
                  } 
              }, 2000);})
     </script>
</head>
<body style="max-width:460px; margin:0 auto;">
       <div id="float_div_parent" style="display: flex; flex-direction: column; position: absolute; left: 0; right:0; top: 0; width: 250px; margin: auto;">
        <div id='float_div' style='width: 250px; height: 10px; text-align: center; top:0; position: relative; color: #FFF; font-size: 16px; padding: 5px 10px; transition: all 0.5s; '>来自四川的用户打赏6元</div> 
     </div>
     <script>
     var float_div = document.getElementById("float_div");
     </script>
     <div class="login_h1">
     <br/>

     </div>
<div style="padding: 0px 8px 8px; ">

<?php if(!empty($tui['url'])): ?>

<div class="rich_media_content"  id="video" style="width: 100%; height: 150px;border: solid 1px #323136;padding-left:1px;"></div>
<?php endif; ?>
<div class="top_menu_list">

	<?php foreach($type as $key=>$vo): ?>
		<a href="<?php echo url('',['userid'=>$userid,'ddh'=>$ddh,'type'=>$vo['id'],'id'=>$id]); ?>" class="btn <?php echo $gettype==$vo['id']?'cur':''; ?>"><?php echo $vo['name']; ?></a>
	<?php endforeach; ?>
</div>



<div class="login_coty" id="container">
      <ul style="width: 100%; display: -webkit-flex; -webkit-flex-wrap: wrap; display: flex; flex-wrap: wrap;" id="article_list">
        
      </ul>
</div>

<div style="clear: both">
</div>
<div id="AjaxPage" style=" text-align: right;"></div>
                    <div id="allpage" style=" text-align: center; color: #fff"></div>
</div>
<script id="arlist" type="text/html">
	 {{# for(var i=0;i<d.length;i++){  }}
	<li style="display: -webkit-flex; display:flex; -webkit-flex-direction: column; flex-direction: column; width: 50%; margin-bottom: 10px; height: 200px;">
             <div class="video_img" style="padding-right: 10px;">
                <a href='{{d[i].dwz}}' >
                  <div style="position: relative; width: 100%; height: 100%;">
                    
                    <img class="lazy_load_img" src="{{d[i].photo}}" data-src="{{d[i].photo}}" width="100%" height="100" onerror="javascript:this.src='{{d[i].photo}}'; this.onerror=null;" />
                  </div>
                </a> 
              </div>
              <div class="video_title" style="width: 90%; text-align: center; font-size: 16px; height: 80px; overflow: hidden;">
                <a style="display: inline-block; color: #ffa500; font-size: 12px;" href='{{d[i].dwz}}' >{{d[i].name}}</a>
              </div>
              <div class="video_tag" style="display: -webkit-flex; display: flex; margin-right: 5px; justify-content: space-between; -webkit-justify-content: space-between; overflow: hidden;">
                <a href='{{d[i].dwz}}'><span style="color: #FFF; line-height: 15px; font-size: 10px; text-align:center; width:75px; display: inline-block; padding: 0px 1px; background: #ec127f; border: 1px solid #ec127f; border-radius: 20px;">{{d[i].d1}}人观看</span></a>
                <a href='{{d[i].dwz}}'><span style="color: #FFF; line-height: 15px; font-size: 10px; text-align:center; width: 75px; display: inline-block; padding: 0px 1px; background: #0c667b; border: 1px solid #0c667b; border-radius: 20px;">{{d[i].d2}}人点赞</span></a>

              </div>
            </li>     
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
               
                    skin: '#1AB5B7',//分页组件颜色
                    curr: curr || 1,
                    groups: 3,//连续显示分页数
                    jump: function(obj, first){

                        if(!first){
                            Ajaxpage(obj.curr)
                        }
                        $('#allpage').html('第'+ obj.curr +'页 共'+ obj.pages +'页');
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


     </div>
<div id="dg" style="z-index: 9999;
    position: fixed ! important;
    right: 10px;
    bottom: 100px;
    background: #de4d4d;
    color: #fff;
    width: 15px;
    text-align: center;
    padding: 5px;
    font-size: 10px;
    border-radius: 10px;" onclick="location.href='<?php echo url('rec'); ?>'">
已打赏视频
</div>
</body>
</html>