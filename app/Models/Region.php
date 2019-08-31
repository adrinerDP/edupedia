<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function offices()
    {
        return $this->hasMany('App\Models\Office');
    }
}
