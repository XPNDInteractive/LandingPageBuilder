<?php

namespace App;

use Illuminate\Database\Eloquent\Model as ParentModel;

class Model extends ParentModel
{
  

    public function getMakeIdAttribute($value){
        return Make::where('id', $value)->first()->name;
    }
}
