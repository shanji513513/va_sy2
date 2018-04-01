<?php
namespace app\index\controller;
use think\Controller;
use app\common\validate\BaseValidate;
use think\Request;


class Login extends Controller{
    

    public function  login()
    {
        if (request()->isPost()) {
            // 登录的逻辑
            //获取相关的数据
            $data = input('post.');
            // 通过用户名 获取 用户相关信息
            // 严格的判定

            $ret = model('Student')->get(['zhanghao' => $data['zhanghao']]);

            if (!$ret) {
                $this->error('该用户不存在过');
            }


            if(!captcha_check($data['verifycode'])) {
                // 校验失败
                $this->error('验证码不正确');
            }
            
            if ($ret->pwd != md5($data['pwd'] . $ret->code)) {
                $this->error('密码不正确');
            }

//             model('BisAccount')->updateById(['last_login_time'=>time()], $ret->id);
            // 保存用户信息  bis是作用域
            session('stdata', $ret);
            $ses = session('stdata');
//            print_r($ses);
            return $this->success('登录成功', url('index/sindex'));


        } else {
            // 获取session
            $account = session('stdata');
            if ($account && $account->zhanghao) {
                return $this->redirect(url('index/sindex'));
            }
            return $this->fetch();
        }
    }
}