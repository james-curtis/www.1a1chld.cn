<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\GongyouModel;
use think\Db;
class Gongyou extends Base
{


    public function index(){

        $key = input('key');
        $map = [];
        if($key&&$key!==""){
            $map['name'] = ['like',"%" . $key . "%"];           
        }
      	$typess=input('type');
        if($typess&&$typess!==""){
            $map['type'] = $typess;           
        }
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// 获取总条数
        $count = Db::name('gongyou')->where($map)->count();//计算总页面
        $allpage = intval(ceil($count / $limits));
        $gongyou = new GongyouModel();
        $lists = $gongyou->getGongyouByWhere($map, $Nowpage, $limits);
        $this->assign('Nowpage', $Nowpage); //当前页
        $this->assign('allpage', $allpage); //总页数
        $this->assign('count', $count); 
        $this->assign('val', $key);
        if(input('get.page')){
            return json($lists);
        }
		$type=db('type')->order('id desc')->select();
        $this->assign('type', $type);
        $this->assign('typess', $typess);
        return $this->fetch();
    }


    public function add()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $gongyou = new GongyouModel();
            $flag = $gongyou->insertGongyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
		$type=db('type')->order('id desc')->select();
        $this->assign('type', $type);
        return $this->fetch();
    }
	
	
	public function shangchuan()
    {
       
	    
        $newnamepath="uploads/shipin/".date("Ymd",time())."/".md5(time(). mt_rand(1,1000000));
         $this->assign('newnamepath', $newnamepath);
		$type=db('type')->order('id desc')->select();
        $this->assign('type', $type);
         return $this->fetch();
    }


    public function edit()
    {
        $gongyou = new GongyouModel();
        
        if(request()->isAjax()){

            $param = input('post.');         
            $flag = $gongyou->updateGongyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }

        $id = input('param.id');
       
        $this->assign('gongyou',$gongyou->getOneGongyou($id));
		$type=db('type')->order('id desc')->select();
        $this->assign('type', $type);
        return $this->fetch();
    }



    public function del()
    {
        $id = input('param.id');
        $cate = new GongyouModel();
        $flag = $cate->delGongyou($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }








  

}