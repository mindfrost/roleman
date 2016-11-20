<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 19.11.2016
 * Time: 13:36
 */
namespace LaravelRoles\Roleman\Traits;
use LaravelRoles\Roleman\Models;
//use Cache;
trait AttributeCache
{
    function __call($method,$arguments)
    {
        return parent::__call($method,$arguments);
        $p=strpos($method,"Attribute");

//        print('call:'.$method);
        $result=null;
        $cache_enabled=config('roleman.cache_enabled',false);
        $minutes=config('roleman.cache_lifetime',0);
        if ($cache_enabled && method_exists($this,$method) ) {
            $model = get_class($this);
            $arguments_str = md5(serialize($arguments));
            $key = "{$model}_{$method}_{$arguments_str}";
            $that=$this;
            $result = \Cache::remember($key, $minutes, function ()use ($that,$method,$arguments) {
                print('not from cache');
                return call_user_func_array(array($that,"{$method}"), $arguments);
            });
        }
        else
        {
            if( method_exists($this,$method)) {
                $result = call_user_func_array(array($this, "{$method}"), $arguments);
            }else{
                return parent::__call($method,$arguments);
            }

        }

    }
    function __get($name)
    {

        $for_cache=[];
        if(isset($this->remember))
        {
            $for_cache=array_flip($this->remember);
        }

        $result=null;
        $cache_enabled=config('roleman.cache_enabled',false);
        $minutes=config('roleman.cache_lifetime',0);

        if ($cache_enabled&&isset($for_cache[$name])) {
            print('get:'.$name);
            $model = get_class($this);
            $arguments_str = md5(serialize($this));
            $key = "{$model}_{$name}_{$arguments_str}";
            $that=$this;
            $result = \Cache::remember($key, $minutes, function ()use ($that,$name) {
                print('not from cache');
                $model=get_class($that);
//                $model::parent::__get($name);
                $res=parent::__get($name);
//                var_dump($res);
                return  $res;
            });

        }
        else
        {
                $result= parent::__get($name);
        }
        return $result;

    }
}