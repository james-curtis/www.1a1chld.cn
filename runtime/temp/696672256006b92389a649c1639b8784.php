<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"/www/wwwroot/ppds5di18.ink/application/index/view/index/shipinok.html";i:1559137647;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $liebiao['name']?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>
<!--script type="text/javascript" src="/ckplayer/ckplayer.js" charset="UTF-8"></script-->
<script type="text/javascript" src="jquery.js"></script>
<link href="/static/index/weui.min.css" rel="stylesheet">
<style type="text/css">
body {background-color: #fff;}
</style>
</head>
<body>
<div style="padding: 20px 15px 15px;background-color: #555;">
<h2 class="rich_media_title" id="activity-name" style="color: #fff;font-size: 14px;font-weight:bold;" ><?php echo $liebiao['name']?></h2>
<div class="rich_media_meta_list" style="margin-bottom:0;">
<a id="post-date" class="rich_media_meta rich_media_meta_text" style="color: #fff;font-weight:bold;" ><?php echo $liebiao['shijian']?></a>
<a class="rich_media_meta rich_media_meta_link rich_media_meta_nickname" style="color:#607fa6;font-weight:bold;"><?php echo config('web_site_title'); ?></a>
</div>
<div class="rich_media_content"  id="video" style="width: 100%; height: 250px;border: solid 1px #323136;padding-left:1px;"></div>
<br/>
<div id="gdt_area" >
<div style="padding-top:10px;font-size:16px;">
<div style="border-bottom: 1px dotted #323136;margin: 0 1px 12px;text-align: center;line-height: 12px;"><span style="position: relative;top: 10px;background: #323136;color: #868686;font-size: 17px;padding: 0 8px">视频推荐</span></div>

<ul style="padding-top: 10px;list-style:none;width: 100%; display: -webkit-flex; -webkit-flex-wrap: wrap; display: flex; flex-wrap: wrap;" id="article_list">

<?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
  <li style="display: -webkit-flex; display:flex; -webkit-flex-direction: column; flex-direction: column; width: 50%; margin-bottom: 10px; height: 200px;">
             <div class="video_img" style="padding-right: 10px;">
                <a href='<?php echo $vo['dwz']; ?>' >
                  <div style="position: relative; width: 100%; height: 100%;">
                    <img style="position: absolute; width: 25%; top: 30%; left: 37%;" src="/static/播放.png">
                    <img class="lazy_load_img" src="<?php echo $vo['photo']; ?>" data-src="<?php echo $vo['photo']; ?>" width="100%" height="100" onerror="javascript:this.src='<?php echo $vo['photo']; ?>'; this.onerror=null;" />
                  </div>
                </a> 
              </div>
              <div class="video_title" style="width: 90%; text-align: center; font-size: 16px; height: 80px; overflow: hidden;">
                <a style="display: inline-block; color: #ffa500; font-size: 12px;" href='<?php echo $vo['dwz']; ?>' ><?php echo $vo['name']; ?></a>
              </div>
</li>
<?php endforeach; endif; else: echo "" ;endif; ?>


</ul>
</div>
</div>
</div>
    <script src="//cdn.bootcss.com/hls.js/0.9.1/hls.min.js"></script>
    <script src="//cdn.bootcss.com/dplayer/1.22.2/DPlayer.min.js"></script>
<script type="text/javascript">
/*var videoObject = {
container: '#video',
variable: 'player', 
loop: true,
//autoplay: true, 
poster: '<?php echo $liebiao['photo']?>', 
video:'<?php echo $liebiao['url']?>'
};
var player = new ckplayer(videoObject);
  
  */
    var url = "<?php echo $liebiao['url']?>";
    var url2 = "";
    var pic = "<?php echo $liebiao['photo']?>";
    var ios = navigator.userAgent.match(/iPad|iPhone|Linux|iPod/i) != null;
    var andr = navigator.userAgent.match(/Android/i) != null;
    if (ios) {
        document.getElementById('video').innerHTML = '<video controls="controls" autoplay="autoplay" width="100%" height="100%" poster="' + pic + '"><source type="application/vnd.apple.mpegurl" src="' + url + '"><source src="' + url + '" type="video/mp4"></video>';
    }else if(andr) {
        document.getElementById('video').innerHTML = '<video controls="controls" autoplay="autoplay" width="100%" height="100%" poster="' + pic + '"><source type="application/x-mpegURL" src="' + url + '"><source src="' + url + '" type="video/mp4"></video>';
    }else {
	    var dp = new DPlayer({
	        element: document.getElementById('dplayer'),
	        autoplay: true,
	        theme: '#28a745',
	        loop: true,
	        screenshot: false,
	        hotkey: true,
	        preload: 'auto',
	        volume: 0.7,
	        mutex: true,
            video: {  //视频源 包含不同分辨率源
                quality: [{
                    name: '原画',
                    url: url
                },{
                    name: 'Mu_Kbps2',
                    url: url2
                }],
                defaultQuality: 0,
                pic: pic,
                type: 'auto'
            }
	    });
    }
</script>
<script type="text/javascript">
function run () {
var index = Math.floor(Math.random()*10);
pmd(index);
};
var times = document.getElementsByClassName('fuckyou').length;
setInterval('run()',times*200);
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
</script>

<div id="dg" style="z-index: 9999;
    position: fixed ! important;
    right: 10px;
    bottom: 30px;
    background: #de4d4d;
    color: #fff;
    width: 35px;
    text-align: center;
    padding: 5px;
    font-size: 18px;
    border-radius: 50px;" onclick="location.href='<?php echo url('rec',['userid'=>$ip['userid'],'ddh'=>$dd2]); ?>'">
已打赏视频
</div>


</body>
</html>