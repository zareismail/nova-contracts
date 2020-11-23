<?php 

namespace Zareismail\NovaContracts\Concerns;

use Laravel\Nova\Resource;

trait InteractsWithConfigs
{   
    /**
     * Configure trait.
     * 
     * @return void
     */
    public function initializeInteractsWithConfigs() 
    {
        $this->casts['config'] = 'array';
    }

    /**
     * Get the config value with the given key.
     * 
     * @param  string $key     
     * @param  mixed $default 
     * @return mixed          
     */
    public function config(string $key, $default = null)
    {
        return data_get($this->config, $key, $default);
    }
}