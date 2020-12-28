<?php

namespace Zareismail\NovaContracts\Policies;

use Illuminate\Auth\Access\HandlesAuthorization; 
use Illuminate\Contracts\Auth\Authenticatable; 
use Zareismail\NovaContracts\Models\Media;

class MediaPolicy
{
    use HandlesAuthorization;

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

    /**
     * Determine whether the user can delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  \Zareismail\NovaContracts\Models\Media $media
     * @return mixed
     */
    public function delete(Authenticatable $user, Media $media)
    {
        return $user->isDeveloper();
    }
}
