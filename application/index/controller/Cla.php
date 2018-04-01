<?php
namespace app\index\controller;
use app\common\model\Student;
use app\common\model\Teacher;
use think\Controller;
use think\Request;
use think\model;

class cla extends Controller{
    public function index(){
        $data=input();
     $st=new Student();
        $te=new Teacher();
        $te1=$te->where('id',$data['tid'])->find();
        $st1=$st->where('t_id',$data['tid'])->select();
       $nu0= $st->where('is_va',0)->count();//没有请假
       $nu1= $st->where('is_va',1)->count();//短假
       $nu2= $st->where('is_va',2)->count();//长假
       $nub= $st->where('iswalk',1)->count();//走读
        $nua= $st->where('iswalk',0)->count();//住宿

       $nub1= $st->where('iswalk',1)->where('is_va',1)->count();//走读请加
       $nub2= $st->where('iswalk',1)->where('is_va',2)->count();//走读长假
       $nua1= $st->where('iswalk',0)->where('is_va',1)->count();//住宿请加
        $nua2=$st->where('iswalk',0)->where('is_va',2)->count();//住宿长假

        return$this->fetch('',[
            'st'=>$st1,//班级学生信息
            'te'=>$te1,//班级信息
            'nu0'=>$nu0,
            'nu1'=>$nu1,
            'nu2'=>$nu2,
            'nub'=>$nub,
            'nua'=>$nua,
            'nub1'=>$nub1,
            'nub2'=>$nub2,
            'nua1'=>$nua1,
            'nua2'=>$nua2,
        ]);
    }
    public function login(){
       
        return $this->fetch('');

}
    public function check(){
        if (request()->isPost()) {
            // 登录的逻辑
            //获取相关的数据
            $data = input('post.');
            // 通过用户名 获取 用户相关信息
            // 严格的判定

            $ret = model('Teacher')->where('zhanghao', $data['zhanghao'])->find();

            if (!$ret) {
                $this->error('该用户不存在过');
            }else{
                $this->redirect('index', ['tid' => $ret['id']]);

            }

        }
    }
}