<?php

namespace Byg\Admin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Oukuyun\Admin\Models\System\Settings;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Blade;

class AdminServiceProvider extends ServiceProvider
{
    protected $events = [
        'Byg\Admin\Events\Auth\Login' => [
            'Byg\Admin\Listeners\Auth\LoginCount',
        ],
        'Illuminate\Auth\Events\Login' => [
            'Byg\Admin\Listeners\Auth\LoginCount',
        ],
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        //設定檔
        $this->mergeConfigFrom(__DIR__.'/../config/admin.php', 'admin');
        $this->mergeConfigFrom(__DIR__.'/../config/l5-swagger.php', 'l5-swagger');
        $this->mergeConfigFrom(__DIR__.'/../config/audit.php', 'audit');
        $this->mergeConfigFrom(__DIR__.'/../config/authentication-log.php', 'authentication-log');
        $this->mergeConfigFrom(__DIR__.'/../config/captcha.php', 'captcha');
        $this->mergeConfigFrom(__DIR__.'/../config/sanctum.php', 'sanctum');
        $this->mergeConfigFrom(__DIR__.'/../config/datatables.php', 'datatables');
        $this->mergeConfigFrom(__DIR__.'/../config/mediable.php', 'mediable');
        $this->mergeConfigFrom(__DIR__.'/../config/permission.php', 'permission');

        config(['auth.guards'=>array_merge(config('auth.guards'),config('admin.guards'))]);
        config(['auth.providers'=>array_merge(config('auth.providers'),config('admin.providers'))]);
        config(['auth.passwords'=>array_merge(config('auth.passwords'),config('admin.passwords'))]);
        
        App::setLocale(config('admin.locale'));
        App::setFallbackLocale(config('admin.locale'));

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php','admin');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'admin');
        $this->loadMigrationsFrom(__DIR__ .'/../database/migrations');
        $this->loadMigrationsFrom(__DIR__ .'/../database/seeds');

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('admin.auth', \Byg\Admin\Http\Middleware\Authenticate::class);
        $router->aliasMiddleware('admin.init', \Byg\Admin\Http\Middleware\Init::class);
        // $router->aliasMiddleware('admin.admin', \Byg\Admin\Http\Middleware\Admin::class);
        $router->aliasMiddleware('admin.guest', \Byg\Admin\Http\Middleware\RedirectIfAuthenticated::class);
        
        //中介層
        // $router->pushMiddlewareToGroup('admin',  \App\Http\Middleware\EncryptCookies::class);
        // $router->pushMiddlewareToGroup('admin',  \Illuminate\Session\Middleware\StartSession::class);
        $router->pushMiddlewareToGroup('admin',  \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class);
        // $router->pushMiddlewareToGroup('admin',  \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class);
        // $router->pushMiddlewareToGroup('admin', \Illuminate\View\Middleware\ShareErrorsFromSession::class);
        $router->pushMiddlewareToGroup('admin', \Illuminate\Routing\Middleware\SubstituteBindings::class);
        $router->pushMiddlewareToGroup('admin', \Byg\Admin\Http\Middleware\Init::class);

        $this->publishes([
            __DIR__.'/../lang' => resource_path('lang/vendor/admin'),
        ], 'admin-translations');

        $this->publishes([
            __DIR__.'/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/l5-swagger.php' => config_path('l5-swagger.php'),
        ], 'admin-config');
        
        $this->publishes([
            __DIR__.'/../config/audit.php' => config_path('audit.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/captcha.php' => config_path('captcha.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/sanctum.php' => config_path('sanctum.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/authentication-log.php' => config_path('authentication-log.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/datatables.php' => config_path('datatables.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/mediable.php' => config_path('mediable.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/../config/permission.php' => config_path('permission.php'),
        ], 'admin-config');

        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'admin-migrations');

        $events = $this->app->make(Dispatcher::class);

        foreach ($this->events as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }

        // Settings::observe(\Oukuyun\Admin\Observers\System\SettingsObserver::class);
        // Blade::componentNamespace('Oukuyun\\Admin\\View\\Components\\Backend', 'backend');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}