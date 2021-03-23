<?php

namespace Zareismail\NovaContracts\Policies;

use Illuminate\Contracts\Auth\Authenticatable;

abstract class DeletablePolicy extends Policy
{ 
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
