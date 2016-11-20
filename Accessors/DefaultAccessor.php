<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 20.11.2016
 * Time: 19:54
 */

namespace LaravelRoles\Roleman\Accessors;


use App\User;
use LaravelRoles\Roleman\Models\Permission;


class DefaultAccessor extends Accessor
{

    public function handle(User $user, $permission,$obj,$predicate=null){

        return "from deeptown";
    }

}