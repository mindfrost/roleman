<?php
namespace LaravelRoles\Roleman\Traits;
use LaravelRoles\Roleman\Models;
trait User
{
    use \LaravelRoles\Roleman\Traits\AttributeCache;
    public function manyThroughMany($related, $through, $firstKey, $secondKey, $pivotKey)
    {
        $model = new $related;
        $table = $model->getTable();
        $throughModel = new $through;
        $pivot = $throughModel->getTable();
//        return $this->belongsToMany($through)
//
//            ->join('permission_role',"roles.id","=","permission_role.role_id")
//
//            ->join('permissions',"permission_id","=","permissions.id")
//
//            ->select('permissions.*');
        return $model
            ->join($pivot, $pivot . '.' . $pivotKey, '=', $table . '.' . $secondKey)
            ->select($table . '.*')
            ->where($pivot . '.' . $firstKey, '=', $this->id);
    }
    public function roles()
    {
        return $this->belongsToMany('LaravelRoles\Roleman\Models\Role');
    }
    public function permissions__()
    {
        $res=$this->belongsToMany('LaravelRoles\Roleman\Models\Role')

            ->join('permission_role',"roles.id","=","permission_role.role_id")

            ->join('permissions',"permission_id","=","permissions.id")

            ->select('permissions.*');
//        ->groupBy("role_user.user_id")->groupBy("role_user.role_id")->groupBy("permissions.id");


        return $res;
//        return $this->manyThroughMany('LaravelRoles\Roleman\Models\Permission','LaravelRoles\Roleman\Models\Role',"role_id","id","permission_id");
    }
    public function getpermissionsAttribute(){
        $res=$this->permissions__()->get()->groupBy(function ($item, $key) {
            return $item['id'];
        })->map(function($item){return $item[0];});
        foreach($this->roles as $role){
            if($role-> all_permissions){
                $res=$res->merge( $role->all_permissions);
            }
        }

        return $res;
    }
    public function attachRole($role=null)
    {
        if(!$role)
        {
            return false;
        }
        if(!$this->hasRole(intval($role)))
        {
            $this->roles()->attach($role);
        }

    }
    public function detachRole($role=null)
    {
        if(!$role)
        {
            return false;
        }
        $this->roles()->detach($role);
    }
    public function hasRole($role)
    {
//        var_dump(1);
        if(gettype ($role)=="integer")
        {
            $has=$this->roles()->where('id',$role)->first();
        }else
        {
            $has=$this->roles()->where('name',$role)->first();
        }

        return $has?true:false;
    }
    public function hasPermission($permission)
    {
        $has=$this->permissions->where('name',$permission)->first();
        return $has?true:false;
    }
}
