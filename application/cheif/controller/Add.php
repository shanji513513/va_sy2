<?php
namespace app\cheif\controller;
use app\common\validate\BaseValidate;
use think\Controller;
use think\Db;
use think\Session;
use app\common\model\Teacher;

class Add extends Base{
    public function index(){
        $classdata=Db::table('Teacher')->where('ch_id',session('chdata')['id'])->select();

        return $this->fetch('',[
            'class'=>$classdata,
            'chdata'=>session('chdata'),
            'zhuanye'=>Session::get('chdata.zhuanye')

        ]);

    }
public function add(){
    $data=input('post.');
    $teacher=new Teacher();
    $data['code'] = mt_rand(100, 10000);

    $validatea = new BaseValidate();

    if($validatea->scene('addch')->check($data)) {

        if ($teacher->login($data)){
            $this->error('此账号已经注册或账号无效',url('Add/index'),3);
        }else{

            $teacher=new  Teacher();
            $data['pwd'] = md5($data['pwd'].$data['code']);
            $data['ch_id']=session('chdata')['id'];

            $teacher->save($data);
            $this->success('成功添加班级',url('index/index'),3);

        }
    }else{
        $this->error($validatea->getError());

    }

}

}