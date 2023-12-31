<?php
namespace app\dsadmin\model;
use think\Model;
use think\Db;

class ConfigModel extends Model
{
    protected $name = 'config';

    // 开启自动写入时间戳
    protected $autoWriteTimestamp = true;

    /**
     * 根据条件获取配置列表信息
     */
    public function getAllConfig($map, $nowpage, $limits)
    {
        return $this->where($map)->page($nowpage, $limits)->select();
    }

    /**
     * 根据条件获取所有配置信息数量
     * @param $map
     */
    public function getAllCount($map)
    {
        return $this->where($map)->count();
    }

    /**
     * 插入信息
     * @param $param
     */
    public function insertConfig($param)
    {
        try{
            $result = $this->allowField(true)->save($param);
            if(false === $result){            
                return ['code' => -1, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '添加成功'];
            }
        }catch( PDOException $e){
            return ['code' => -2, 'data' => '', 'msg' => $e->getMessage()];
        }
    }

    /**
     * 编辑信息
     * @param $param
     */
    public function editConfig($param)
    {
        try{
            $result =  $this->allowField(true)->save($param, ['id' => $param['id']]);
            if(false === $result){            
                return ['code' => 0, 'data' => '', 'msg' => $this->getError()];
            }else{
                return ['code' => 1, 'data' => '', 'msg' => '编辑成功'];
            }
        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }


    /**
     * 根据id获取配置信息
     * @param $id
     */
    public function getOneConfig($id)
    {
        return $this->where('id', $id)->find();
    }


    /**
     * 删除配置
     * @param $id
     */
    public function delConfig($id)
    {
        try{

            $this->where('id', $id)->delete();
            return ['code' => 1, 'data' => '', 'msg' => '删除成功'];

        }catch( PDOException $e){
            return ['code' => 0, 'data' => '', 'msg' => $e->getMessage()];
        }
    }
}