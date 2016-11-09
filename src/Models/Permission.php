<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    protected $fillable = [
        'name', 'title', 'description',
    ];
    public function users()
    {
        return $this->hasManyThrough('App\User','LaravelRoles\Roleman\Models\Role');
    }
    public function roles()
    {
        return $this->belongsToMany('LaravelRoles\Roleman\Models\Role');
    }
}
