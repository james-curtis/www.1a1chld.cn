<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class Nodedl extends Model
{

    protected $name = "dlauth_rule";


    /**
     * [getNodeInfo 获取节点数据]
     * @author [dashang]
     */
    public function getNodeInfo($id)
    {
        $result = $this->field('id,title,pid')->select();
        $str = "";
       
        $rule = $this->getRuleById($id);

        if(!empty($rule)){
            $rule = explode(',', $rule);
        }
        foreach($result as $key=>$vo){
            $str .= '{ "id": "' . $vo['id'] . '", "pId":"' . $vo['pid'] . '", "name":"' . $vo['title'].'"';

            if(!empty($rule) && in_array($vo['id'], $rule)){
                $str .= ' ,"checked":1';
            }

            $str .= '},';
        }

        return "[" . substr($str, 0, -1) . "]";
    }

    public function getRuleById($id)
    {
        $res =Db::name('dlauth_group')->field('rules')->where('id', $id)->find();
        return $res['rules'];
    }

    /**
     * [getMenu 根据节点数据获取对应的菜单]
     * @author [dashang]
     */
    public function getMenu($nodeStr = '')
    {
        //超级管理员没有节点数组
        $where = empty($nodeStr) ? 'status = 1' : 'status = 1 and id in('.$nodeStr.')';
        $result = Db::name('dlauth_rule')->where($where)->order('sort')->select();
        $menu = prepareMenu($result);
        return $menu;
    }
}