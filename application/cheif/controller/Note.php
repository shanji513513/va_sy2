<?php
namespace app\cheif\controller;
use app\common\model\Assite;
use app\common\model\Cheif;
use think\Controller;

class Note extends Controller{
    public function index(){
        $ass=new Assite();
        $data=$ass->where('chid',session('chdata')['id'])->select();
        return $this->fetch('',
        [
            "chid"=>session('chdata')['id'],
            "data"=>$data
        ]
            );
    }
    public function add(){
        $data=input("post.");
        $ass=new Assite();
        $ass->save($data);
       $this->success('辅助人员添加成功');
    }

}