<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['uuid', 'name', 'email', 'password'];
    protected $hidden = ['password'];
    protected $casts = ['email_verified_at' => 'datetime'];

    public function careers()
    {
        return $this->hasMany('App\Models\Career');
    }

    public function creative_activities()
    {
        return $this->hasMany('App\Models\CreativeActivity');
    }

    public function course_activities()
    {
        return $this->hasMany('App\Models\CourseActivity');
    }
}
