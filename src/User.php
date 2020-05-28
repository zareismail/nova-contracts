<?php

namespace Zareismail\NovaContracts;

use Zareismail\Contracts\User as Authenticatable;
use Zareismail\NovaPolicy\Concerns\InteractsWithPolicy;

class User extends Authenticatable
{ 
    use InteractsWithPolicy; 

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {  
        return User::class;
    }

    public function isDeveloper()
    {
        return $this->email === 'zarehesmaiel@gmail.com';
    }
}
