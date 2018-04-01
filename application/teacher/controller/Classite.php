<?php
namespace app\teacher\controller;
use think\Controller;

class Classite extends Controller{
    public function index(){
        $ass=new \app\common\model\Classite();
        $data=$ass->where('tid',session('tdata')['id'])->select();
        return $this->fetch('',
            [
                "tid"=>session('tdata')['id'],
                "data"=>$data
            ]
        );

    }
    public function add(){
        $data=input("post.");
        $ass=new \app\common\model\Classite();
        $ass->save($data);
        $this->success('辅助人员添加成功');
    }
}