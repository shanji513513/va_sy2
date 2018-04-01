<?php
namespace app\teacher\controller;
use app\common\model\Teacher;
use app\common\validate\BaseValidate;
use think\Controller;

class Inform extends Base{
    public function index()
        
    {
        $data=new Teacher();
        $tdata=$data->getdatabyId(session('tdata')['id']);

        return $this->fetch('',[
            'tdata'=>$tdata
        ]);
    }
    public function edt(){

        $st=new  Teacher();

        $data=input('post.');

        $validate=new BaseValidate();
        if ( !$validate->scene('tedt')->check($data)){
//            dump($validate);exit();
            $this->error($validate->getError());
        }else{

                $data['code'] = mt_rand(100, 10000);
                $data['pwd'] = md5($data['pwd'].$data['code']);

                $st->updateByzhanghao($data,$data['zhanghao']);
                $this->success('修改成功');
          
            }
        }
}