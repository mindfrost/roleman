<?php
namespace LaravelRoles\Roleman\Traits;

trait Roles
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hasRole()
    {
        return $this->hasMany('LaravelRoles\Roleman\Models\Role');
    }
}
