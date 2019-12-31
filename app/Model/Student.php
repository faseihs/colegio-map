<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    //
    use SoftDeletes;

    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    protected $guarded=[];


    public function document(){
        return $this->hasOne('App\Model\Document');
    }

    public function contact(){
        return $this->hasOne('App\Model\Contact');
    }
    public function contacts(){
        return $this->hasMany('App\Model\Contact');
    }
    
    public function plans(){
        return $this->hasMany('App\Model\StudentPlan');
    }
    
    public function payments(){
        return $this->hasMany('App\Model\Payment');
    }
}
