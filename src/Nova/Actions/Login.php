<?php

namespace Zareismail\NovaContracts\Nova\Actions;
 
use Illuminate\Support\Collection;
use Laravel\Nova\Nova;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Zareismail\NovaContracts\Nova\User;

class Login extends Action
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
        $maskUser = request()->user(); 
        \Auth::guard(config('nova.guard'))->login($models->first()); 
        User::setMaskedLogin($maskUser);

        return static::redirect(url(Nova::path()));
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
