<?php

namespace Zareismail\NovaContracts\Nova;
  
use Laravel\Nova\Resource as NovaResource;  

abstract class Resource extends NovaResource
{      
	use InteractsWithNavigation;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Other'; 
}
