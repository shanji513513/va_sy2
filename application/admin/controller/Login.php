<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;

class Login extends Controller{
    public  function index(){



        
        return $this->fetch('');
    }
    public  function  login(){

        if (request()->isPost()) {
            // 登录的逻辑
            //获取相关的数据
            $data = input('post.');
            // 通过用户名 获取 用户相关信息
            // 严格的判定

            $ret = model('Admin')->get(['zhanghao' => $data['zhanghao']]);

            if (!$ret) {
                $this->error('该用户不存在过');
            }

            if ($ret->pwd != md5($data['pwd'] . $ret->code)) {
                $this->error('密码不正确');
            }

//             model('BisAccount')->updateById(['last_login_time'=>time()], $ret->id);
            // 保存用户信息  bis是作用域
            session('addata', $ret);
            $ses = session('addata');
//            print_r($ses);
            return $this->success('登录成功', url('index/index'));


        } else {
            // 获取session
            $account = session('addata');
            if ($account && $account->zhanghao) {
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
        
    }
}