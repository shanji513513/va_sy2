<?php
namespace app\teacher\controller;
use app\index\controller\Base;
use think\Controller;
use app\common\model;
use think\Db;
use app\common\model\Discipline as Dis;

class Discipline extends Controller{
    public function index(){
        if (!session('classite')){
            $this->redirect(url('login/classite'));
        }
        $select=input('post.');
        $select1=$this->arr($select);
//        $stu=Db::table('Vacate')->join('Student','Vacate.stid=Student.id')->join('Teacher','Vacate.tid=Teacher.id')->where($select1)->select();
        $stu=Db::table('Teacher')->join('Student','Teacher.id=Student.t_id')->where('t_id',session('classite')['tid'])->where($select1)->select();
//
//dump($stu);
//        dump($select1);
        // $class=Db::table('Vacate')->join('Student','Vacate.stid=Student.id')->where('tid',session('tdata')['id'])->select();
        $class=Db::table('Student')->where('t_id',session('classite')['tid'])->field('sushe')->select();

        return $this->fetch('',[
            'sushe'=>$class,
            'stu'=>$stu,
            'reid'=>session('classite')['id'],
        ]);
    }

    //排除数组内为“”的值
    function arr($ar)
    {
        $tmp = array();
        foreach($ar as $k =>$arc)
        {
            if($arc!=null)
            {
                $tmp[$k]=$arc;
            }
        }
        $ar = $tmp;
        unset($tmp);
        return $ar;
    }
    public function edt(){
        if (!session('classite')){
            $this->redirect(url("Login/classite"),'权限已失效请重新登陆');
        }
        $data=input('post.');
        $data['etime']=time();
        $dis=new Dis();
        $dis->save($data);
        $this->success('记录成功');
    }
}