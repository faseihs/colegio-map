<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $guarded=[];
    public function student(){
        return $this->belongsTo('App\Model\Student');
    }
}
