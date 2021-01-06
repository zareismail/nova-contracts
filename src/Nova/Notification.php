<?php

namespace Zareismail\NovaContracts\Nova;

use Illuminate\Http\Request;  
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{ID, Text, Select,  DateTime, MorphTo};

class Notification extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaContracts\Models\Notification::class; 

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'data->title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'data->title',
    ];

    /**
     * The relationships that should be eager loaded when performing an index query.
     *
     * @var array
     */
    public static $with = [
        'notifiable'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [ 
            MorphTo::make('Recipient', 'notifiable')
                ->withoutTrashed()
                ->defaultResource(User::class)
                ->default($request->user()->id)
                ->types([
                    User::class
                ]),

            Select::make(__('Notification Level'), 'data->level')
                ->displayUsingLabels()
                ->sortable()
                ->options([
                    'info' => __('Information'),
                    'success' => __('Success'),
                    'error' => __('error'), 
                ]),

            Text::make('Title', 'data->title')
                ->sortable()
                ->required()
                ->rules('required'), 

            Text::make('Subtitle', 'data->subtitle')
                ->sortable()
                ->required()
                ->rules('required'),  

            Text::make('Send At', function() {
                return optional($this->created_at)->diffForHumans();
            }),  

            Text::make('Read At', function() {
                return optional($this->read_at)->diffForHumans();
            }),   
        ];
    } 

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->when($request->user()->cant('update', static::$model), function($query) use ($request) {
            $query->whereHasMorph('notifiable', [$request->user()->getMorphClass()], function($query) use ($request) {
                $query->whereKey($request->user()->id);
            });
        });
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
