<?php
namespace app\admin\controller;
use think\Controller;
use app\common\model\Cheif;
use app\common\validate\BaseValidate;


class Index extends Base{
    public function index(){

        $cheif=new Cheif();
        $id=session('addata')['id'];
        $ch=$cheif->where('adid',$id)->select();

        
        return $this->fetch('',[
            'ch'=>$ch ,
            'ad'=>session('addata'),
        ]);
    }
    public function add(){
       $ch=new Cheif();
        $data=input('post.');
        $data['code'] = mt_rand(100, 10000);

        $validatea = new BaseValidate();

        if($validatea->scene('addch')->check($data)) {


            if ($ch->login($data)) {
                $this->error('此账号已经注册');
            }else{
                $ch=new  Cheif();
                $data['pwd'] = md5($data['pwd'].$data['code']);
                $data['adid']=session('addata')['id'];
                
                $ch->save($data);
                $this->success('成功添加');
            }
        }else{
            $this->error($validatea->getError());
        }
    }
}