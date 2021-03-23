<?php

namespace Zareismail\NovaContracts\Policies;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization; 

abstract class Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Database\Eloqeunt\Model $model
     * @return mixed
     */
    public function view(Authenticatable $user, $model)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can create policy roles.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return mixed
     */
    public function create(Authenticatable $user)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can update the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Database\Eloqeunt\Model $model
     * @return mixed
     */
    public function update(Authenticatable $user, $model)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Database\Eloqeunt\Model $model
     * @return mixed
     */
    public function delete(Authenticatable $user, $model)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can restore the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Database\Eloqeunt\Model $model
     * @return mixed
     */
    public function restore(Authenticatable $user, $model)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can permanently delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Database\Eloqeunt\Model $model
     * @return mixed
     */
    public function forceDelete(Authenticatable $user, $model)
    {
        return $user->isDeveloper();
    } 
}
