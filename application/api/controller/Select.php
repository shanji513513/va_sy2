<?php
namespace app\api\controller;
use app\common\model\Student;
use app\common\model\Teacher;
use think\Controller;
use think\Request;
use think\Db;

class Select extends Controller{
    public function deleteMovie()
    {
        $chid=session('chdata')['id'];

        $movieId = Request::instance()->post('movieId');
        $class=new Teacher();
        $classid=$class->where('class',$movieId)->find();
        $stu=new Student();
        $sushe=$stu->where('t_id',$classid['id'])->field('sushe')->select();

        //return ['id'=>$sushe];

        if ($movieId ==null) {

                $sushe=$stu->where('chid',$chid)->field('sushe')->select();
                return ['data' =>$sushe, 'status' => 509];

        } elseif ($movieId and $movieId!='*') {
            return ['data' =>$sushe, 'status' => 509];

        }else{
            return ['data' => '获取数据失败！', 'status' => 200];
        }
    }
    public function deleteMovie1()
    {

//传过来的值为   专业值
        $movieId = Request::instance()->post('movieId');
        $class=new Teacher();
        $classid=$class->where('zhuanye',$movieId)->field('class')->select();
 //       return $movieId;
//        $stu=new Student();
//        $sushe=$stu->where('t_id',$classid['id'])->field('sushe')->select();

        //return ['id'=>$sushe];

     if ($movieId ) {
            $classid=$class->where('zhuanye',$movieId)->field('class')->select();

            return ['data' =>$classid, 'status' => 509];

        }else{
            return ['data' => '获取数据失败！', 'status' => 200];
        }
    }

}