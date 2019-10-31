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
}
