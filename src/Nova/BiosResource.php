<?php

namespace Zareismail\NovaContracts\Nova;

use Illuminate\Support\Str;  
use Armincms\Bios\Resource;  

abstract class BiosResource extends Resource
{    
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Zareismail\NovaContracts\Models\Option::class; 

    /**
     * Get the URI key for the resource.
     *
     * @return string
     */
    public static function uriKey()
    { 
        return 'bios-' . parent::uriKey();
    }

    /**
     * Retrieve option by the key.
     *
     * @var  string $key
     * @var  mixed  $default
     * @return mixed
     */
    public static function option($key, $default = null)
    { 
        return parent::option(static::prefix($key), $default);
    }

    /**
     * Prefix the given key.
     * 
     * @param  string $key 
     * @return string      
     */
    public static function prefix(string $key): string
    {
        return Str::upper(static::getPrefix().':'.$key) ;
    }

    /**
     * Get the prefix string.
     * 
     * @return string
     */
    public static function getPrefix(): string
    {
        return Str::snake(implode(' ', explode('\\', get_called_class())));
    }
}
