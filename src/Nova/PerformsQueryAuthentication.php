<?php

namespace Zareismail\NovaContracts\Nova;
 
use Laravel\Nova\Http\Requests\NovaRequest; 
use Zareismail\Contracts\Helpers\Once;
use Zareismail\NovaPolicy\Helper;

trait PerformsQueryAuthentication
{   
    /**
     * Authenticate the query for the given request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function authenticateQuery(NovaRequest $request, $query)
    {
        return $query->where(function($query) use ($request) {
            $query->when(static::shouldAuthenticate($request), function($query) {
                $query->authenticate();
            });
        });
    }

    /**
     * Determine if the given request should be authorize.
     * 
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return boolean
     */
    public static function shouldAuthenticate(NovaRequest $request): bool
    {
        return Once::get(static::$model.'.shouldAuthenticate', function() use ($request) {
            return static::isOwnable() && $request->user()->cant('update', static::newModel());
        });
    }

    /**
     * Determine if the resources model implements Ownable.
     * 
     * @return boolean
     */
    public static function isOwnable(): bool
    {
        return Helper::isOwnable(static::newModel());
    }
}
