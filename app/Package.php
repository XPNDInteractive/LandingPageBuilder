<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function fields(){
        return $this->hasMany(PackageField::class, 'package_id');
    }
}
