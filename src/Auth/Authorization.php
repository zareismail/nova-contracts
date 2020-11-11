<?php 

namespace Zareismail\NovaContracts\Auth;
 
use Zareismail\Contracts\Auth\Authorization as BaseAuthorization;

trait Authorization
{ 
    use BaseAuthorization;

    /**
     * Indicate Model Authenticatable.
     * 
     * @return mixed
     */
    public function owner()
    {
        return $this->auth();
    }
}