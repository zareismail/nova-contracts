<?php

namespace Zareismail\NovaContracts\Policies;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization; 

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can permanently delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user 
     * @return mixed
     */
    // public function viewDashboard(Authenticatable $user)
    // {
    //     //
    // } 

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
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function view(Authenticatable $user, Authenticatable $authenticatable)
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
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function update(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function delete(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can restore the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function restore(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can permanently delete the policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function forceDelete(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can attach policy permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function attachPolicyPermission(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can attach policy permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user 
     * @return mixed
     */
    public function attachAnyPolicyPermission(Authenticatable $user)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can dettach policy permission.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function detachPolicyPermission(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can attach policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function attachPolicyRole(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can attach policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user 
     * @return mixed
     */
    public function attachAnyPolicyRole(Authenticatable $user)
    {
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can dettach policy role.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function detachPolicyRole(Authenticatable $user, Authenticatable $authenticatable)
    {
        return $user->isDeveloper();
    }
}
