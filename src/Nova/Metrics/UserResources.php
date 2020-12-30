<?php

namespace Zareismail\NovaContracts\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Nova;

class UserResources extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {

        $query = $this->newQuery($request)->tap(function($query) use ($request) { 
            $resources = Nova::authorizedResources($request)->map(function($resource) {
                return $resource::$model;
            });

            $query->whereIn('actionable_type', $resources->all());
        });

        return $this->count($request, $query, 'actionable_type')
                    ->label(function ($value) {
                        $resource = Nova::resourceForModel($value);

                        return $resource::label();
                    });
    }

    public function newQuery(NovaRequest $request)
    {
        $actionResoruce = config('nova.actions.resource');

        return with($actionResoruce::newModel(), function($model) use ($request) {
            return $model->where([
                'user_id' => $request->user()->id,
                'name' => 'Create', 
            ]);
        });
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'user-resources';
    }
}
