<?php

namespace App\RolesPermission\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'name','slug','description'
    ];

    public function roles(){
        return $this->belongsToMany('App\RolesPermission\Models\Role')->withTimestamps();
    }
}
