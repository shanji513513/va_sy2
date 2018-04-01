<?php
namespace app\admin\controller;
use app\index\controller\cla;
use think\Controller;
use think\Db;

class Cheifdel extends Controller{
    public function index(){
        $data=input('get.');
        $id=$data['id'];
//        dump($id);exit();
        Db::table('Cheif')->where('id',$id)->delete();
        Db::table('Teacher')->where('ch_id',$id)->delete();
        Db::table('Student')->where('chid',$id)->delete();
      //  $ddd= Db::table('Teacher')->with('Student')->where('ch_id',$id)->delete();
      //  $ddd= Db::table('Teacher')->join('Student','Teacher.id=Student.t_id')->where('Student.chid',$id)->delete();
//        Db::table('Teacher')->where('chid',$id)->delete();
//        Db::table('Student')->where('t_id',$id)->delete();
        $this->success('删除成功');
    }
}