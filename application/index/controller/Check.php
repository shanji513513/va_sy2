<?php
namespace app\index\controller;

use app\common\model\Student;
use app\common\model\Vacate;

use think\Controller;
use think\Request;
use think\Db;

class Check extends Base{
    public function check()
    {
        if(request()->isPost()) {
            // 登录的逻辑
            //获取相关的数据
            $data = input('post.');
            // 通过用户名 获取 用户相关信息
            // 严格的判定

            $ret = model('Student')->get(['zhanghao'=>$data['zhanghao']]);

            if(!$ret ) {
                $this->error('改用户不存在');
            }

            if($ret->password != md5($data['password'].$ret->code)) {
                $this->error('密码不正确');
            }

            model('BisAccount')->updateById(['last_login_time'=>time()], $ret->id);
            // 保存用户信息  bis是作用域
            session('bisAccount', $ret, 'bis');
            return $this->success('登录成功', url('index/index'));


        }else {
            // 获取session
            $account = session('bisAccount', '', 'bis');
            if($account && $account->id) {
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }

    }
    //请假提交接收
    public function addva(){

        $data=input('post.');

       $validate=new \app\common\validate\BaseValidate();
        if (!$validate->scene('vadetail')->check($data)){

           $this->error($validate->getError());
        }else{
            $stu=new Student();
            $vacate=new Vacate();
            $maxid=$vacate->where('stid',session('stdata')['id'])->max('id');
            $vastatus=$vacate->where('id',$maxid)->find();
            if ($vastatus['status'] !=0 and $vastatus['status'] !=4 and  $vastatus['status']!=6 and $vastatus['status']!=7 and $vastatus['status']!=8){
                $this->error('你已经有申请正在等待批复，请耐心等待');
            }elseif ($vastatus['status'] ==4 and  $vastatus['status']==6){
                //4为时间不到一天而且不过下午10点 班主任直接同意 6 为科长批假
                    $this->error('你已经处于请假中');
                }
            //为零（无请假状态）切不为 null  
            if ($vastatus['status']==0 and !is_null($vastatus['status'])){
                $data['status'] = 1;
                $data['tid']=session('stdata')['t_id'];
                $data['chid']=session('stdata')['chid'];
                
//                $stid=$stu->where('id',session('stdata')['id'])->find();
                $data['stid']=session('stdata')['id'];
                // $vacate->save($data);
                $vacate->where('id',$maxid)->where('status',0)->update($data);
                $this->success('1申请成功，请等待！！！');
                //状态为空 或者为7（自然结束请假）
            }else{
            $data['status'] = 1;
            $data['tid'] = session('stdata')['t_id'];
            $data['chid'] = session('stdata')['chid'];
            $data['stid'] = session('stdata')['id'];
            $vacate = new Vacate();
            $vacate->insert($data);
            $this->success('0申请成功，请等待！！！');
        }
        }
    //dump($data);
    }
    public function disva(){
//        echo 1111111111;
//        echo session('vadata')['zhanghao'] ;
        $vacate=new  Vacate();
       // $student=new  Student();
//        $stdata=$student->where('zhanghao',session('stdata')['zhanghao'])->find();

        $maxid=$vacate->where('stid',session('stdata')['id'])->max('id');
     //   $vadata['status']=0;


    $vadata=$vacate->where('id',$maxid)->find();
        //如果请假状态为申请或等待审批过程中
        if ($vadata['isva']=0){
            $vadata1['isva']=0;
            //8为自动取消假期
            $vadata1['status']=0;

            $vadata->save($vadata1);
        }else{
            $va=new  Vacate();
            //把学生表的是否请假改成0（无假假）
            $stu_isva['is_va']=0;
            Db::table('Student')->where('id',session('stdata')['id'])->update($stu_isva);
            $vadata1['isva']=0;
            //8为自动取消假期
            $vadata1['status']=8;

            $vadata->save($vadata1);

            $this->success('取消成功');


        }

;


    }
    public function vasu(){

        echo session('vadata')['zhanghao'] ;
        $vacate=new  Vacate();
        $student=new  Student();
        $stdata=$student->where('zhanghao',session('stdata')['zhanghao'])->find();
        $maxid=$vacate->where('stid',session('stdata')['id'])->max('id');
        $data['status']=4;

        $vadata=$vacate->where('id',$maxid)->find()->save($data);

//        $vadata['status']=0;
//        $vacate->save($vadata);
        $this->success('取消成功');


    }
}