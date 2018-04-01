<?php
namespace app\cheif\controller;
use app\common\model\Cheif;
use think\Controller;
class Base extends  Controller
{
    public $account;
    public function _initialize() {
        $stbe=$this->isbe();
        if (!$stbe){
            session(null);

            return $this->redirect(url('login/login'));

        }
        // 判定用户是否登录
        $isLogin = $this->isLogin();
        if(!$isLogin) {
            return $this->redirect(url('login/login'));
        }
    }

    //判定是否登录
    public function isLogin() {
        // 获取sesssion
        $user = $this->getLoginUser();
        if($user && $user->id) {
            return true;
        }
        return false;

    }

    public function getLoginUser() {
        if(!$this->account) {
            $this->account = session('chdata', '');
        }
        return $this->account;
    }
    public function isbe(){
        $tea=new Cheif();
        $teabe=$tea->where('id',session('chdata')['id'])->find();
        if ($teabe){
            return true;
        }else
        {
            return false;
        }
    }

}
