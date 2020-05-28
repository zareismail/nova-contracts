<?php

namespace Zareismail\NovaContracts\Nova;
  
use Laravel\Nova\Resource as NovaResource;  
use Inspheric\NovaDefaultable\HasDefaultableFields;

abstract class Resource extends NovaResource
{      
	use HasDefaultableFields, InteractsWithNavigation;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Other'; 
}
