<?php

namespace Zareismail\NovaContracts\Nova;

use Illuminate\Http\Request; 
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{ID, Text, Boolean, Password};
use DmitryBubyakin\NovaMedialibraryField\Fields\Medialibrary;
use Zareismail\NovaPolicy\Nova\Permission;
use Armincms\Fields\BelongsToMany; 

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaContracts\Models\User::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'ACL';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * The relationships that should be eager loaded when performing an index query.
     *
     * @var array
     */
    public static $with = [
        'roles'
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
            ID::make()->sortable(), 

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Email')
                ->sortable()
                ->rules('email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make('Mobile')
                ->sortable()
                ->rules('regex:/^[0-9]{11,12}$/')
                ->creationRules('unique:users,mobile')
                ->updateRules('unique:users,mobile,{{resourceId}}'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            Boolean::make(__('Is Developer'), function() {
                return $this->isDeveloper();
            }),

            BelongsToMany::make(__('Roles'), 'roles', Role::class) 
                ->canSee(function($request) {
                    return $request->user()->can('attach', Role::newModel());
                }),

            BelongsToMany::make(__('Permissions'), 'permissions', Permission::class)
                ->hideFromIndex()
                ->canSee(function($request) {
                    return $request->user()->can('attach', Permission::newModel());
                }),

            Medialibrary::make(__('Image'), 'image')
                ->attachExisting()
                ->autouploading()
                ->single()
                ->attachExisting(function ($query, $request, $model) {
                    $query->authenticate();
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
        return $query->when(! $request->user()->isDeveloper(), function($query) {
            return $query->withoutDeveloper();
        });
    }

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->fullname();
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
