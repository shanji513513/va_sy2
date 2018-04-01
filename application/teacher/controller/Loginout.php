<?php
namespace app\teacher\controller;


use think\Controller;

class Loginout extends Controller{
    public function loginout(){
        session('tdata',null);
        session('classite',null);

        $this->redirect(url('login/login'));
    }
}