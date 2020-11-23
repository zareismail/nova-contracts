<?php

namespace Zareismail\NovaContracts\Nova\Fields;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\MergeValue;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Resource;

class SharedResources extends MergeValue
{
    /**
     * The resource instance.
     *
     * @var array
     */
    public $resource;

    /**
     * The column attribute name.
     *
     * @var array
     */
    public $attribute;

    /**
     * Create new merge value instance.
     *
     * @param  \Illuminate\Http\Request $resource
     * @param  \Laravel\Nova\Resource  $resource
     * @return void
     */
    public function __construct(Request $request, Resource $resource, string $attribute = 'config')
    {
    	$this->resource = $resource;
    	$this->attribute = $attribute;

    	parent::__construct((array) $this->prepareFields($request));
    }

    public function prepareFields(Request $request)
    {
    	if($resources = $this->resources($request)->pluck('label', 'name')) {
    		return [ 
                BooleanGroup::make(__('Except On The'), "{$this->attribute}->except")
                    ->options($resources)
                    ->help(__('The user never sees this on the selected pages.')),

                BooleanGroup::make(__('Only On The'), "{$this->attribute}->only")
                    ->options($resources)
                    ->help(__('The user sees this just in the selected pages.')),

                BooleanGroup::make(__('Required On The'), "{$this->attribute}->required")
                    ->options($resources)
                    ->help(__('The user forces to fill this on the selected pages.')),
            ]; 
        }
    }

    /**
     * Return Nova's resources that need details.
     *
     * @param  \use Illuminate\Http\Request $request
     * @return \Laravel\Nova\ResourceCollection
     */
    public function resources(Request $request)
    { 
    	$resources = forward_static_call([$this->resource, 'sharedResources'], $request);

        return collect($resources)->map(function($resource) {
            return [
                'label' => $resource::label(),
                'name' => $resource::uriKey(), 
            ];
        });
    }
}