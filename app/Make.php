<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    public function years()
    {
        return $this->belongsToMany(Year::class, 'make_years');
    }
}
