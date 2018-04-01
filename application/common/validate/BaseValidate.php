<?php
namespace app\common\validate;
use think\Validate;

class  BaseValidate extends Validate{
//    protected  $rule = [
//        ['zhanghao', 'require|max:1000|alphaNum', '分类名必须传递|分类名不能超过10个字符|字母或数字'],
//        ['pwd','require|max:1000','密码必须传递|分类名不能超过10个字符'],
//        ['parent_id','number','id必须数字'],
//        ['id', 'number','id必须数字'],
//        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法'],
//        ['listorder', 'number','id必须数字'],
//        ['sushe','require|max:2000','宿舍必须填写|宿舍字符20个长度'],
//        ['name','require|max:1000','姓名必须填写|宿舍字符10个长度'],
//        ['sex','require|max:20','性别必须填写|宿舍字符10个长度'],
//        ['phone','max:2000','电话字符10个长度'],
//        ['weixinname','max:2000','微信名字符10个长度'],
//          ['vadetail','require|max:10000','请假缘由必须填写|宿舍字符100个长度'],
//        ['vastime','require','开始时间必须填写'],
//        ['vaetime','require','结束时间必须填写'],
//        ['class','require|max:2000','班级必须填写|宿舍字符20个长度']
//
//
//    ];
    protected  $rule = [
        ['zhanghao', 'require|max:1000|alphaNum'],
        ['pwd','require|max:1000'],
        ['parent_id','number','id必须数字'],
        ['id', 'number','id必须数字'],
        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法'],
        ['listorder', 'number','id必须数字'],
        ['sushe','require|max:2000','宿舍必须填写|宿舍字符20个长度'],
        ['name','require|max:1000'],
        ['sex','require|max:20','性别必须填写|宿舍字符10个长度'],
        ['phone','max:2000'],
        ['weixinname','max:2000','微信名字符10个长度'],
        ['vadetail','require|max:10000','请假缘由必须填写|宿舍字符100个长度'],
        ['vastime','require','开始时间必须填写'],
        ['vaetime','require','结束时间必须填写'],
        ['class','require|max:2000'],
        ['zhuanye','require|max:2000'],
        ['verify', 'check_verify:thinkphp', '验证码错误']



    ];
    /**场景设置**/
    protected  $scene = [
        'login' => ['zhanghao', 'pwd'],// 添加
        'listorder' => ['id', 'listorder'], //排序
        'status' => ['id', 'status'],
        'add'=>['zhanghao','name','pwd','sex'],
        'addch'=>['zhanghao','pwd'],
        'stinform'=>['name','phone','weixinname','pwd'],
        'vadetail'=>['vadetail','vastime','vastime'],
        'tedt'=>['zhanghao','name','pwd','class','phone'],
        'cedt'=>['zhanghao','name','pwd','phone','zhuanye'],
'stedt'=>['phone','pwd'],
        'verify'=>['verify']
    ];
}