<?php
namespace app\superadmin\controller;
use think\Controller;
use app\common\model\Cheif;
use app\common\validate\BaseValidate;
use app\common\model\Superadmin;
use app\common\model\Admin;

class Index extends Controller{
    public function index(){
        $admin=new  Admin();
        $ad=$admin->select();
        return $this->fetch('',[
            'ad'=>$ad,
        ]);
    }
    public function add(){
       $ch=new Admin();
        $data=input('post.');
        $data['code'] = mt_rand(100, 10000);

        $validatea = new BaseValidate();

        if($validatea->scene('addch')->check($data)) {


            if ($ch->login($data)) {
                $this->error('此账号已经注册');

            }else{
                $ch=new Admin();
                $data['pwd'] = md5($data['pwd'].$data['code']);
                $ch->save($data);
                $this->success('成功添加');
            }
        }else{
            $this->error($validatea->getError());
        }
    }
}