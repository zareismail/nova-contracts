<?php

namespace Zareismail\NovaContracts\Nova;

use Illuminate\Http\Request;  
use Laravel\Nova\Fields\Select; 
use Zareismail\NovaPolicy\PolicyRole;  

class General extends BiosResource
{ 
    /**
     * The option storage driver name.
     *
     * @var string
     */
    public static $store = '';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return with(PolicyRole::get()->pluck('name', 'id'), function($roles) {
            return [   
                Select::make(__('Guest User Role'), static::prefix('guest_role'))
                    ->options($roles)
                    ->required()
                    ->rules('required')
                    ->displayUsingLabels(),
                 
            ];
        });
    } 
}
