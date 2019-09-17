<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public function stylesheets(){
        return $this->belongsToMany(Stylesheet::class, 'layout_stylesheet');
    }

    public function scripts(){
        return $this->belongsToMany(Script::class, 'layout_script');
    }

    public function assets(){
        return $this->belongsToMany(Asset::class, 'layout_asset');
    }

    public function sections(){
        return $this->belongsToMany(Sections::class, 'layout_section');
    }
}
