<?php

namespace Zareismail\NovaContracts\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Zareismail\Contracts\User as Authenticatable;
use Zareismail\NovaPolicy\Concerns\InteractsWithPolicy;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class User extends Authenticatable implements HasMedia
{ 
    use InteractsWithPolicy, SoftDeletes, HasMediaTrait; 

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
        return self::class;
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

    /**
     * Regsiter any media conversions.
     * 
     * @return
     */
    public function registerMediaCollections(): void
    {

        $this
            ->addMediaCollection('image')
            ->singleFile()
            ->useFallbackUrl($this->avatarPlaceholder())
            ->registerMediaConversions(function ($media) {
                $this
                    ->addMediaConversion('avatar')
                    ->width(50)
                    ->height(50);

                $this
                    ->addMediaConversion('thumb')
                    ->width(100)
                    ->height(100);

                $this
                    ->addMediaConversion('mid')
                    ->width(720)
                    ->height(480); 
            });
    }

    /**
     * Get the user avatar.
     * 
     * @return string
     */
    public function avatar()
    {
        return $this->getFirstMediaUrl('image', 'avatar');
    } 

    /**
     * Get the user avatar placeholder image.
     * 
     * @return string
     */
    public function avatarPlaceholder()
    {
        return 'https://secure.gravatar.com/avatar/'.md5(\Illuminate\Support\Str::lower($this->email)).'?size=512';
    }
}
