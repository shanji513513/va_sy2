<?php
namespace app\cheif\controller;
use think\Db;
class Deletclass extends Base{
    public function index(){
        $data=input('get.');
        $id=$data['id'];
        Db::table('Teacher')->where('id',$id)->delete();
        Db::table('Student')->where('t_id',$id)->delete();
    }
}