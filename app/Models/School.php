<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function office()
    {
        return $this->belongsTo('App\Models\Office');
    }
}
