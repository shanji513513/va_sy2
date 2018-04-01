<?php
namespace app\common\model;
class Teacher extends BaseModel{
    public function student(){
        return $this->hasMany('Student','t_id','id');
    }
    public function cheif(){
        return $this->belongsTo('Cheif','ch_id','id');
    }
}