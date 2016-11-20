<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Support\ClassLoader;
class Accessor extends Model
{
    //
    private function load_default_classes() {
        $dir=__DIR__ . '/../../Accessors';
        ClassLoader::addDirectories($dir);

        if( ClassLoader::load("Accessor")&& ClassLoader::load("DefaultAccessor")){

            return true;
        }
        return false;
    }
    private function load_publish_classes() {
        $dir= base_path("app/Accessors");
        ClassLoader::addDirectories($dir);

        if( ClassLoader::load("Accessor")){

            return true;
        }
        return false;
    }
    public function Check(\App\User $user,$object)
    {

            $class=$this->classname;
        if (($class)&&$this->load_publish_classes()&&ClassLoader::load($class)&&class_exists($class)) {
            $accessor=new $class;
        }else{
            if($this->load_default_classes()) {
                $accessor=new \LaravelRoles\Roleman\Accessors\DefaultAccessor;
            }else{
                return false;
            }

        }

        $result=$accessor->handle($user,$this->permission,$object);
        return $result;
    }
    public function permission()
    {
        return $this->hasOne('LaravelRoles\Roleman\Models\Permission');
    }
}
