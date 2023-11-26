<?php
namespace app\dsadmin\controller;
use app\dsadmin\model\TypeModel;
use think\Db;
class Type extends Base
{


    public function index(){
        $Nowpage = input('get.page') ? input('get.page'):1;
        $limits = 10;// ��ȡ������
        $count = Db::name('type')->count();//������ҳ��
        $allpage = intval(ceil($count / $limits));
        $lists = Db::name('type')->page($Nowpage, $limits)->order('id desc')->select();
        $this->assign('Nowpage', $Nowpage); //��ǰҳ
        $this->assign('allpage', $allpage); //��ҳ��
        $this->assign('count', $count); 
        if(input('get.page')){
            return json($lists);
        }
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isAjax()){

            $param = input('post.');
            $gongyou = new TypeModel();
            $flag = $gongyou->insertGongyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        return $this->fetch();
    }

    public function edit()
    {
        $gongyou = new TypeModel();
        if(request()->isAjax()){
            $param = input('post.');         
            $flag = $gongyou->updateGongyou($param);
            return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
        }
        $id = input('param.id');
        $this->assign('gongyou',$gongyou->getOneGongyou($id));
        return $this->fetch();
    }



    public function del()
    {
        $id = input('param.id');
        $cate = new TypeModel();
        $flag = $cate->delGongyou($id);
        return json(['code' => $flag['code'], 'data' => $flag['data'], 'msg' => $flag['msg']]);
    }
}