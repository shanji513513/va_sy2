<?php
namespace app\index\controller;

use think\Controller;

class Sinform extends Base{
    public function sinform(){
        $st=new  \app\common\model\Student();
        $data=$st->where('zhanghao',session('stdata')->zhanghao)->find();

        return $this->fetch('',['data'=>$data]);
    }
    public function edt(){
        $st=new  \app\common\model\Student();
        
        $data=input('post.');
        $validate=new \app\common\validate\BaseValidate();
        if ( !$validate->scene('stedt')->check($data)){
            $this->error($validate->getError());
        }else{
$ised=$st->where('zhanghao',$data['zhanghao'])->find();
            if ($ised['ised']==0){
                $data['code'] = mt_rand(100, 10000);
                $data['pwd'] = md5($data['pwd'].$data['code']);

            $st->updateByzhanghao($data,$data['zhanghao']);
            $this->success('修改成功');
            }else{
                echo  $ised['ised'];
                $this->error('如要修改请练习班主任');
            }
        }
       

        

    }
}