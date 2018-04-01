<?php
namespace app\common\model;
use think\Model;

class BaseModel extends Model{


    public  function login($data){
        if ($this->where('zhanghao',$data['zhanghao'])->find()){
            return true;
        }else{
            return false;
        }
    }
    public function add($data) {
        $data['status'] = 0;
        $this->save($data);
        return $this->id;
    }

    public function updateById($data, $id) {
        return $this->allowField(true)->save($data, ['id'=>$id]);
    }
    public function updateByzhanghao($data, $zhanghao) {
        return $this->allowField(true)->save($data, ['zhanghao'=>$zhanghao]);
    }
    public function show($data){
      return  $this->where('zhanghao',$data['zhanghao'])->select();
    }

    public function getdatabyId($dataId) {
        $data = [
            'id' => $dataId,

        ];

        $result = $this->where($data)

            ->find();
        return $result;
    }

    public function getId($ids) {
        $data = [
            'id' => ['in', $ids],
            'status' => 1,
        ];
        return $this->where($data)
            ->select();
    }
    

}