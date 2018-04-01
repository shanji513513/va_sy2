<?php
namespace app\api\controller;
use think\Controller;
use think\Request;
use think\Image;
use think\File;

//use think\File;


class Imageload extends Controller
{


    public function upload()
        {
            $file = Request::instance()->file('file');//file是传文件的名称，这是webloader插件固定写入的。因为webloader插件会写入一个隐藏input，不信你们可以通过浏览器检查页面
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            print_r($info);

            if($info && $info->getPathname()) {

//                echo json(['data'=>$info])->getcontent();
              //  return show(1, 'success','/'.$info->getPathname());
            }

           // return show(0,'upload error');
        }
public function uploadimg(Request $request){

    $file = $request->file('image');
   $zhanghao=input('post.')['zhanghao'];
    if(true !== $this->validate(['image'=>$file],['image'=>'require|image'])){
        $this->error('请选择图像文件');
    }else{


        
        $image = Image::open($file);
        $image->thumb(100,100,Image::THUMB_CENTER);
        //创建的目录名称，日期(绝对项目目录。用于数据库保存)
  //   $dirName = "public".DS."uploads".DS.(date('Ymd'));

//        $dirName = "public/uploads/".(date('Ymd'));
//改良通过用户名修改文件名
       $dirName = "public/uploads/".$zhanghao;

        //绝对路径 连接符为 \
    //    $dirName = ROOT_PATH . 'public'.DS."uploads".DS.(date('Ymd'));
       // $saveDir1= 'public'.DS."uploads".DS.(date('Ymd'));

        //创建保存目录（绝对路径。用于保存文件）
         $saveDir = ROOT_PATH.$dirName;
        if (!file_exists($saveDir)){
            mkdir($saveDir);
        }
//       $saveName = $request->time().'.jpg';
//        定义文件名为账号名
        $saveName = $request->$zhanghao.'.jpg';
        //存储本地
        $image->save($saveDir.'/'.$saveName);

        //学生数据头像存储
//        $data['photo']=$dirName.DS.$saveName;
        $data['photo']=$dirName.'/'.$saveName;

        $st=new \app\common\model\Student();

        $st->updateByzhanghao($data,$zhanghao);
        
        $this->success('图像处理完毕...');
    }
}

}
   
