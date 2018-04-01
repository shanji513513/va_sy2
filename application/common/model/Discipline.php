<?php
namespace app\common\model;
class Discipline extends BaseModel{
    public function classite(){
        return $this->belongsTo('Classite','reid','id');
    }
}