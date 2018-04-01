<?php
namespace app\cheif\controller;
use app\common\model\Cheif;
use app\common\validate\BaseValidate;
use think\Controller;

class Inform extends Base{
    public function index(){

        $che=new Cheif();
        $data=$che->where('zhanghao',session('chdata')->zhanghao)->find();

        return $this->fetch('',['data'=>$data]);
    }
    public function edt(){

        $ch=new  Cheif();

        $data=input('post.');

        $validate=new BaseValidate();
        if ( !$validate->scene('cedt')->check($data)){
//            dump($validate);exit();
            $this->error($validate->getError());
        }else{

            $data['code'] = mt_rand(100, 10000);
            $data['pwd'] = md5($data['pwd'].$data['code']);

            $ch->updateByzhanghao($data,$data['zhanghao']);
            $this->success('修改成功',url('index/index'));

        }
    }
}