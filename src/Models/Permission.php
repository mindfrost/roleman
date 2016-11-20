<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    use \LaravelRoles\Roleman\Traits\AttributeCache;
    protected $fillable = [
        'name', 'title', 'description',
    ];
    public $validate_rules=[
        'name'=>'unique:permissions'
    ];
    public $validate_rules_translit=[
        'name.unique'=>"Разрешение с таким именем уже существует"
    ];
    public function validate($arr){
        return \Validator::make($arr,$this->validate_rules,$this->validate_rules_translit);
    }
    public function users()
    {
        return $this->hasManyThrough('App\User','LaravelRoles\Roleman\Models\Role');
    }
    public function roles()
    {
        return $this->belongsToMany('LaravelRoles\Roleman\Models\Role');
    }
    public function accessor(){
        return $this->belongsTo('LaravelRoles\Roleman\Models\Accessor');
    }
}
