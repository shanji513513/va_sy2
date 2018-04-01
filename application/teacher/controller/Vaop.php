<?php
namespace app\teacher\controller;
use app\common\model\Student;
use app\common\model\Vacate;
use think\Controller;
use think\Db;

class Vaop extends Controller{
    public function agree(){
        $data=input('post.');
        $va=new  Vacate();
        //当前最新id
        $newid=$va->where('stid',$data['id'])->max('id');
        $vadata=$va->where('stid',$data['id'])->where('id',$newid)->find();
        $stime=strtotime($vadata->vastime);
        $sday=date('d',$stime);
        $etime=strtotime($vadata->vaetime);
        $eday=date('d',$etime);
        $ehou=date('h',$etime);

     
        //请假时间 为当天22时前 班主任直接批假
        if ($eday==$sday and $ehou<=22){
            $maxid=$va->where('stid',$data['id'])->max('id');
            $data1['status']=4;
            $data['isva']=1;
            $data1['tre']=$data['tre'];
            $va->where('stid',$data['id'])->where('id',$maxid)->update($data1);
            //把学生表的是否请假改成1（请假）
            $stu_isva['is_va']=1;
            Db::table('Student')->where('id',$data['id'])->update($stu_isva);
            $this->success('');
        }else{
            $data1['status']=2;
            $maxid=$va->where('stid',$data['id'])->max('id');

            $data1['tre']=$data['tre'];
//echo 1111111;
            $va->where('stid',$data['id'])->where('id',$maxid)->update($data1);
            $this->success('');
        }



    }
    public function disagree(){

        $data=input('post.');
        $va=new  Vacate();
//        $vadata=$va->where('stid',$data['id'])->find();
//       $data1['status']=3;
//       $data1['re']=$data['tre'];
//        $vadata->where('stid',$data['id'])->update($data1);

        $stu_isva['is_va']=0;
        Db::table('Student')->where('id',$data['id'])->update($stu_isva);

        $maxid=$va->where('stid',$data['id'])->max('id');
        $data1['status']=3;
        $data1['tre']=$data['tre'];
        $va->where('stid',$data['id'])->where('id',$maxid)->update($data1);
       // dump($vadata);
       $this->success('');

    }
}