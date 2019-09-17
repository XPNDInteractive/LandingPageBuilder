<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function stylesheets(){
        return $this->belongsToMany(Stylesheet::class, 'layout_stylesheet');
    }

    public function scripts(){
        return $this->belongsToMany(Scripts::class, 'layout_script');
    }

    public function sections(){
        return $this->belongsToMany(Sections::class, 'layout_section');
    }
}
