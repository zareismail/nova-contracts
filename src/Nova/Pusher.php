<?php

namespace Zareismail\NovaContracts\Nova;

use Illuminate\Http\Request;  
use Illuminate\Support\Facades\{Storage, Artisan};  
use Laravel\Nova\Fields\{Heading, Text, Boolean};   
use Laravel\Nova\Http\Requests\NovaRequest;

class Pusher extends BiosResource
{  
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [   
            Text::make(__('Pusher App ID'), static::prefix('app_id')),

            Text::make(__('Pusher Key'), static::prefix('key')),

            Text::make(__('Pusher Secret'), static::prefix('secret')),

            Text::make(__('Pusher Cluster'), static::prefix( 'cluster')),

            Boolean::make(__('Active'), static::prefix( 'active')),
        ];
    } 

    /**
     * Return the location to redirect the user after update.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Laravel\Nova\Resource  $resource
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        static::exportConfigurations();

        return parent::redirectAfterUpdate($request, $resource);
    }

    /**
     * Put configurations into the autoloadable file.
     *  
     * @return void        
     */
    public static function exportConfigurations()
    {
        Storage::disk('local')->put('config/pusher.json', json_encode([
            'broadcasting.connections.pusher.app_id'=> static::option('app_id'),
            'broadcasting.connections.pusher.key'   => static::option('key'),
            'broadcasting.connections.pusher.secret'=> static::option('secret'),
            'broadcasting.connections.pusher.options.cluster' => static::option('cluster'),
        ], JSON_PRETTY_PRINT));

        Artisan::call('config:clear');
    }

    /**
     * Determine if the pusher enabled.
     * 
     * @return boolean
     */
    public static function enabled(): bool
    {
        return boolval(static::option('active'));
    }
}
