<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    public function makes()
    {
        return $this->belongsToMany(Make::class, 'make_years');
    }
}
