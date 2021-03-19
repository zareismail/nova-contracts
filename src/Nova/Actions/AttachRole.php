<?php

namespace Zareismail\NovaContracts\Nova\Actions;
 
use Illuminate\Support\Collection;
use Laravel\Nova\Nova;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\{ActionFields, BooleanGroup};
use Zareismail\NovaContracts\Nova\Role;

class AttachRole extends Action
{ 
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    { 
        $models->each(function($user) use ($fields) {
            $user->roles()->syncWithoutDetaching(array_keys(array_filter($fields->roles)));
        });
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            BooleanGroup::make(__('Roles'), 'roles')
                ->options(Role::newModel()->get()->mapInto(Role::class)->keyBy->getKey()->map->title()) 
                ->required()
                ->rules('required')
        ];
    }
}
