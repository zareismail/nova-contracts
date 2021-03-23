<?php

namespace Zareismail\NovaContracts\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\{Resource as NovaResource, TrashedStatus};  

abstract class Resource extends NovaResource
{      
	use InteractsWithNavigation, PerformsQueryAuthentication, ResourceLabeling, Authorizable;

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
     * @param  string|null  $search
     * @param  array  $filters
     * @param  array  $orderings
     * @param  string  $withTrashed
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function buildIndexQuery(NovaRequest $request, $query, $search = null,
                                      array $filters = [], array $orderings = [],
                                      $withTrashed = TrashedStatus::DEFAULT)
    {
        return parent::buildIndexQuery(
            $request, static::authenticateQuery($request, $query), $search, $filters, $orderings, $withTrashed
        );
    }

    /**
     * Determine if the resource should be available for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function authorizeToViewAny(Request $request)
    { 
    }

    /**
     * Determine if the resource should be available for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public static function authorizedToViewAny(Request $request)
    {
        return true;
    }

    /**
     * Returns new Date field.
     * 
     * @param  string $name            
     * @param  string $attribute       
     * @param  callable $resolveCallback 
     * @return \Laravel\Nova\Fields\Field                  
     */
    public static function dateField($name, $attribute = null, $resolveCallback = null)
    {
        return \Dpsoft\NovaPersianDate\PersianDate::make($name, $attribute, $resolveCallback);
    }

    /**
     * Returns new DateTime field.
     * 
     * @param  string $name            
     * @param  string $attribute       
     * @param  callable $resolveCallback 
     * @return \Laravel\Nova\Fields\Field                  
     */
    public static function datetimeField($name, $attribute = null, $resolveCallback = null)
    {
        return \Dpsoft\NovaPersianDate\PersianDateTime::make($name, $attribute, $resolveCallback);
    }
}
