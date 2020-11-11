<?php 

namespace Zareismail\NovaContracts\Auth;
 
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Zareismail\NovaPolicy\Contracts\Ownable; 
use Zareismail\Contracts\Auth\Authorizable as BaseAuthorizable;

interface Authorizable extends Ownable, BaseAuthorizable
{
    /**
     * Indicate Authenticatable.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function auth() : BelongsTo; 

    /**
     * Indicate Model Authenticatable.
     * 
     * @return mixed
     */
    public function owner();
}