<?php

namespace Zareismail\NovaContracts\Policies;

use Illuminate\Auth\Access\HandlesAuthorization; 
use Illuminate\Contracts\Auth\Authenticatable; 
use Zareismail\NovaContracts\Models\Media;

class OptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any policy roles.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return mixed
     */
    public function viewAny(Authenticatable $user)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can view the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\NovaContracts\Models\Media $media
     * @return mixed
     */
    public function view(Authenticatable $user, Media $media)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can update the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\NovaContracts\Models\Media $media
     * @return mixed
     */
    public function update(Authenticatable $user, Media $media)
    {
        return $user->isDeveloper();
    } 
}
