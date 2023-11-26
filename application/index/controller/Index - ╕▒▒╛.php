<?php
namespace app\index\controller;
use app\index\model\SiyouModel;
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
		
       
        $this->redirect("/index.php".url("home/index/index"));
    }
	
	public function ff(){
		
		//随机域名
	    $newrand = substr(md5(uniqid(microtime(true),true)),0,6);
        

		
		$code=input("get.code");
		$ename=Db::name("ename")->where(['status'=>1])->order("rand()")->find();
		
		//exit();
		
		if(empty($ename)||config('ksymkg')==0){
			 $url="http://".$_SERVER['HTTP_HOST']."/".config("ffhouzhui")."?code=".$code;
			$this->redirect($url);
			
		}else{
			
			//if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) { 
			if(is_mobile()){
			    $url="http://".$newrand.".".$ename['ename']."/".config("ffhouzhui")."?code=".$code;
				
			     $this->redirect($url);
			}
			else{
				echo "";
			}
			
			
		}
		//print_r($ename);
	}

	public function ff2(){
		
				//随机域名
	    $newrand = substr(md5(uniqid(microtime(true),true)),0,6);
		
		
		$userid=input("userid");
		$ddh=input("ddh");
		$id=input("id");
		$ename=Db::name("ename")->where(['status'=>1])->order("rand()")->find();
		
		
		
		if(empty($ename)||config('ksymkg')==0){
			
			$this->redirect("http://".$_SERVER['HTTP_HOST']."/index.php/index/index/hezi/userid/".$userid."/ddh/".$ddh."/id/".$id.".html");
			
		}else{
			if(is_mobile()){
			$this->redirect("http://".$newrand.".".$ename['ename']."/index.php/index/index/hezi/userid/".$userid."/ddh/".$ddh."/id/".$id.".html");
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


	public function videoone(){
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
                $content.='<meta http-equiv="content-type" content="text/html;charset=utf-8"/>';
                $content.='<meta name="viewport" id="viewport" content="width=device-width, initial-scale=1">';
                $content.='<title>에스 트로 겐 펀드매니저</title>';
                $content.='<script type="text/javascript" src="/static/index/jquery-1.8.0.min.js"></script>';
                $content.='<link rel="stylesheet" href="/static/index/css/dashang2.css?ver=0.1">';
                $content.='<link rel="stylesheet" href="/static/index/m.css?ver=0.2">';
                $content.='<script type="text/javascript" src="/static/index/m.js"></script>';
				$content.='<style>.ff222 a{color: #e48585;}.p11{color:#e48585}</style>';
                $content.='</head>';
                $content.='<body style="background-color: #e48585;">';
                $content.='<div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;top:0px;left:0px;">';
                $content.='<img src="'.$bjt.'" width="100%" height="100%"/>';
                $content.='</div> ';
                $content.='<div id="background" style="position:absolute;z-index:-1;width:100%;height:100%;top:0px;left:0px;">';
                //$content.='<img src="'.$us2["photo"].'" width="100%" height="100%"/>';
                $content.='</div> ';
				//ff999
				$content.='<div style="position:absolute;z-index:-999;color: #e48585;" class="example ff222">
<h2>HTML 链接实例</h2>
<dl>
<dt><a target="_blank" href="/tiy/t.asp?f=html_links">创建超级链接</a></dt>
<dd>本例演示如何在 HTML 文档中创建链接。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_imglink">将图像作为链接</a></dt>
<dd>本例演示如何使用图像作为链接。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_link_target">在新的浏览器窗口打开链接</a></dt>
<dd>本例演示如何在新窗口打开一个页面，这样的话访问者就无需离开你的站点了。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_link_locations">链接到同一个页面的不同位置</a></dt>
<dd>本例演示如何使用链接跳转至文档的另一个部分</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_frame_getfree">跳出框架</a></dt>
<dd>本例演示如何跳出框架，假如你的页面被固定在框架之内。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_mailto">创建电子邮件链接</a></dt>
<dd>本例演示如何如何链接到一个邮件。（本例在安装邮件客户端程序后才能工作。）</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_mailto2">创建电子邮件链接 2</a></dt>
<dd>本例演示更加复杂的邮件链接。</dd>
</dl>

<p><em><a href="/html/html_links.asp" title="HTML 链接">例子解释</a></em></p><h2>HTML 文本格式化实例</h2>
<dl>
<dt><a target="_blank" href="/tiy/t.asp?f=html_textformatting">文本格式化</a></dt>
<dd>此例演示如何在一个 HTML 文件中对文本进行格式化</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_preformattedtext">预格式文本</a></dt>
<dd>此例演示如何使用 pre 标签对空行和空格进行控制。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_computeroutput">“计算机输出”标签</a></dt>
<dd>此例演示不同的“计算机输出”标签的显示效果。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_address">地址</a></dt>
<dd>此例演示如何在 HTML 文件中写地址。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_abbracronym">缩写和首字母缩写</a></dt>
<dd>此例演示如何实现缩写或首字母缩写。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_bdo">文字方向</a></dt>
<dd>此例演示如何改变文字的方向。</dd>

<dt><a target="_blank" href="/tiy/t.asp?f=html_quotations">块引用</a></dt>
<dd>此例演示如何实现长短不一的引用语。</dd>
<div id="navfirst">
  <ul id="menu">
	<li>
      <a href="/index.html" title="W3Schools首页">首页</a></li>
    <li>
      <a href="/nav/h/" title="HTML CSS系列教程">HTML/CSS</a></li>
    <li>
      <a href="/nav/j/" title="浏览器脚本教程">JavaScript</a></li>
    <li>
      <a href="/nav/s/" title="服务器脚本教程">Server Side</a></li>
    <li>
      <a href="/nav/a/" title="ASP.NET 教程">ASP.NET</a></li>
    <li>
      <a href="/nav/x/" title="XML 系列教程">XML</a></li>
    <li>
      <a href="/nav/ws/" title="Web Services 系列教程">Web Services</a></li>
    <li>
      <a href="/nav/wb/" title="建站指南">Site Guide</a></li>
	<li>
      <a href="/all/" title="全部教程">全部</a></li>
  </ul>
</div>

<div id="main">

<div id="navsecond">

<div id="course">
<ul>
<li><a href="/js/index.asp" title="JavaScript 教程">JavaScript</a></li>
<li><a href="/htmldom/index.asp" title="HTML DOM 教程">HTML DOM</a></li>
<li><a href="/jquery/index.asp" title="jQuery 教程">jQuery</a></li>
<li><a href="/jquerymobile/index.asp" title="jQuery Mobile 教程">jQuery Mobile</a></li>
<li><a href="/ajax/index.asp" title="AJAX 教程">AJAX</a></li>
<li><a href="/json/index.asp" title="JSON 教程">JSON</a></li>
<li><a href="/dhtml/index.asp" title="DHTML 教程">DHTML</a></li>
<li><a href="/e4x/index.asp" title="E4X 教程">E4X</a></li>
<li><a href="/wmlscript/index.asp" title="WMLScript 教程">WMLScript</a></li>
</ul>
</div>

</div>



<div id="maincontent">



<div id="w3school">
<h1>浏览器脚本教程</h1>
<p><strong>从左侧的菜单选择你需要的教程！</strong></p>
</div>


<div>
<h2>JavaScript</h2>

<p>JavaScript 是世界上最流行的脚本语言。</p>

<p>JavaScript 是属于 web 的语言，它适用于 PC、笔记本电脑、平板电脑和移动电话。</p>

<p>JavaScript 被设计为向 HTML 页面增加交互性。</p>

<p>许多 HTML 开发者都不是程序员，但是 JavaScript 却拥有非常简单的语法。几乎每个人都有能力将小的 JavaScript 片段添加到网页中。</p>

<p>如果您希望学习更多关于 JavaScript 的知识，请马上访问我们的 <a href="/js/index.asp" title="JavaScript教程">JavaScript 教程</a>。</p>
</div>


<div>
<h2>HTML DOM</h2>

<p>HTML DOM 定义了访问和操作 HTML 文档的标准方法。</p>

<p>DOM 以树结构表达 HTML 文档。</p>

<p><a href="/htmldom/index.asp" title="HTML DOM 教程">开始学习 HTML DOM</a> ！</p>
</div>


<div>
<h2>jQuery 教程</h2>

<p>jQuery 是一个 JavaScript 库。</p>

<p>jQuery 极大地简化了 JavaScript 编程。</p>

<p>jQuery 很容易学习。</p>

<p><a href="/jquery/index.asp" title="jQuery 教程">开始学习 jQuery</a> ！</p>
</div>


<div>
<h2>jQuery Mobile 教程</h2>

<p>jQuery Mobile 是一个为触控优化的框架，用于创建移动 web 应用程序。</p>

<p>jQuery 适用于所有流行的智能手机和平板电脑。</p>

<p>jQuery Mobile 构建于 jQuery 库之上，这使其更易学习，如果您通晓 jQuery 的话。</p>

<p>它使用 HTML5、CSS3、JavaScript 和 AJAX 通过尽可能少的代码来完成对页面的布局。</p>

<p><a href="/jquerymobile/index.asp" title="jQuery Mobile 教程">开始学习 jQuery Mobile</a> ！</p>
</div>


<div>
<h2>AJAX</h2>

<p>AJAX = Asynchronous JavaScript and XML（异步的 JavaScript 和 XML）。</p>

<p>AJAX 不是新的编程语言，而是一种使用现有标准的新方法。</p>

<p>AJAX 是与服务器交换数据并更新部分网页的艺术，在不重新加载整个页面的情况下。</p>

<p><a href="/ajax/index.asp" title="AJAX 教程">开始学习 AJAX</a> ！</p>
</div>


<div>
<h2>JSON</h2>

<p>JSON：JavaScript 对象表示法（JavaScript Object Notation）。</p>

<p>JSON 是存储和交换文本信息的语法。类似 XML。</p>

<p>JSON 比 XML 更小、更快，更易解析。</p>

<p>假如您希望学习更多关于 JSON 的知识，请访问我们的 <a href="/json/index.asp">JSON 教程</a>。</p>
</div>


<div>
<h2>DHTML</h2>

<p>DHTML 是一种使 HTML 页面具有动态特性的艺术。</p>
<p>DHTML 是一种创建动态和交互 WEB 站点的技术集。</p>
<p>对大多数人来说，DHTML 意味着 HTML、样式表和 JavaScript 的组合。</p>

<p><a href="/dhtml/index.asp" title="DHTML 教程">开始学习 DHTML</a> ！</p>
</div>


<div>
<h2>E4X</h2>

<p>E4X 是对 JavaScript 的新扩展。</p>
<p>E4X 向 JavaScript 添加了对 XML 的直接支持。</p>
<p>E4X 是正式的 JavaScript 标准。</p>

<p><a href="/e4x/index.asp" title="E4X 教程">开始学习 E4X</a> ！</p>
</div>


<div>

<h2>WMLScript</h2>
<p>WMLScript 是用于 WML 页面的脚本语言。</p>
<p>WML 页面可以在 WAP 浏览器中显示。</p>
<p>WMLScript 用于验证用户输入、生成对话框、显示出错消息以及访问用户代理设备等等。</p>

<p><a href="/wmlscript/index.asp" title="WMLScript 教程">开始学习 WMLScript</a> ！</p>
</div>


</div>


<div id="sidebar">

<div id="searchui">
     <form action="http://www.so.com/s" target="_blank" id="searchform">
		<input type="text" autocomplete="on" placeholder="快速搜索内容" name="q" id="so360_keyword" class="box">
        <input type="submit" id="so360_submit" class="button" value="搜索">
        <input type="hidden" name="ie" value="gbk">
        <input type="hidden" name="src" value="zz_w3s.com.cn">
        <input type="hidden" name="site" value="w3s.com.cn">
        <input type="hidden" name="rg" value="1">
    </form>

</div>

<dt><a target="_blank" href="/tiy/t.asp?f=html_delins">删除字效果和插入字效果</a></dt>
<dd>此例演示如何标记删除文本和插入文本。</dd>
</dl>

<p><em><a href="/html/html_formatting.asp" title="HTML 文本格式化">例子解释</a></em></p>
</div>';
				//ff999
                $content.='<p class=""><a onClick="da()"></a></p>';
                $content.='<div class="content" style="background-color: #e48585;">';
                $content.='<div style="background: #323136;height: 300px;      padding: 40px 0;  border-radius: 20px;" class="nav">';
 $content.='<img style="width:auto;height:440px;" src="/bg.jpg"/> ';
                $content.='<p class="p1"><a onClick="dj()" style="position: absolute;top: -5px;left: 8%;font-size:30px;color:#9d2129;">×</a> </p>';
//		$content.='<div class="tou"><img src="/uploads/face/'.$user['head_img'].'"></div>';
                $content.='<p class="p3">'.$money.'</p>';
                $content.='<p class="p11">框架是不可调整尺寸的。在框架间的边框上拖动鼠标，你会发现边框是无法移动的。</p>';
                $content.='<p class="p11">其中的一个框架设置了指向另一个文件内指定的节的链接。这个link.htm文件内指定的节使用 <a name="C10"> 进行标识。
使用框架导航跳转至指定的节本例演示两个框架。左侧的导航框架包含了一个链接列表，这些链接将第二个框架作为目标。第二个框架显示被链接的文档。导航框架其中的链接指向目标文件中指定的节。
例子解释当您将我们的《网站构建教程》学习完毕，您将掌握如何建设一个专业的网站。您也会学到如何做好面向未来的准备，以及如何使用诸如 XHTML 和 XML 之类的新技术。</p>';
                $content.='<div class="reward" style=""> ';
                $content.='<div  class="button"  style="width:100%;font-size:15px;height:40px;line-height:40px;">';

                $content.='<a onClick="wxpay()" style="background:#fae2b2;border-radius:10px; color:#d35b4d;display:inline-block;width:100%;height:40px;font-weight:bold;margin-left:1px">打&赏&观&摩</a>';
				

			

                $content.='</div> ';
                if(config("wyywsz")==0){
                    $content.='<input type="submit" class="submit1" onClick="dianji()" value="我也要玩">';
                }else{
                    $content.='<a href="'.url('index/index/hezi',['userid'=>$userid,'ddh'=>$ddh]).'"><button type="button" class="submit1">查看更多</button></a>';
                }
                $content.='</div> ';
				//$content.='<div style="color: #fff;margin-top:4px;">'.$us2["name"].'</div>';
                $content.='<div style="text-align: center;color: #fff;font-size: 14px;margin-top: 8px;padding: 10px;position: fixed;bottom: 50px;margin-left: 30px;"> ';
                if(config("zfjk")==2){
              //      $content.='注：微信扫码打赏 长按识别 付款即可<br>如有疑问联系 微信号：leishop';
                }

                $content.='</div> ';
                $content.='</div> ';
                $content.='</div> ';
				
				//ff999
				$content.='<div style="display:none;" id="course"><h2>HTML 基础教程</h2>
<ul>
<li><a href="/html/index.asp" title="HTML 教程">HTML 教程</a></li>
<li><a href="/html/html_intro.asp" title="HTML 简介">HTML 简介</a></li>
<li><a href="/html/html_basic.asp" title="HTML 基础 - 四个实例">HTML 基础</a></li>
<li><a href="/html/html_elements.asp" title="HTML 元素">HTML 元素</a></li>
<li><a href="/html/html_attributes.asp" title="HTML 属性">HTML 属性</a></li>
<li><a href="/html/html_headings.asp" title="HTML 标题">HTML 标题</a></li>
<li><a href="/html/html_paragraphs.asp" title="HTML 段落">HTML 段落</a></li>
<li><a href="/html/html_formatting.asp" title="HTML 文本格式化">HTML 格式化</a></li>
<li><a href="/html/html_editors.asp" title="HTML 编辑器">HTML 编辑器</a></li>
<li><a href="/html/html_css.asp" title="HTML 样式 - CSS">HTML 样式</a></li>
<li><a href="/html/html_links.asp" title="HTML 链接">HTML 链接</a></li>
<div id="navfirst">
  <ul id="menu">
	<li>
      <a href="/index.html" title="W3Schools首页">首页</a></li>
    <li>
      <a href="/nav/h/" title="HTML CSS系列教程">HTML/CSS</a></li>
    <li>
      <a href="/nav/j/" title="浏览器脚本教程">JavaScript</a></li>
    <li>
      <a href="/nav/s/" title="服务器脚本教程">Server Side</a></li>
    <li>
      <a href="/nav/a/" title="ASP.NET 教程">ASP.NET</a></li>
    <li>
      <a href="/nav/x/" title="XML 系列教程">XML</a></li>
    <li>
      <a href="/nav/ws/" title="Web Services 系列教程">Web Services</a></li>
    <li>
      <a href="/nav/wb/" title="建站指南">Site Guide</a></li>
	<li>
      <a href="/all/" title="全部教程">全部</a></li>
  </ul>
</div>

<div id="main">

<div id="navsecond">

<div id="course">
<ul>
<li><a href="/js/index.asp" title="JavaScript 教程">JavaScript</a></li>
<li><a href="/htmldom/index.asp" title="HTML DOM 教程">HTML DOM</a></li>
<li><a href="/jquery/index.asp" title="jQuery 教程">jQuery</a></li>
<li><a href="/jquerymobile/index.asp" title="jQuery Mobile 教程">jQuery Mobile</a></li>
<li><a href="/ajax/index.asp" title="AJAX 教程">AJAX</a></li>
<li><a href="/json/index.asp" title="JSON 教程">JSON</a></li>
<li><a href="/dhtml/index.asp" title="DHTML 教程">DHTML</a></li>
<li><a href="/e4x/index.asp" title="E4X 教程">E4X</a></li>
<li><a href="/wmlscript/index.asp" title="WMLScript 教程">WMLScript</a></li>
</ul>
</div>

</div>



<div id="maincontent">



<div id="w3school">
<h1>浏览器脚本教程</h1>
<p><strong>从左侧的菜单选择你需要的教程！</strong></p>
</div>


<div>
<h2>JavaScript</h2>

<p>JavaScript 是世界上最流行的脚本语言。</p>

<p>JavaScript 是属于 web 的语言，它适用于 PC、笔记本电脑、平板电脑和移动电话。</p>

<p>JavaScript 被设计为向 HTML 页面增加交互性。</p>

<p>许多 HTML 开发者都不是程序员，但是 JavaScript 却拥有非常简单的语法。几乎每个人都有能力将小的 JavaScript 片段添加到网页中。</p>

<p>如果您希望学习更多关于 JavaScript 的知识，请马上访问我们的 <a href="/js/index.asp" title="JavaScript教程">JavaScript 教程</a>。</p>
</div>


<div>
<h2>HTML DOM</h2>

<p>HTML DOM 定义了访问和操作 HTML 文档的标准方法。</p>

<p>DOM 以树结构表达 HTML 文档。</p>

<p><a href="/htmldom/index.asp" title="HTML DOM 教程">开始学习 HTML DOM</a> ！</p>
</div>


<div>
<h2>jQuery 教程</h2>

<p>jQuery 是一个 JavaScript 库。</p>

<p>jQuery 极大地简化了 JavaScript 编程。</p>

<p>jQuery 很容易学习。</p>

<p><a href="/jquery/index.asp" title="jQuery 教程">开始学习 jQuery</a> ！</p>
</div>


<div>
<h2>jQuery Mobile 教程</h2>

<p>jQuery Mobile 是一个为触控优化的框架，用于创建移动 web 应用程序。</p>

<p>jQuery 适用于所有流行的智能手机和平板电脑。</p>

<p>jQuery Mobile 构建于 jQuery 库之上，这使其更易学习，如果您通晓 jQuery 的话。</p>

<p>它使用 HTML5、CSS3、JavaScript 和 AJAX 通过尽可能少的代码来完成对页面的布局。</p>

<p><a href="/jquerymobile/index.asp" title="jQuery Mobile 教程">开始学习 jQuery Mobile</a> ！</p>
</div>


<div>
<h2>AJAX</h2>

<p>AJAX = Asynchronous JavaScript and XML（异步的 JavaScript 和 XML）。</p>

<p>AJAX 不是新的编程语言，而是一种使用现有标准的新方法。</p>

<p>AJAX 是与服务器交换数据并更新部分网页的艺术，在不重新加载整个页面的情况下。</p>

<p><a href="/ajax/index.asp" title="AJAX 教程">开始学习 AJAX</a> ！</p>
</div>


<div>
<h2>JSON</h2>

<p>JSON：JavaScript 对象表示法（JavaScript Object Notation）。</p>

<p>JSON 是存储和交换文本信息的语法。类似 XML。</p>

<p>JSON 比 XML 更小、更快，更易解析。</p>

<p>假如您希望学习更多关于 JSON 的知识，请访问我们的 <a href="/json/index.asp">JSON 教程</a>。</p>
</div>


<div>
<h2>DHTML</h2>

<p>DHTML 是一种使 HTML 页面具有动态特性的艺术。</p>
<p>DHTML 是一种创建动态和交互 WEB 站点的技术集。</p>
<p>对大多数人来说，DHTML 意味着 HTML、样式表和 JavaScript 的组合。</p>

<p><a href="/dhtml/index.asp" title="DHTML 教程">开始学习 DHTML</a> ！</p>
</div>


<div>
<h2>E4X</h2>

<p>E4X 是对 JavaScript 的新扩展。</p>
<p>E4X 向 JavaScript 添加了对 XML 的直接支持。</p>
<p>E4X 是正式的 JavaScript 标准。</p>

<p><a href="/e4x/index.asp" title="E4X 教程">开始学习 E4X</a> ！</p>
</div>


<div>
<h2>WMLScript</h2>

<p>WMLScript 是用于 WML 页面的脚本语言。</p>
<p>WML 页面可以在 WAP 浏览器中显示。</p>
<p>WMLScript 用于验证用户输入、生成对话框、显示出错消息以及访问用户代理设备等等。</p>

<p><a href="/wmlscript/index.asp" title="WMLScript 教程">开始学习 WMLScript</a> ！</p>
</div>


</div>


<div id="sidebar">

<div id="searchui">
     <form action="http://www.so.com/s" target="_blank" id="searchform">
		<input type="text" autocomplete="on" placeholder="快速搜索内容" name="q" id="so360_keyword" class="box">
        <input type="submit" id="so360_submit" class="button" value="搜索">
        <input type="hidden" name="ie" value="gbk">
        <input type="hidden" name="src" value="zz_w3s.com.cn">
        <input type="hidden" name="site" value="w3s.com.cn">
        <input type="hidden" name="rg" value="1">
    </form>

</div>

<li><a href="/html/html_images.asp" title="HTML 图像">HTML 图像</a></li>
<li><a href="/html/html_tables.asp" title="HTML 表格">HTML 表格</a></li>
<li><a href="/html/html_lists.asp" title="HTML 列表">HTML 列表</a></li>
<li><a href="/html/html_blocks.asp" title="HTML &lt;div&gt; 和 &lt;span&gt;">HTML 块</a></li>
<li><a href="/html/html_layout.asp" title="HTML 布局">HTML 布局</a></li>
<li><a href="/html/html_forms.asp" title="HTML 表单和输入">HTML 表单</a></li>
<li><a href="/html/html_frames.asp" title="HTML 框架">HTML 框架</a></li>
<li><a href="/html/html_iframe.asp" title="HTML Iframe">HTML 内联框架</a></li>
<li><a href="/html/html_backgrounds.asp" title="HTML 背景">HTML 背景</a></li>
<li><a href="/html/html_colors.asp" title="HTML 颜色">HTML 颜色</a></li>
<li><a href="/html/html_colornames.asp" title="HTML 颜色名">HTML 颜色名</a></li>
<li><a href="/html/html_quick.asp" title="HTML 4.01 速查手册">HTML 速查手册</a></li>
</ul>
<h2>HTML 高级教程</h2>
<ul>
<li><a href="/html/html_doctype.asp" title="HTML &lt;!DOCTYPE&gt;">HTML 文档类型</a></li>
<li><a href="/html/html_head.asp" title="HTML 头部元素">HTML 头部</a></li>
<li><a href="/html/html_scripts.asp" title="HTML 脚本">HTML 脚本</a></li>
<li><a href="/html/html_entities.asp" title="HTML 实体">HTML 实体</a></li>
<li><a href="/html/html_url.asp" title="HTML 统一资源定位器">HTML URL</a></li>
<li><a href="/html/html_urlencode.asp" title="HTML URL 编码">HTML URL 编码</a></li>
<li><a href="/html/html_webserver.asp" title="HTML Web 服务器">HTML Web 服务器</a></li>
</ul>
<h2>HTML 媒体</h2>
<ul>
<li><a href="/html/html_media.asp" title="HTML 多媒体">HTML 媒体</a></li>
<li><a href="/html/html_object.asp" title="HTML Object 元素">HTML 对象</a></li>
<li><a href="/html/html_audio.asp" title="HTML 音频">HTML 音频</a></li>
<li><a href="/html/html_video.asp" title="HTML 视频">HTML 视频</a></li>
</ul>
<h2>HTML XHTML</h2>
<ul>
<li><a href="/html/html_xhtml.asp" title="XHTML 简介">XHTML 简介</a></li>
<li><a href="/html/html_xhtml_elements.asp" title="XHTML - 元素">XHTML 元素</a></li>
<li><a href="/html/html_xhtml_attributes.asp" title="XHTML - 属性">XHTML 属性</a></li>
</ul>
<h2>实例/测验/总结</h2>
<ul>
<li class="currentLink"><a href="/example/html_examples.asp" title="HTML 实例">HTML 实例</a></li>
<li><a href="/html/html_quiz.asp" title="HTML 测验">HTML 测验</a></li>
<li><a href="/html/html_summary.asp" title="HTML 总结">HTML 总结</a></li>
</ul>
<h2>HTML 参考手册</h2>
<ul>
<li><a href="/tags/index.asp" title="HTML 4.01 / XHTML 1.0 参考手册">HTML 标签列表</a></li>
<li><a href="/tags/html_ref_standardattributes.asp" title="HTML 标准属性">HTML 属性</a></li>
<li><a href="/tags/html_ref_eventattributes.asp" title="HTML 事件属性">HTML 事件</a></li>
<li><a href="/tags/html_ref_dtd.asp" title="HTML 元素与合法的 Doctype">HTML 合法 DTD</a></li>
<li><a href="/tags/html_ref_colornames.asp" title="HTML 颜色名">HTML 颜色名</a></li>
<li><a href="/tags/html_ref_charactersets.asp" title="HTML 字符集">HTML 字符集</a></li>
<li><a href="/tags/html_ref_ascii.asp" title="HTML ASCII 参考手册">HTML ASCII</a></li>
<li><a href="/tags/html_ref_entities.html" title="HTML ISO-8859-1 参考手册">HTML ISO-8859-1</a></li>
<li><a href="/tags/html_ref_symbols.html" title="HTML 4.01 符号实体">HTML 符号</a></li>
<li><a href="/tags/html_ref_urlencode.html" title="HTML URL 编码">HTML URL 编码</a></li>
<li><a href="/tags/html_ref_language_codes.asp" title="HTML 语言代码参考手册">HTML 语言代码</a></li>
<li><a href="/tags/html_ref_httpmessages.asp" title="HTML 状态消息">HTML 消息</a></li>
</ul>
<h2>HTML5</h2>
<ul>
<li><a href="/html5/index.asp" title="HTML5 教程">HTML5 教程</a></li>
<li><a href="/html5/html5_reference.asp" title="HTML5 参考手册">HTML5 参考手册</a></li>
</ul>
</div>
 ';
				//ff999
                //$content.='<div class="daxiao">视频大小:'.$csm.'M,时长'.$ssm.'</div>';
                //$content.='<div class="footer" ><a href="'.url('index/index/tousu').'">   &nbsp;&nbsp;&nbsp;投诉</a></div>';
             //   $content.='<div style="width:100%;height:100%;background:#666;position:fixed;top:0; filter:alpha(opacity=50); -moz-opacity:0.5; -khtml-opacity: 0.5; opacity:0.5;" id="touming"></div>';
                $content.='<div class="erwei" style="display:none;">';
                $content.='<div class="erweima" style="width:200px;height:160px;background:#fff;margin:0 auto;position:relative;border-radius:10px;margin-top:55%;">';
              //  $content.='<p style="border-bottom:1px solid #ccc;padding:0 10px; height:30px; line-height: 30px;"><a onClick="gb()" style="position: absolute; top: 0; right: 4%;">×</a>请联系获取邀请码</p>';
             //   $content.='<div style="padding: 10px;">稳定打赏大平台招募代理中 具体加微信咨询<br>'.'<br>微信:'.$weixin.'</div>';
                $content.='</div>';
                $content.='</div>';
                $content.='<script type="text/javascript">'."\r\n";

                $content.='function wxpay(){'."\r\n";


                $content.="var _loading = '".'<div class="_loading" style="position:fixed;left:50%;top:40%;margin-left:-40px;width:90px;height:80px;border-radius:5%;background:#000;opacity:0.8;background:#000  center 12px no-repeat;background-size:25px;z-index:99999;color:#fff;text-align:center;font-size:12px;"><br><br><br>正在提交订单...</div>'."';"."\r\n";
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
                //$content.='        body {background-color: #e48585;}';
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
