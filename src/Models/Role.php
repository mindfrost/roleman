<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;


class Role extends Model
{
    //
    use \LaravelRoles\Roleman\Traits\AttributeCache;
    protected $fillable = [
        'name', 'title', 'description',
    ];
    protected $remember=['parent_permissions'];
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

            $hasParent=($this->parent_permissions)?$this->parent_permissions->where('id',$permission)->first():0;
        }else
        {
            $has=$this->permissions()->where('name',$permission)->first();
            $hasParent=($this->parent_permissions)?$this->parent_permissions->where('name',$permission)->first():0;
        }

        return ($has?true:false)||($hasParent?true:false);
    }
    public function hasRole($Role)
    {
//        var_dump(1);
        if(gettype ($Role)=="integer")
        {
            $has=$this->roles()->where('id',$Role)->first();
        }else
        {
            $has=$this->roles()->where('name',$Role)->first();
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
    public function attachRole($Role=null)
    {
        if(!$Role)
        {
            return false;
        }
        if(!$this->hasRole(intval($Role)))
        {
            $this->roles()->attach($Role);
        }

    }
    public function detachRole($Role=null)
    {
        if(!$Role)
        {
            return false;
        }
        $this->roles()->detach($Role);
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function permissions()
    {
        return $this->belongsToMany('LaravelRoles\Roleman\Models\Permission');
    }
    public function roles(){
        return $this->belongsToMany('LaravelRoles\Roleman\Models\Role','role_role','role_id','parent_role_id')
            ->wherePivot('parent_role_id','<>',$this->id);
//            ->where('parent_role_id',"!=",$this->id);
    }
    public function allRoles(){
//      $s=  $this->roles()->withPivot(['parent_role_id']);

        return $this->roles()->with('allRoles');
    }
    public function getparentPermissionsAttribute()
    {
        $perms=collect([]);
        $parents=$this->roles()->with('permissions')->get();
        foreach($parents as $parent)
        {

            $parent_=$parent->permissions->groupBy(function ($item, $key) {
                return $item['id'];
            })->map(function($item){return $item[0];});

            if(!$perms->count())
            {
                $perms=$parent_;
            }else{

            }
            if($parent_){
                $perms= $perms->merge($parent_);

            }
            if( (!$parent->hasRole($this->id)&&$parent->parent_permissions)){
                //!$parent->hasRole($this->id) - важно для избежания неуправляемой рекурсии при зацикливании ролей
                $perms= $perms->merge($parent->parent_permissions);
            }


        }
        return $perms;
    }
    public function getallPermissionsAttribute()
    {
        $perms=$this->permissions;
        $parents=$this->roles()->with('permissions')->get();
        foreach($parents as $parent)
        {
            $parent_=$parent->permissions->groupBy(function ($item, $key) {
                return $item['id'];
            })->map(function($item){return $item[0];});

            if(!$perms)
            {
                $perms=$parent_;
            }else{

            }
            if($parent_){
                $perms= $perms->merge($parent_);

            }
            if( ($parent->parent_permissions)){
                $perms= $perms->merge($parent->parent_permissions);
            }


        }
        return $perms;
    }
}
