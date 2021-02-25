<?php

namespace Zareismail\NovaContracts\Nova;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\{Resource as NovaResource, TrashedStatus};  

abstract class Resource extends NovaResource
{      
	use InteractsWithNavigation, PerformsQueryAuthentication, ResourceLabeling;

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
}
