<?php

namespace Zareismail\NovaContracts\Concerns;  
     
use Illuminate\Database\Eloquent\Collection;
use Laravel\Nova\Resource;

class ShareableCollection extends Collection
{   
    /**
     * Filter the deails for the given resource.
     * 
     * @param  \Laravel\Nova\Resource $resource
     * @return $this            
     */
    public function forResource(Resource $resource)
    { 
        return $this->filter->isAvailableFor($resource);
    }
}
