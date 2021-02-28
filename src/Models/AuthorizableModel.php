<?php

namespace Zareismail\NovaContracts\Models;
 
use Illuminate\Database\Eloquent\Model;
use Zareismail\NovaContracts\Auth\Authorizable;  
use Zareismail\NovaContracts\Auth\Authorization;

class AuthorizableModel extends Model implements Authorizable
{
    use Authorization;

	/**
	 * Indicate Model Authenticatable.
	 * 
	 * @return mixed
	 */
	public function owner()
	{
		return $this->auth();
	}

    /**
     * Get a relationship.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getRelationValue($key)
    {  
    	return parent::getRelationValue(
    		$key == 'owner' && ! $this->relationLoaded('owner') ? 'auth' : $key
    	);
    }
}
