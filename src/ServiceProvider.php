<?php

namespace Zareismail\NovaContracts;

use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\{Gate, Storage};
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Nova as LaravelNova; 
use Laravel\Nova\Events\ServingNova;  

class ServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['config']->set('auth.guards.admin', config('auth.guards.web')); 
        $this->app['config']->set('auth.providers.users.model', Models\User::class); 
        $this->app['config']->set('zareismail.user', Models\User::class); 
        $this->app['config']->set('option.default', 'database');   
        $this->app['config']->set('nova.path', 'dashboard');  
        $this->app['config']->set('medialibrary.media_model', Models\Media::class);  
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations'); 
        LaravelNova::serving([$this, 'servingNova']); 
        $this->registerEventListeners();
        $this->mergeConfigurations();
        $this->registerPublishing();
        parent::boot();          
    }

    /**
     * Register the Nova application manofests when it serves.
     * 
     * @return void
     */
    public function servingNova()
    {
        LaravelNova::resources([
            Nova\User::class, 
            Nova\Role::class, 
            Nova\General::class, 
            Nova\Pusher::class, 
        ]);
    }

    /**
     * Register event lsiteners.
     * 
     * @return void
     */
    public function registerEventListeners()
    {
        app('events')->listen(Registered::class, Listeners\RegisteredUser::class);
    } 

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__.'/../resources/views/nova' => resource_path('views/vendor/nova'),
        ], 'custom-nova-views');
    }

    /**
     * Merge the custom configurations via the default configurations.
     *
     * @return void
     */
    protected function mergeConfigurations()
    {
        $this->app->booted(function($app) {
            collect(Storage::disk('local')->files('config'))->each(function($file) {
                collect(json_decode(Storage::disk('local')->get($file), true))->each(function($value, $key) {
                    $this->app['config']->set($key, $value);
                });                 
            }); 
        }); 
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        LaravelNova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    } 

    /**
     * Configure the Nova authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();
        
        LaravelNova::auth(function ($request) {
            return app()->environment('local') ||
                   Gate::check('viewDashboard', [$request->user()]);
        });
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {  
        Gate::define('viewDashboard', function($user) {
            return $user->can('viewDashboard');
        });

        Gate::policy(Models\User::class, Policies\UserPolicy::class); 
        Gate::policy(Models\Media::class, Policies\MediaPolicy::class); 
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [ 
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            \Armincms\Bios\Bios::make(),

            \Mirovit\NovaNotifications\NovaNotifications::make(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        Builder::macro('fullname', function() {
            $model = $this->getModel();
            
            if($model instanceof Authenticatable) {
                return trim($model->firstname.PHP_EOL.$model->lastname);
            }

            unset(static::$macros['fullname']);

            return $model->fullname();
        });
    }
}
