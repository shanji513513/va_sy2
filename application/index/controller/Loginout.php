<?php
namespace app\Index\controller;
use think\Controller;

class Loginout extends Controller{
public function loginout(){
    session(null);
    // 跳出
    $this->redirect('login/login');
}
}