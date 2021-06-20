<?php

namespace App\RolesPermission\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
      'name','slug','description','full-access'
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
