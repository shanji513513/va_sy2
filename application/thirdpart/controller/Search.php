<?php
namespace app\thirdpart\controller;
use app\common\model\Teacher;
use think\Controller;
use think\Db;

class Search extends Controller{
    public function index(){

     $select=input('post.');
        $select1=$this->arr($select);



        $zhuanye=Db::table('Cheif')->field('zhuanye')->select();
        dump($zhuanye);
       //现在用的方法
    $stu=Db::table('Teacher')->join('Student','Teacher.id=Student.t_id')->where($select1)->select();

        //复杂的写法  筛选的数据重合  但可以借鉴  为其他项目提供检索
       // $stu=Db::table('Vacate')->join('Student','Vacate.stid=Student.id')->join('Teacher','Vacate.tid=Teacher.id')->where($select1)->select();
//        dump($select1);
//        dump($stu);
//        $tea=new Teacher();

//        $va=Db::table('Vacate')->join('Cheif','Vacate.chid=Cheif.id','RIGHT')->join('Teacher','Vacate.tid=Teacher.id')->where('Vacate.chid',session('chdata')['id'])->select();
//        $class=Db::table('Cheif')->join('Teacher','Cheif.id=Teacher.ch_id')->field('class')->select();
//        dump($class);

        return $this->fetch('',[
            'zhuanye'=>$zhuanye,
//            "data"=>$class,
  //          'chid'=>session('chdata')['id'],
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
}