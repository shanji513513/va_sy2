<?php
namespace app\index\controller;
use app\common\model\Student;
use think\Controller;

class Base extends Controller{


    public function _initialize()
    {
        $isLogin=$this->isLogin();
        $stbe=$this->isbe();
        if (!$stbe){
            session(null);
            return $this->redirect(url('login/login'));
        }

        if (!$isLogin){

            return $this->redirect(url('login/login'));
        }

    }

    public function isLogin(){
        $set=session('stdata','');
        if ($set){
            return true;
        }else{
            return false;
        }
    }

    public function isbe(){
        $st=new Student();
        $stbe=$st->where('id',session('stdata')['id'])->find();
        if ($stbe){
            return true;
        }else
        {
            return false;
        }
    }



//    public function getLoginUser() {
//        if(!$this->account) {
//            $this->account = session('chdata', '');
//        }
//        return $this->account;
//    }

}