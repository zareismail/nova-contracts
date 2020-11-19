<?php 

namespace Zareismail\NovaContracts\Models;

use Spatie\MediaLibrary\Models\Media as Model; 
use Zareismail\NovaContracts\Auth\Authorizable;  
use Zareismail\NovaContracts\Auth\Authorization;

class Media extends Model implements Authorizable
{ 
    use Authorization;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['owner'];

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