<?php
namespace app\cheif\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\common\model\Teacher;


class Login extends Controller{
    public function index(){
        return $this->fetch();
    }
    public function  login(){
        if(request()->isPost()) {
            // 登录的逻辑
            //获取相关的数据
            $data = input('post.');
            // 通过用户名 获取 用户相关信息
            // 严格的判定

            $ret = model('Cheif')->get(['zhanghao'=>$data['zhanghao']]);

            if(!$ret  ) {
                $this->error('该用户不存在过');
            }

            if($ret->pwd != md5($data['pwd'].$ret->code)) {
                $this->error('密码不正确');
            }

//             model('BisAccount')->updateById(['last_login_time'=>time()], $ret->id);
            // 保存用户信息  bis是作用域
            session('chdata', $ret);
            $ses=session('chdata');
            return $this->success('登录成功', url('login/login'));


        }else {
            // 获取session
            $account = session('chdata');
            if($account && $account->zhanghao) {
                return $this->redirect(url('index/index'));
            }
            return $this->fetch();
        }
    }
    public function assite(){
        if (request()->isPost()){
            $data=input("post.");
            $ret = model('Assite')->get(['zhanghao'=>$data['zhanghao']]);
            if (!$ret){
                $this->error('用户不存在');

        }
            if ($ret->pwd!=$data['pwd']){
                $this->error('密码错误');
            }
            session('asdata',$ret);
            return $this->success('登陆成功',url('login/search'));
        }else{
            $account = session('asdata');
            if($account && $account->zhanghao) {
                return $this->redirect(url('login/search'));
            }
        }
        return $this->fetch('');
    }
public function search(){
    $select=input('post.');
    $select1=$this->arr($select);
    $stu=Db::table('Teacher')->join('Student','Teacher.id=Student.t_id')->where('chid',session('chdata')['id'])->where($select1)->select();

    //复杂的写法  筛选的数据重合  但可以借鉴  为其他项目提供检索
    // $stu=Db::table('Vacate')->join('Student','Vacate.stid=Student.id')->join('Teacher','Vacate.tid=Teacher.id')->where($select1)->select();
    $tea=new Teacher();
//        $va=Db::table('Vacate')->join('Cheif','Vacate.chid=Cheif.id','RIGHT')->join('Teacher','Vacate.tid=Teacher.id')->where('Vacate.chid',session('chdata')['id'])->select();
    $class=Db::table('Cheif')->join('Teacher','Cheif.id=Teacher.ch_id')->field('class')->select();
    dump($class);

    return $this->fetch('',[
        "data"=>$class,
        'chid'=>session('chdata')['id'],
        'stu'=>$stu,
    ]);

}
    function arr($ar)
    {
        $tmp = array();
        foreach($ar as $k =>$arc)
        {
            if($arc!=null)
            {
                $tmp[$k]=$arc;
            }
        }
        $ar = $tmp;
        unset($tmp);
        return $ar;
    }

}