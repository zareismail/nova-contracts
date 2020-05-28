<?php

namespace Zareismail\NovaContracts\Policies;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;
use Zareismail\Contracts\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can permanently delete the policy role.
     *
     * @param  \Zareismail\Contracts\User  $user 
     * @return mixed
     */
    // public function viewDashboard(User $user)
    // {
    //     //
    // } 

    /**
     * Determine whether the user can view any policy roles.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function view(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can create policy roles.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function update(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can delete the policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function delete(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can restore the policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function restore(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function forceDelete(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can attach policy permission.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function attachPolicyPermission(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can attach policy permission.
     *
     * @param  \Zareismail\Contracts\User  $user 
     * @return mixed
     */
    public function attachAnyPolicyPermission(User $user)
    {
        //
    }

    /**
     * Determine whether the user can dettach policy permission.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function detachPolicyPermission(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can attach policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function attachPolicyRole(User $user, Authenticatable $authenticatable)
    {
        //
    }

    /**
     * Determine whether the user can attach policy role.
     *
     * @param  \Zareismail\Contracts\User  $user 
     * @return mixed
     */
    public function attachAnyPolicyRole(User $user)
    {
        //
    }

    /**
     * Determine whether the user can dettach policy role.
     *
     * @param  \Zareismail\Contracts\User  $user
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $authenticatable
     * @return mixed
     */
    public function detachPolicyRole(User $user, Authenticatable $authenticatable)
    {
        //
    }
}
