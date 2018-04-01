<?php
namespace app\index\controller;

use app\common\model\Chief;
use app\common\model\Student;
use app\common\model\Teacher;
use app\index\validate\BaseValidate;
use think\Controller;
use think\File;
use think\Request;
use app\common\model\Vacate;
use think\Db;

class Index extends Base
{
    //首页 即请假页面
    public function sindex()
    {
        $student=new  Student();
        $vacate=new  Vacate();
        //找出本账号学生id 在请假模型中 stid 最大的值  方便变找到 最新的可操作信息
        $maxid=$vacate->where('stid',session('stdata')['id'])->max('id');
        $vadata=$vacate->where('id',$maxid)->find();
        //如果请假的最后时间小于当下现在时间 说明请假过期
        if (strtotime($vadata['vaetime'])<time()){
            //把学生表的是否请假改成0（无假）
            $stu_isva['is_va']=0;
            //学生表是否请假 is_va 更新成0 （物价状态）
            Db::table('Student')->where('id',session('stdata')['id'])->update($stu_isva);

            $data1['status']=7;
            $data1['isva']=0;
            //此变量去上边变量重合  可以测试是否可以删除
//            $maxid=$vacate->where('stid',session('stdata')['id'])->max('id');
            //更新假期数据表中的信息
            $vacate->where('stid',session('stdata')['id'])->where('id',$maxid)->update($data1);
        }
        $stdata=$student->where('zhanghao',session('stdata')['zhanghao'])->find();
//        $maxid=$vacate->where('stid',session('stdata')['id'])->max('id');
//        $vadata=$vacate->where('id',$maxid)->find();
        return $this->fetch('',[
            'vadata'=>$vadata,
            'stdata'=>$stdata
        ]);
    }
}
