<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function schools()
    {
        return $this->hasMany('App\Models\School');
    }
}
