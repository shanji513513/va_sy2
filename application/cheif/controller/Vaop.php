<?php
namespace app\cheif\controller;
use app\common\model\Student;
use app\common\model\Vacate;
use think\Controller;
use think\Db;

class Vaop extends Controller{
    public function agree(){
        $data=input('post.');
        $va=new  Vacate();
        //把学生表的是否请假改成1（请假）
        $stu_isva['is_va']=1;
        Db::table('Student')->where('id',$data['id'])->update($stu_isva);



        $maxid=$va->where('stid',$data['id'])->max('id');
        $data1['status']=6;
        $data1['isva']=1;
        $data1['chre']=$data['chre'];
        $va->where('stid',$data['id'])->where('id',$maxid)->update($data1);
        $this->success('');




    }
    public function disagree(){

        $data=input('post.');
        $va=new  Vacate();
        $stu_isva['is_va']=1;
        Db::table('Student')->where('id',$data['id'])->update($stu_isva);

        $maxid=$va->where('stid',$data['id'])->max('id');
        $data1['status']=5;
        $data1['isva']=0;

        $data1['chre']=$data['chre'];

        $va->where('stid',$data['id'])->where('id',$maxid)->update($data1);
        $this->success('');

    }
}