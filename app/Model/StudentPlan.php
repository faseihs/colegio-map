<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentPlan extends Model
{
    //

    protected $guarded=[];

    public function cost(){
        return $this->belongsTo('App\Model\Cost');
    }
}
