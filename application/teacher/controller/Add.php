<?php
namespace app\teacher\controller;

use app\common\model\Student;
use app\common\model\Teacher;
use app\common\validate\BaseValidate;
use think\Controller;

class Add extends Base{
    public function index(){
        $teacher=new Teacher();
        $list=$teacher->with('student')->where([
            'id'=>session('tdata')['id']

        ])->select();
       // dump($list);
        return $this->fetch('',[
            'list'=>$list,
            'ch'=>session('tdata')
        ]);
    }
    public function add(){
        $data=input('post.');
        $data['code'] = mt_rand(100, 10000);
        $validatea = new BaseValidate();

        if($validatea->scene('add')->check($data)) {

            $stu = new Student();
            if ($stu->login($data)) {
                $this->error('此账号已经注册');
            }else{
                $data['t_id']=session('tdata')['id'];
                $data['chid']=session('tdata')['ch_id'];

                $stu=new  Student();
                $data['pwd'] = md5($data['pwd'].$data['code']);
                $stu->save($data);
                $this->success('成功添加');
            }
        }else{
            $this->error($validatea->getError());
        }
    }
    public function edt(){
        $data=input('get.');

        $stu=new Student();

        $studata=$stu->where('id',$data['id'])->find();
        dump($studata);
        return $this->fetch('',[
            'stu'=>$studata
        ]);

    }
    public function edt1(){
        $data=input('post.');
        if ($data['pwd']==null){
            $this->error('密码必须填写');
        }
        $data['code'] = mt_rand(100, 10000);

        $data['t_id']=session('tdata')['id'];
        $data['chid']=session('tdata')['ch_id'];
        $stu=new  Student();
        $data['pwd'] = md5($data['pwd'].$data['code']);
        $stu->where('zhanghao',$data['zhanghao'])->update($data);


//        dump($data);
        $stu1=$stu->where('zhanghao',$data['zhanghao'])->update($data);
        $this->success('修改成功');
    }
    public function delet(){
        $data=input('get.');
        $stu=new Student();

        $stu->where('id',$data['id'])->delete();
        $this->success('删除成功');
    }
    public function lock(){
       $stid=input('get.');
        $st=new Student();
//dump($st->where('id',$stid['id'])->find());
        $da['ised']=1;
       $stdata= $st->where('id',$stid['id'])->update($da);
       $this->success('锁定成功');

    }
    public function dislock(){
        $stid=input('get.');
        $st=new Student();
//dump($st->where('id',$stid['id'])->find());
        $da['ised']=0;
        $stdata= $st->where('id',$stid['id'])->update($da);
        $this->success('取消锁定');

    }
    public function longva(){
        $stid=input('get.');
        $st=new Student();
//dump($st->where('id',$stid['id'])->find());
        $da['is_va']=2;
        $stdata= $st->where('id',$stid['id'])->update($da);
        $this->success('标记为长假');
    }
    public function dislongva(){
        $stid=input('get.');
        $st=new Student();
//dump($st->where('id',$stid['id'])->find());
        $da['is_va']=0;
        $stdata= $st->where('id',$stid['id'])->update($da);
        $this->success('取消长假标记');
    }

}