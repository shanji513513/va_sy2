<?php
namespace app\index\validate;
use  think\Validate;
class BaseValidate extends Validate{
    protected  $rule = [
        ['zhanghao', 'require|max:1000', '分类名必须传递|分类名不能超过10个字符'],
        ['pwd','require|max:1000'],
        ['parent_id','number'],
        ['id', 'number'],
        ['status', 'number|in:-1,0,1','状态必须是数字|状态范围不合法'],
        ['listorder', 'number'],
        ['sushe','require']
    ];

    /**场景设置**/
    protected  $scene = [
        'login' => ['zhanghao', 'pwd'],// 添加
        'listorder' => ['id', 'listorder'], //排序
        'status' => ['id', 'status'],
    ];
}