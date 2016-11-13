<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;


class Role extends Model
{
    //
    protected $fillable = [
        'name', 'title', 'description',
    ];
    public $validate_rules=[
        'name'=>'unique:roles'
    ];
    public $validate_rules_translit=[
        'name.unique'=>"Роль с таким именем уже существует"
    ];
    public function validate($arr){
        return \Validator::make($arr,$this->validate_rules,$this->validate_rules_translit);
    }
    public function hasPermission($permission)
    {
//        var_dump(1);
        if(gettype ($permission)=="integer")
        {
            $has=$this->permissions()->where('id',$permission)->first();
        }else
        {
            $has=$this->permissions()->where('name',$permission)->first();
        }

        return $has?true:false;
    }
    public function attachPermission($permission=null)
    {
        if(!$permission)
        {
            return false;
        }
        if(!$this->hasPermission(intval($permission)))
        {
            $this->permissions()->attach($permission);
        }

    }
    public function detachPermission($permission=null)
    {
        if(!$permission)
        {
            return false;
        }
        $this->permissions()->detach($permission);
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function permissions()
    {
        return $this->belongsToMany('LaravelRoles\Roleman\Models\Permission');
    }
}
