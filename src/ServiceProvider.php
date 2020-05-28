<?php

namespace Zareismail\NovaContracts;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Cards\Help; 
use Laravel\Nova\NovaApplicationServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova as LaravelNova; 
use Illuminate\Database\Eloquent\Builder; 
use Illuminate\Contracts\Auth\Authenticatable;

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
        $this->app['config']->set('auth.providers.users.model', User::class); 
        $this->app['config']->set('zareismail.user', User::class); 
        $this->app['config']->set('option.default', 'database');   
        $this->app['config']->set('nova.path', 'dashboard');  
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations'); 
        LaravelNova::serving([$this, 'servingNova']); 
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
        ]);
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

        Gate::policy(User::class, Policies\UserPolicy::class); 
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new Help,
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
            new \Armincms\Bios\Bios
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
