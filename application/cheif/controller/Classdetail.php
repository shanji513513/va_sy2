<?php
namespace app\cheif\controller;
use think\Db;

class Classdetail extends Base{
    
    public function classdetail(){
        $data=input('get.');
        $stu=Db::table('Student')->where('t_id',$data['id'])->select();
//        dump($stu);
//        dump($data);
          return  $this->fetch('',[
                'stu'=>$stu
            ]);
    }
}