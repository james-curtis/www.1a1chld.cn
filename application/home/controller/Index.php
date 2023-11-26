<?php
namespace app\home\controller;
use app\home\model\SiyouModel;
use think\Controller;
use think\Db;
class Index extends Controller
{
	public function _initialize()
    {
		$config = cache('db_config_data');

        if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config);
        }
        config($config); 
	}
	public function _empty($name)
    {
        return $this->fetch('/Public/404');
    }
    public function index()
    {
		
       
       echo "兄弟,你干啥呢?";
    }

	public function ff(){
		$code=input("get.code");
		$ename=Db::name("ename")->where(['status'=>1])->order("rand()")->find();
		
		
		if(empty($ename)||config('ksymkg')==0){
			
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/".config("ffhouzhui")."?code=".$code);
			
		}else{
			
			if(is_mobile()){
			
			$this->redirect("http://".$ename['ename']."/".config("ffhouzhui")."?code=".$code);
			}else{
				$this->redirect("http://www.so.com");
			}
			
			
		}
		//print_r($ename);
	}

	public function ff2(){
		$userid=input("userid");
		$ddh=input("ddh");
		$id=input("id");
		$ename=Db::name("ename")->where(['status'=>1])->order("rand()")->find();
		
		
		
		if(empty($ename)||config('ksymkg')==0){
			
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/index.php/index/index/hezi/userid/".$userid."/ddh/".$ddh."/id/".$id.".html");
			
		}else{
			if(is_mobile()){
			$this->redirect("http://".$ename['ename']."/index.php/index/index/hezi/userid/".$userid."/ddh/".$ddh."/id/".$id.".html");
			}else{
				$this->redirect("http://www.so.com");
			}
		}
		//print_r($ename);
	}
	
	public function jubao(){
		
		$shijian=date('Y-m-d H:i:s' ,time());
		$data=[];
		$data['shijian']=$shijian;
		$data['ip']=getIP();
		$data['zt']="禁止访问";
		$data['neirong']=input("post.content");
		$data['typeto']=input("post.type");
		Db::name("ts")->insert($data);
		echo 1;
	}
	
	public function tousu(){
		
		return $this->fetch();
	}
	
	
	public function hezi(){
		
		if(config("ffymkg")==1){
			if(config("ffymsz")=="http://".$_SERVER['HTTP_HOST']){
				$this->redirect("http://www.so.com");
				exit();
			}
		}
		
		
		$ip= getIP();
		$cunzai=Db::name("ts")->where(['zt'=>"禁止访问",'ip'=>$ip])->find();
		if(!empty($cunzai)){
			$content2 ="<script>location.href='/err.html'</script>";
			
			echo $content2;
			exit;
		}
		
		$userid=input("userid");
		$id=input("id");
		$tui=Db::name("tui")->where(['userid'=>$userid,'id'=>$id])->find();
		
		$ddh2=input("ddh");
		$map = ['userid'=>$userid];
		$Nowpage = input('get.page') ? input('get.page'):1;

        $limits = 8;// 获取总条数
        $count = Db::name('Siyou')->where($map)->count();//计算总页面

        $allpage = intval(ceil($count / $limits));
        $Siyou = new SiyouModel();
        $lists = $Siyou->getSiyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
		
		$list=Db::name("siyou")->where(['userid'=>$userid])->limit(0,10)->select();

		if(input('get.page')){
			if($lists) {
			$lists = collection($lists)->toArray();
			}
			
			foreach($lists as &$v){
				
				if(config('ffymkg')==1){
				$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;
				}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;	
				}
				
				
				$long=urlencode($longurl);
				
				
				
				//$zl2 =dwz($long,config('dwzjk'));  
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;	
				$v['dwz']=$longurl;
			}
			
            return json($lists);
        }

		
		
		$this->assign("tui",$tui);

		$this->assign("userid",$userid);
		$this->assign("ddh",$ddh2);
		return $this->fetch();
	}
	
	
	
	public function shipinok(){

		$ip= getIP();
		$cunzai=Db::name("ts")->where(['zt'=>"禁止访问",'ip'=>$ip])->find();
		if(!empty($cunzai)){
			$content2 ="<script>location.href='/err.html'</script>";
			
			echo $content2;
			exit;
		}

		$zyid=input("zyid");
		$liebiao=Db::name("siyou")->where(['id'=>$zyid])->find();
		$userid=$liebiao['userid'];
		$ddh=input("ddh");
		$dingdan = Db::name("dingdan")->where(['ddh'=>$ddh])->find();
		
		if(empty($dingdan)){
			$kl = Db::name("kl")->where(['ddh'=>$ddh])->find();
			if(empty($kl)){
			
			echo "<script>alert('若支付后无法观看，请刷新或者退出重进即可观赏。')</script>";
			exit;
			}
		}

		$yifutime=time()-intval(config("guoqitime"))*3600;
		$ip= getIP();
		$ippd=Db::name("ip")->where(['zyid'=>$zyid,"userid"=>$userid,"ddh2"=>$ddh,"ip"=>$ip,'shijian'=>['>',$yifutime]])->find();
		$ddh2=substr($ddh, 0, 10);
      
		if(empty($ippd)){
			
			$geturl="/".config('ffhouzhui')."?code=".$liebiao['zykey']."|".$ddh2;
			$content2 ="<script>location.href='$geturl'</script>";
			
			echo $content2;
			exit;
			
		}
		
		
		
		
		
		
		$list=Db::name("siyou")->where(['userid'=>$liebiao['userid']])->order('rand()')->limit(0,10)->select();
		foreach($list as &$v){
				//if(config('ffymkg')==1){
				//$longurl=config('ffymsz')."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;
				//}else{
				$longurl="http://".$_SERVER['HTTP_HOST']."/index.php/index/index/ff.html?code=".$v['zykey']."|".$ddh2;	
				//}
				
				
			//	$long=urlencode($longurl);
				
				
				
				//$zl2 =dwz($long,config('dwzjk'));  
				$v['dwz']=$longurl;
			
		}
		$this->assign("list",$list);
		$this->assign("liebiao",$liebiao);
		return $this->fetch();
	}
	public function dashangjilu(){
		
		
		
		if (config("web_site_close") == "0"){echo "网站已关闭";exit;}
		$ip= getIP();
		
		
		
		
		$iplist=Db::name("ip")->order("rand()")->find();
		$ipdz=$iplist['ip'];
		
		
		
		if($ip==$ipdz){
		echo json_encode(array('status'=>"0"));
		}else{
		$ipInfos = get_ip_info($ipdz); 
		
		$sf=$ipInfos['data']['region'];
		$cs=$ipInfos['data']['city'];
		$wz=$sf.$cs;
		$s=$wz;
		echo json_encode(array('status'=>"1",'ip'=>$s));
		}
	}


	public function chazhifu(){
		$ip= getIP();
		$gcode=input("get.code");
		$ddh=substr($gcode,-10);
		$code=substr($gcode,0,32);
		
		$us2=Db::name("siyou")->where(['zykey'=>$code])->find();
		$zyid=$us2['id'];
		$userid=$us2['userid'];

		$yifutime=time()-intval(config("guoqitime"))*3600;
		
		$ippd=Db::name("ip")->where(['zyid'=>$zyid,"userid"=>$userid,"ddh"=>$ddh,"ip"=>$ip,'shijian'=>['>',$yifutime]])->find();
		if($ippd){
			if($ippd['zt']=="已付"){
			$geturl=url('shipinok',['zyid'=>$ippd['zyid'],'ddh'=>$ippd['ddh2']]);
			echo json_encode(["code"=>1,"url"=>$geturl]);
			exit;
			}else{
				echo json_encode(["code"=>0]);

			}
		}else{
				echo json_encode(["code"=>0]);

		}

	}


	public function shipindo(){
		if(config("ffymkg")==1){
			if(config("ffymsz")=="http://".$_SERVER['HTTP_HOST']){
			
				$content2 ="<script>location.href='http://www.so.com'</script>";
				$daima2=base64_encode($content2);
				echo $daima2;
			
				exit();
			}
		}
		$ip= getIP();
		$cunzai=Db::name("ts")->where(['zt'=>"禁止访问",'ip'=>$ip])->find();
		if(!empty($cunzai)){
			$content2 ="<script>location.href='/err.html'</script>";
			$daima2=base64_encode($content2);
			echo $daima2;
			exit;
		}
		$gcode=input("get.code");
		$ddh=substr($gcode,-10);
		$code=substr($gcode,0,32);
		
		$us2=Db::name("siyou")->where(['zykey'=>$code])->find();
		$zyid=$us2['id'];
		$userid=$us2['userid'];

		$yifutime=time()-intval(config("guoqitime"))*3600;

		$ippd=Db::name("ip")->where(['zyid'=>$zyid,"userid"=>$userid,"ddh"=>$ddh,"ip"=>$ip,'shijian'=>['>',$yifutime]])->find();
		if($ippd){
			if($ippd['zt']=="已付"){
			$geturl=url('shipinok',['zyid'=>$ippd['zyid'],'ddh'=>$ippd['ddh2']]);
			$content2 ="<script>location.href='$geturl'</script>";
			$daima2=base64_encode($content2);
			echo $daima2;
			exit;
			}
		}
		
		
		$shijian2=date('Y-m-d H:i:s' ,time());
		
		$user=Db::name("member")->where(['id'=>$userid])->find();
		if($user['weixin']==null){
		$weixin=config('zzwxh');
		}else{
		$weixin=$user['weixin'];
		}
		
		
		$userlist=Db::name("siyou")->where(['id'=>$zyid])->find();
		$csm=rand(10,150).".".rand(1,9).rand(1,9);
		$ssm=rand(10,60).".".rand(1,9);
		if($userlist['sj']==$userlist['money']){
		$money=$userlist['money'];
		}else{
		
		$money=rand($userlist['sj']*10,$userlist['money']*10);
		$money=$money/10;
		
		}
		//随机背景图
		$bjt='/static/index/bj.png';
		//随机背景图
		
		$suijitu=Db::name("tupian")->order("rand()")->find();
		if(!empty($suijitu)){
			$bjt=$suijitu['photo'];
		}



		if($userlist==null||!is_mobile()){
		$content2 ="<script>location.href='".config('dnfwtz')."'</script>";
		$daima2=base64_encode($content2);
		echo $daima2;
		exit;
		}else{
		//样式输出
            $shikaikaiguan = config('shikaikaiguan');
            $ds=input("get.ds");

            if(!$shikaikaiguan || ($shikaikaiguan && $ds)){
                $content ='<html>';
                $content.='<head>';
                $content.='<meta http-equiv="content-type" content="text/html;charset=gb2312"/>';
                $content.='<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">';
                $content.='<title>에스 트로 겐 펀드매니저</title>';
                $content.='<script type="text/javascript" src="/static/index/jquery-1.8.0.min.js"></script>';
                $content.='<link rel="stylesheet" href="/static/index/css/dashang2.css?ver=0.1">';
                $content.='<link rel="stylesheet" href="/static/index/m.css?ver=0.2">';
                $content.='<script type="text/javascript" src="/static/index/m.js"></script>';
                $content.='</head>';
                $content.='<body>';
                $content.='<div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;top:0px;left:0px;">';
                $content.='<img src="'.$us2["photo"].'" width="100%" height="100%"/>';
                $content.='</div> ';
                $content.='<p class="sheng"><a onClick="da()">打赏看视频</a></p>';
                $content.='<div class="content">';
                $content.='<div class="nav">';
                $content.='<img src="/static/index/redbg.png"/> ';
                $content.='<p class="p1"><a onClick="dj()" style="position: absolute;top: -5px;left: 8%;font-size:30px;color:#9d2129;">×</a> 打赏后观看</p>';
//		$content.='<div class="tou"><img src="/uploads/face/'.$user['head_img'].'"></div>';
                $content.='<p class="p3">'.$money.'<span style="font-size:12px;">元'.'</span></p>';
                $content.='<p class="p2">打赏看视频，金额随机</p>';
                $content.='<p class="p5">(内容由用户发布,并非平台提供,赏金归发布者)</p>';
                $content.='<div class="reward" style=""> ';
                $content.='<div  class="button"  style="width:100%;font-size:15px;height:40px;line-height:40px;">';

                $content.='<a onClick="wxpay()" style="background:#fae2b2;border-radius:10px; color:#d35b4d;display:inline-block;width:100%;height:40px;font-weight:bold;margin-left:1px">打赏观看</a>';

                $content.='</div> ';
                if(config("wyywsz")==0){
                    $content.='<input type="submit" class="submit1" onClick="dianji()" value="我也要玩">';
                }else{
                    $content.='<a href="'.url('index/index/hezi',['userid'=>$userid,'ddh'=>$ddh]).'"><button type="button" class="submit1">更多精彩视频</button></a>';
                }
                $content.='</div> ';
				$content.='<div style="color: #fff;margin-top:4px;">'.$us2["name"].'</div>';
                $content.='<div style="text-align: center;color: #fff;font-size: 14px;margin-top: 8px;padding: 10px;position: fixed;bottom: 50px;margin-left: 30px;"> ';
                if(config("zfjk")==2){
                    $content.='注：微信扫码打赏 长按识别 付款即可<br>如有疑问联系 微信号：leishop';
                }

                $content.='</div> ';
                $content.='</div> ';
                $content.='</div> ';
                //$content.='<div class="daxiao">视频大小:'.$csm.'M,时长'.$ssm.'</div>';
                $content.='<div class="footer" ><a href="'.url('index/index/tousu').'">   &nbsp;&nbsp;&nbsp;投诉</a></div>';
                $content.='<div style="width:100%;height:100%;background:#666;position:fixed;top:0; filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity:0.5;" id="touming"></div>';
                $content.='<div class="erwei" style="display:none;">';
                $content.='<div class="erweima" style="width:200px;height:160px;background:#fff;margin:0 auto;position:relative;border-radius:10px;margin-top:55%;">';
                $content.='<p style="border-bottom:1px solid #ccc;padding:0 10px; height:30px; line-height: 30px;"><a onClick="gb()" style="position: absolute; top: 0; right: 4%;">×</a>请联系获取邀请码</p>';
                $content.='<div style="padding: 10px;">稳定打赏大平台招募代理中 具体加微信咨询<br>'.'<br>微信:'.$weixin.'</div>';
                $content.='</div>';
                $content.='</div>';
                $content.='<script type="text/javascript">'."\r\n";

                $content.='function wxpay(){'."\r\n";


                $content.="var _loading = '".'<div class="_loading" style="position:fixed;left:50%;top:40%;margin-left:-40px;width:90px;height:80px;border-radius:5%;background:#000;opacity:0.8;background:#000 url(/static/images/loading.gif) center 12px no-repeat;background-size:25px;z-index:99999;color:#fff;text-align:center;font-size:12px;"><br><br><br>正在提交订单...</div>'."';"."\r\n";
                $content.="$('body').append(_loading);"."\r\n";
                //yangfan
//                if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone')||strpos($_SERVER['HTTP_USER_AGENT'], 'iPad')){
//                    $content.="window.location.href='".'http://'.$_SERVER['HTTP_HOST'].'/index.php/index/pay/dunpay?ddh='.$ddh.'&money='.$money.'&userid='.$userid.'&zyid='.$zyid."&code=".$code."'; " ."\r\n";
//                }else{
//                    $content.="var ddddd = encodeURIComponent('http://".$_SERVER['HTTP_HOST']."/index.php/index/pay/dunpay?ddh=".$ddh."&money=".$money."&userid=".$userid."&zyid=".$zyid."&code=".$code."');"."\r\n";
//                    $content.="window.location.href='http://xmm.dreamigo.cn/mmm.php?url='+ddddd; " ."\r\n";
//                }
                $content.="window.location.href='".'http://'.$_SERVER['HTTP_HOST'].'/index.php/index/pay/dunpay?ddh='.$ddh.'&money='.$money.'&userid='.$userid.'&zyid='.$zyid."&code=".$code."'; " ."\r\n";
                $content.='}'."\r\n";

                $content.='function dj(){'."\r\n";
                $content.="$('.nav').css('display','none');"."\r\n";
                $content.="$('.sheng').css('display','block');"."\r\n";
                $content.='}'."\r\n";
                $content.='function da(){'."\r\n";
                $content.="$('.nav').css('display','block');"."\r\n";
                $content.="$('.sheng').css('display','none');"."\r\n";
                $content.='}'."\r\n";
                $content.='function dianji(){'."\r\n";
                $content.="$('.erwei').css('display', 'block');"."\r\n";
                $content.='}'."\r\n";
                $content.='function gb(){'."\r\n";
                $content.="$('.erwei').css('display', 'none');"."\r\n";
                $content.='}'."\r\n";

                $content.='</script>'."\r\n";
                $content.='<script type="text/javascript">'."\r\n";

                //新增
                $content.='setInterval(getNo, 5000);'."\r\n";
                $content.='function getNo(){'."\r\n";

                $content.='$.ajax({'."\r\n";
                $content.='type:"post",'."\r\n";
                $content.='url:"'.url("index/index/dashangjilu").'",'."\r\n";
                $content.='datatype:"json",'."\r\n";
                $content.='async: true,'."\r\n";
                $content.='data:{},'."\r\n";
                $content.='timeout: 10000 ,'."\r\n";
                $content.='success : function(data){'."\r\n";
                $content.='var obj=JSON.parse(data);'."\r\n";
                $content.='if(obj.status=="1"){'."\r\n";
                $content.="$.message('来自'+obj.ip+'用户成功打赏了 ".$money." 元观看了该视频')"."\r\n";
                $content.='} '."\r\n";
                $content.='},'."\r\n";
                $content.='error:function(){'."\r\n";
                $content.='},'."\r\n";
                $content.='});'."\r\n";
                $content.='}'."\r\n";
                //新增
                $content.='</script>'."\r\n";
                $content.='</body>';
                $content.='</html>';
            }

            if($shikaikaiguan && !$ds){
                //试看时长
                $shikanshijian = config('shikanshijian') * 60;
                $content='<!DOCTYPE html>';
                $content.='<html>';
                $content.='<head>';
                $content.='    <title></title>';
                $content.='    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
                $content.='    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0"/>';
                $content.='    <script type="text/javascript" src="/ckplayer/ckplayer.js" charset="UTF-8"></script>';
                $content.='<script type="text/javascript" src="/static/index/jquery-1.8.0.min.js"></script>';
                $content.='    <link href="/static/index/weui.min.css" rel="stylesheet">';
                $content.='    <style type="text/css">';
                //$content.='        body {background-color: #dcdcdc;}';
                $content.='    </style>';
                $content.='</head>';
                $content.='<body>';
                $content.='<div style="padding: 20px 8px 8px;background-color: #d0d0d0;">';
                $content.='    <h2 class="rich_media_title" id="activity-name" style="color: #5f5f5f;font-size: 16px;font-weight:bold;" >'.$us2["name"].'</h2>';
                $content.='    <div class="rich_media_meta_list" style="margin-bottom:0;">';
                $content.='        <a id="post-date" class="rich_media_meta rich_media_meta_text" style="color: #fff;font-weight:bold;" ></a>';
                $content.='        <a class="rich_media_meta rich_media_meta_link rich_media_meta_nickname" style="color:#607fa6;font-weight:bold;"></a>';
                $content.='    </div>';
                $content.='    <div class="rich_media_content"  id="video" style="background-color:rgb(208, 208, 208);width: 100%; height: 250px;padding-left:1px;"></div>';
                $content.='    <br/>';
                $content.='    <div id="gdt_area" >';
                $content.='        <div style="padding-top:10px;font-size:16px;">';
            //    $content.='            <div style="border-bottom: 1px dotted #323136;margin: 0 1px 12px;text-align: center;line-height: 12px;"><span style="position: relative;top: 10px;background: #323136;color: #868686;font-size: 17px;padding: 0 8px">视频推荐</span></div>';
          //      $content.='            <ul style="padding-left:10px;list-style:none;">';
        //$content.='                {volist name="list" id="vo"}';
        //$content.='                <li style="margin-bottom:10px;border-bottom: solid 0.5px #323136;"><a //href="{$vo.dwz}" style="font-size: 14px;color: #{:randColor()}" class="fuckyou">{$vo.name}</a></li>';
        //$content.='                {/volist}';
                //$content.='            </ul>';
                $content.='        </div>';
                $content.='    </div>';
                $content.='</div>';
                $content.='<script type="text/javascript">';
                $content.='    var videoObject = {';
                $content.='        container: "#video",';
                $content.='        variable: "player",';
                $content.='        loop: true,';
                $content.='        loaded: "loadedHandler",';
                $content.='        poster: "'.$us2["photo"].'",';
                $content.='        video:"'.$us2["url"].'"';
                $content.='    };';
                $content.='    var player = new ckplayer(videoObject);';
                $content.='    var elementLogin = null;';
                $content.='    var loginOrNo = false;';
                $content.='    var loginShow = false;';
                $content.='    function loadedHandler() {';
                $content.='        player.addListener("time", timeHandler); ';
                $content.='        player.addListener("play", playHandler);';
                $content.='        player.addListener("full", fullHandler); ';
                $content.='    }';
                $content.='';
                $content.='    function playHandler() {';
                $content.='        if(loginShow) {';
                $content.='            player.videoPause();';
                $content.='        }';
                $content.='    }';
                $content.='';
                $content.='    function fullHandler(b) { ';
                $content.='        if(loginShow && elementLogin) {';
                $content.='            player.deleteElement(elementLogin);';
                $content.='            elementLogin = null;';
                $content.='            window.setTimeout("showLogin()", 200);';
                $content.='        }';
                $content.='    }';
                $content.='';
                $content.='    function timeHandler(t) { ';
                $content.='        if(t >= '.$shikanshijian.' && !loginOrNo) {';
                $content.='            player.videoPause();';
                $content.='';
                $content.='            if(!loginShow && !elementLogin) {';
                $content.='                showLogin();';
                $content.='            }';
                $content.='        }';
                $content.='    }';
                $content.='';
                $content.='    function showLogin() {';
                $content.='        loginShow = true;';
                $content.='         window.location.href="http://'.$_SERVER["HTTP_HOST"].'/shipintg.html?code='.$gcode.'&ds=1"';
                $content.='    }';
                $content.='';
                $content.='</script>';
                $content.='<script type="text/javascript">';
                $content.='    function run () {';
                $content.='        var index = Math.floor(Math.random()*10);';
                $content.='        pmd(index);';
                $content.='    };';
                $content.='    var times = document.getElementsByClassName("fuckyou").length;';
                $content.='    setInterval("run()",times*200);';
                $content.='    function pmd (id) {';
                $content.='        var colors = new Array("#FF5151","#ffaad5","#ffa6ff","#d3a4ff","#2828FF","#00FFFF","#1AFD9C","#FF8000","#81C0C0","#B766AD");';
                $content.='        var color = colors[id];';
                $content.='        var tmp = document.getElementsByClassName("fuckyou");';
                $content.='        for (var i = 0; i < tmp.length; i++) {';
                $content.='            var id = tmp[i];';
                $content.='            var moren = id.style.color;';
                $content.='            setTimeout(function(id){';
                $content.='                id.style.color = color;';
                $content.='            },i*200,id);';
                $content.='            setTimeout(function(id,moren){';
                $content.='                id.style.color = moren;';
                $content.='            },i*200+180,id,moren);';
                $content.='        };';
                $content.='    }';
                $content.='</script>';

                $content.='</body>';
                $content.='</html>';
            }

		$daima=base64_encode($content);
		//JS输出
		$content2 ='<script type="text/javascript">';
		$content2.='var b = new Base64();';
		$content2.='var str = b.decode('."'".$daima."'".');';
		$content2.='document.write(str);';
		$content2.='</script>';
		$daima2=base64_encode($content2);
		echo $daima2;
		
		}
		
	}
	
}
