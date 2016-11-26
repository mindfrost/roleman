<?php

namespace LaravelRoles\Roleman\Models;

use Illuminate\Database\Eloquent\Model;
use  Illuminate\Support\ClassLoader;
use Illuminate\Support\Facades\Storage;
class Accessor extends Model
{
    protected $fillable = [
        'classname','name'
    ];
    //
    public $validate_rules=[
        'name'=>'unique:accessors'
    ];
    public $validate_rules_translit=[
        'name.unique'=>"Accessor с таким именем уже существует"
    ];
    public function validate($arr){
        return \Validator::make($arr,$this->validate_rules,$this->validate_rules_translit);
    }
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
    public function Check(\App\User $user,$object,$permission)
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

        $result=$accessor->handle($user,$permission,$object);
        return $result;
    }
    public function permissions()
    {
        return $this->hasMany('LaravelRoles\Roleman\Models\Permission');
    }
    public static function getAvailableClasses()
    {
        $directory= base_path("app/Accessors");
        $files = scandir($directory);
        $res=collect();
        foreach ($files as $k=>$file) {
           if(strpos($file,".php")!==false) {
               $file=str_replace(".php","",$file);
               if($file!="Accessor"){
                   $res->push($file);
               }

            }
        }
        return $res;
    }
}
