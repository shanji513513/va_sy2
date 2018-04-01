<?php
namespace app\teacher\controller;

use app\common\model\Student;
use app\common\model\Vacate;
use think\Controller;
use app\common\model\Teacher;
use think\Db;

class Index extends Base
{
    public function index()
    {
//        $teacher=new  Teacher();
//       // $tdata=$teacher->with('student,student.vacate')->where('zhanghao',session('tdata')['zhanghao'])->where('vacate',???)->select();
//
//
//      $va=new Vacate();
//        $vadata=$va->where('tid',session('tdata')['id'])->where('status',1)->select();
//        $st=new Student();
        $st=Db::table('Student')->join('Vacate','Student.id=Vacate.stid','RIGHT')->where('Vacate.status',1)->select();
        dump($st);
        return  $this->fetch('',[
           'sdata'=>$st
        ]);
    }
}
