<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;

class Accessor extends Model
{
    //
    public function Check(\App\User $user,$object)
    {
        return true;
    }
}
