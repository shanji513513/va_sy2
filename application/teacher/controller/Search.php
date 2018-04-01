<?php
namespace app\teacher\controller;
use app\common\model\Discipline;
use app\common\model\Teacher;
use think\Controller;
use app\common\model\Student;
use think\Db;

class Search extends Base{
    public function index(){
        $select=input('post.');
        $select1=$this->arr($select);
//        $stu=Db::table('Vacate')->join('Student','Vacate.stid=Student.id')->join('Teacher','Vacate.tid=Teacher.id')->where($select1)->select();
        $stu=Db::table('Teacher')->join('Student','Teacher.id=Student.t_id')->where('class',session('tdata')['class'])->where($select1)->select();
//
//dump($stu);
//        dump($select1);
       // $class=Db::table('Vacate')->join('Student','Vacate.stid=Student.id')->where('tid',session('tdata')['id'])->select();
        $class=Db::table('Student')->where('t_id',session('tdata')['id'])->field('sushe')->select();

        return $this->fetch('',[
            'sushe'=>$class,
            'stu'=>$stu,
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
        $data=input('get.');

        $stu=new Student();

        $studata=$stu->where('id',$data['id'])->find();
        $discipline=new Discipline();
//        $dis=$discipline->where('stid',$data['id'])->select();
        $dis=$discipline->with('classite')->where('stid',$data['id'])->select();

//        dump($dis);
        return $this->fetch('',[
            'stu'=>$studata,
            'dis'=>$dis
        ]);


    }
}