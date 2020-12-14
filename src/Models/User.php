<?php

namespace Zareismail\NovaContracts\Models;

use Zareismail\Contracts\User as Authenticatable;
use Zareismail\NovaPolicy\Concerns\InteractsWithPolicy;

class User extends Authenticatable
{ 
    use InteractsWithPolicy; 

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'profile' => 'json',
    ];

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {  
        return User::class;
    }

    /**
     * Determin if the user is Developer.
     * 
     * @return boolean
     */
    public function isDeveloper()
    {
        return $this->email === 'zarehesmaiel@gmail.com';
    }

    /**
     * Query the deveoper.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder $query 
     * @return \Illuminate\Database\Eloquent\Builder        
     */
    public function scopeDeveloper($query)
    {
        return $query->whereEmail('zarehesmaiel@gmail.com');
    }

    /**
     * Query without deveoper.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder $query 
     * @return \Illuminate\Database\Eloquent\Builder        
     */
    public function scopeWithoutDeveloper($query)
    {
        return $query->where($query->qualifyColumn('email'), '!=', 'zarehesmaiel@gmail.com');
    }
}
