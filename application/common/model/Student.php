<?php
namespace app\common\model;
use think\Model;


class Student extends BaseModel{
    public function teacher(){
        return $this->belongsTo('Teacher','t_id','id');
    }
    
    public function vacate(){
        return $this->hasOne('Vacate','stid','id');
    }
    
}