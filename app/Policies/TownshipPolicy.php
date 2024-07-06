<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Township;
use Illuminate\Auth\Access\HandlesAuthorization;

class TownshipPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the township can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list townships');
    }

    /**
     * Determine whether the township can view the model.
     */
    public function view(User $user, Township $model): bool
    {
        return $user->hasPermissionTo('view townships');
    }

    /**
     * Determine whether the township can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create townships');
    }

    /**
     * Determine whether the township can update the model.
     */
    public function update(User $user, Township $model): bool
    {
        return $user->hasPermissionTo('update townships');
    }

    /**
     * Determine whether the township can delete the model.
     */
    public function delete(User $user, Township $model): bool
    {
        return $user->hasPermissionTo('delete townships');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete townships');
    }

    /**
     * Determine whether the township can restore the model.
     */
    public function restore(User $user, Township $model): bool
    {
        return false;
    }

    /**
     * Determine whether the township can permanently delete the model.
     */
    public function forceDelete(User $user, Township $model): bool
    {
        return false;
    }
}
