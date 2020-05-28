<?php

namespace Zareismail\NovaContracts\Nova;
 
use Illuminate\Http\Request; 

trait InteractsWithNavigation
{       
    /**
     * Determine if this resource is available for navigation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function availableForNavigation(Request $request)
    {
        return $request->user()->can('create', static::newModel());
    }
}
