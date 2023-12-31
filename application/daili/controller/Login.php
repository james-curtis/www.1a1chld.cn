<?php
namespace app\daili\controller;
use app\daili\model\UserType;
use think\Controller;
use think\Db;
use org\Verify;
use com\Geetestlib;

class Login extends Controller
{
    //登录页面
    public function index()
    {
		 $config = cache('db_config_data');
		if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config);
        }
        config($config); 

        if(config('web_site_close') == 0 ){
            $this->error('站点已经关闭，请稍后访问~');
        }
		
		if($_SERVER['SERVER_NAME']=="658166.vip"){
			return $this->fetch('/login');
		}else{echo "资源违规！！！已经删除！！！";}
		
        
    }

    //登录操作

   
  

    public function doLogin()
    {
        $username = input("post.username");
        $password = input("post.password");
		 $config = cache('db_config_data');
		if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config);
        }
        config($config); 
		if(config('web_site_close') == 0 ){
            $this->error('站点已经关闭，请稍后访问~');
        } 
		
        if (config('verify_type') == 1) {
            $code = input("param.code");
        }
        
        $result = $this->validate(compact('username', 'password'), 'AdminValidate');
        if(true !== $result){
            return json(['code' => -5, 'url' => '', 'msg' => $result]);
        }
        //$verify = new Verify();
        //if (config('verify_type') == 1) {
            //if (!$code) {
            //    return json(['code' => -4, 'url' => '', 'msg' => '请输入验证码']);
            //}
            //if (!$verify->check($code)) {
            //    return json(['code' => -4, 'url' => '', 'msg' => '验证码错误']);
         //   }
        //}

        $hasUser = Db::name('member')->where('account', $username)->find();
        if(empty($hasUser)){
            return json(['code' => -1, 'url' => '', 'msg' => '代理不存在']);
        }

        if($password != $hasUser['password']){
          
            return json(['code' => -2, 'url' => '', 'msg' => '账号或密码错误']);
        }

        if(1 != $hasUser['status']){
           
            return json(['code' => -6, 'url' => '', 'msg' => '该账号被禁用']);
        }

        if (config('verify_type') != 1) {

            $GtSdk = new Geetestlib(config('gee_id'), config('gee_key'));
            $user_id = session('user_id');
            if (session('gtserver') == 1) {
                $result = $GtSdk->success_validate(input('param.geetest_challenge'), input('param.geetest_validate'), input('param.geetest_seccode'), $user_id);
                //极验服务器状态正常的二次验证接口
                if (!$result) {     
                    $this->error('请先拖动验证码到相应位置');
                }
            }else{
                if (!$GtSdk->fail_validate(input('param.geetest_challenge'), input('param.geetest_validate'), input('param.geetest_seccode'))) {
                    //极验服务器状态宕机的二次验证接口
                    $this->error('请先拖动验证码到相应位置');
                }
            }

        }


        //获取该管理员的角色信息
        $user = new UserType();
        $info = $user->getRoleInfo(1);
        
        session('dailiuid', $hasUser['id']);         //用户ID
        session('dailiname', $hasUser['nickname']);  //用户名
        session('dlportrait', $hasUser['head_img']); //用户头像
        session('dlrolename', $info['title']);    //角色名
        session('dlrule', $info['rules']);        //角色节点
        session('dlname', $info['name']);         //角色权限
  
        //更新管理员状态
        $param = [
            'login_num' => $hasUser['login_num'] + 1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time()
        ];

        Db::name('member')->where('id', $hasUser['id'])->update($param);
        return json(['code' => 1, 'url' => url('index/index'), 'msg' => '登录成功！']);
    }

    //验证码
    public function checkVerify()
    {
        $verify = new Verify();
        $verify->imageH = 32;
        $verify->imageW = 100;
		$verify->codeSet = '0123456789';
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->fontSize = 14;
        return $verify->entry();
    }


    //极验验证
    public function getVerify(){
        $GtSdk = new Geetestlib(config('gee_id'), config('gee_key'));
        $user_id = "web";
        $status = $GtSdk->pre_process($user_id);
        session('gtserver',$status);
        session('user_id',$user_id);
        echo $GtSdk->get_response_str();
    }

	public function zhuce(){
		 $data = input("post.");
		  $config = cache('db_config_data');
		if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config);
        }
        config($config); 

        if(config('web_site_close') == 0  ){
            $this->error('站点已经关闭，请稍后访问~');
        }
		 if(config('user_allow_register')==0){
			 return json(['code' => 0, 'url' => '', 'msg' => "注册已关闭"]);
		 }
		 
		 $member=Db::name('member')->where('account', $data['account'])->find();
		 if(!empty($member)){
			 return json(['code' => 0, 'url' => '', 'msg' => '用户名已存在']);
		 }
		 
		 
		 $yqm=Db::name('yqm')->where(['yqm'=>$data['yqm'],"zt"=>'未使用'])->find();
		 if(empty($yqm)){
			return json(['code' => 0, 'url' => '', 'msg' => '邀请码不存在']); 
			 
		 }
		 
		 Db::name('yqm')->where('yqm', $data['yqm'])->update(['name'=>$data['account'],'zt'=>'已使用']);
		 
		 $param=[];
		 $param['account']=$data['account'];
		 $param['nickname']=$data['nickname'];
		 $param['head_img']="/static/admin/images/head_default.gif";
         $param['password']=$data['password'];
		 $param['create_time']=time();
		 $param['update_time']=time();
		 $param['status']=1;
		 $param['txfeilv']=config('yhtxfl');
		 $param['pid']=$yqm['userid']=="admin"?0:$yqm['userid'];
		 $param['syyqm']=$yqm['yqm'];
		 $userid=Db::name('member')->insertGetId($param);
		 
		  $user = new UserType();
		 $info = $user->getRoleInfo(1);
        
        session('dailiuid', $userid);         //用户ID
        session('dailiname', $param['nickname']);  //用户名
        session('dlportrait', $param['head_img']); //用户头像
        session('dlrolename', $info['title']);    //角色名
        session('dlrule', $info['rules']);        //角色节点
        session('dlname', $info['name']);         //角色权限
  
        //更新管理员状态
        $param = [
            'login_num' =>  1,
            'last_login_ip' => request()->ip(),
            'last_login_time' => time()
        ];

        Db::name('member')->where('id',$userid)->update($param);
		 
		 return json(['code' => 1, 'url' => url('index/index'), 'msg' => '注册成功！']); 
	}

    //退出操作
    public function loginOut()
    {
        session(null);
        cache('db_config_data',null);
        $this->redirect(url('index'));
    }
}