<?php
namespace app\index\controller;

use app\common\model\Student;
use app\common\model\Teacher;
use QRcode;
use think\Controller;
use think\Db;


class Sjiaotiao extends Controller
{

    public function sjiaotiao()
    {

        $stu = new Student();
        $isva = $stu->where('id', session('stdata')['id'])->find();

        if ($isva['is_va']) {
            $this->erweima(url('stuinform'), 4);
            //生成二维码图片
        }
        return $this->fetch('');
    }

    //二维码方法
    public function erweima($url, $size = 4)
    {
        $url1 = 'zz.cn' . $url;
        vendor('Phpqrcode.phpqrcode');
        ob_end_clean();
        QRcode::png($url1, false, QR_ECLEVEL_L, $size, 2, false, 0xFFFFFF, 0x000000);

    }

    public function erweima1($url)
    {
        vendor('phpqrcode.phpqrcode');

        $value = $url;                  //二维码内容

        $errorCorrectionLevel = 'L';    //容错级别
        $matrixPointSize = 5;           //生成图片大小

        //生成二维码图片
        $filename = '/public/image/recode/' . microtime() . '.png';
        $qr = new \QRcode();
        ob_end_clean();
        //输入二维码
        $qr::png($value, false, $errorCorrectionLevel, $matrixPointSize, 2);

        $QR = $filename;                //已经生成的原始二维码图片文件
        $QR = imagecreatefromstring(file_get_contents($QR));

        //输出图片
        imagepng($QR, 'qrcode.png');
        imagedestroy($QR);
        return '<img src="qrcode.png" alt="使用微信扫描支付">';
    }


    public function stuinform()
    {
        $stu = Db::table('Student')->where('id', session('stdata')['id'])->find();
        $max = Db::table('Vacate')->where('stid', session('stdata')['id'])->max('id');
        $va = Db::table('Vacate')->where('id', $max)->find();
        return $this->fetch('', [
            'stu' => $stu,
            'va' => $va,
        ]);
    }
}