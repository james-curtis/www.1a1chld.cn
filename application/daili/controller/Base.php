<?php

namespace app\daili\controller;
use app\daili\model\Nodedl;
use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
		
        if(!session('dailiuid')||!session('dailiname')){
            $this->redirect(url('login/index'));
        }
       
        
        $auth = new \com\Auth2();   
        $module     = strtolower(request()->module());
        $controller = strtolower(request()->controller());
        $action     = strtolower(request()->action());
        $url        = $module."/".$controller."/".$action;
		
        //跳过检测以及主页权限
      
            if(!in_array($url, ['daili/index/index','daili/index/indexpage'])){
                if(!$auth->check($url,session('dailiuid'))){
                    $this->error('抱歉，您没有操作权限');
                }
            }
      
        $node = new Nodedl();
        $this->assign([
            'username' => session('dailiname'),
            'portrait' => session('dlportrait'),
            'rolename' => session('dlrolename'),
            'menu' => $node->getMenu(session('dlrule'))
        ]);
      
        $config = cache('db_config_data');

        if(!$config){            
            $config = api('Config/lists');                          
            cache('db_config_data',$config); 
        }
        config($config); 

        if(config('web_site_close') == 0 && session('uid') !=1 ){
            $this->error('站点已经关闭，请稍后访问~');
        }

        if(config('admin_allow_ip') && session('uid') !=1 ){
           
            if(in_array(request()->ip(),explode(',',config('admin_allow_ip')))){
                return $this->fetch('/Public/404');
            }
        }
		
		if(is_mobile()){
			 $this->assign('ismobile', 1);
		}else{
			$this->assign('ismobile', 0);
		}
		
    }
	
	public function _empty($name)
    {
        return $this->fetch('/Public/404');
    }

	
	
}