<?php

namespace Zareismail\NovaContracts\Nova;
 
use Zareismail\NovaPolicy\Nova\Role as Resource;

class Role extends Resource
{     
	use InteractsWithNavigation;
	
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'ACL';
}
