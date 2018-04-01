<?php
namespace app\admin\controller;
use app\common\model\Admin;
use think\Controller;
class Base extends  Controller
{
    public $account;
    public function _initialize() {
        $stbe=$this->isbe();
        if (!$stbe){
            session(null);

            $this->error('你已经被删除了或登陆信息失效','login/index');
        }
        // 判定用户是否登录
        $isLogin = $this->isLogin();
        if(!$isLogin) {
            return $this->redirect(url('login/index'));
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
            $this->account = session('addata', '');
        }
        return $this->account;
    }
    public function isbe(){
        $tea=new Admin();
        $teabe=$tea->where('id',session('addata')['id'])->find();
        if ($teabe){
            return true;
        }else
        {
            return false;
        }
    }

}
