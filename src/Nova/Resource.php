<?php

namespace Zareismail\NovaContracts\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource as NovaResource;  

abstract class Resource extends NovaResource
{      
	use InteractsWithNavigation, PerformsQueryAuthentication;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Other'; 

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return static::authenticateQuery($request, $query);
    }
}
