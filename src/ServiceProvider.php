<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 07.11.16
 * Time: 16:42
 */
namespace LaravelRoles\Roleman;

use Illuminate\Support\ServiceProvider as LServiceProvider;

class ServiceProvider extends LServiceProvider {

    public function boot()
    {

        //Указываем что пакет должен опубликовать при установке
        $this->publishes([__DIR__ . '/../config/' => config_path() . "/"], 'config');
//        $this->publishes([__DIR__ . '/../public/' => public_path() . "/vendor/call-request/"], 'assets');
        $this->publishes([__DIR__ . '/../database/' => base_path("database")], 'database');
        $this->publishes([__DIR__ . '/../views/'=> resource_path('views/vendor/roleman')], 'database');
      ;
        // Routing
        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/routes.php';
        }

        //Указывам где искать вью и какой неймспейс им задать
        $this->loadViewsFrom(__DIR__.'/../views', 'roleman');

    }

    public function register()
    {
        $this->app->register('Collective\Html\HtmlServiceProvider');
        $loader =\Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Form', 'Collective\Html\FormFacade');
        $loader->alias('Html', 'Collective\Html\HtmlFacade');
    }

}