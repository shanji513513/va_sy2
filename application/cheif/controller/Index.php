<?php
namespace app\cheif\controller;

use app\common\model\Student;
use app\common\model\Teacher;
use think\Controller;
use think\Db;

class Index extends Base
{
    public function index()
    {
        $tea=new Teacher();

        $va=Db::table('Vacate')->join('Cheif','Vacate.chid=Cheif.id','RIGHT')->join('Teacher','Vacate.tid=Teacher.id')->where('Vacate.status',2)->select();
       $class= $tea->where('id',7)->select();

       return $this->fetch('',[
           'vadata'=>$va,
           'class'=>$class
       ]);
    }
}
