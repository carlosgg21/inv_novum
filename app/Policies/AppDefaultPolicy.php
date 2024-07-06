<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AppDefault;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppDefaultPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the appDefault can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list appdefaults');
    }

    /**
     * Determine whether the appDefault can view the model.
     */
    public function view(User $user, AppDefault $model): bool
    {
        return $user->hasPermissionTo('view appdefaults');
    }

    /**
     * Determine whether the appDefault can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create appdefaults');
    }

    /**
     * Determine whether the appDefault can update the model.
     */
    public function update(User $user, AppDefault $model): bool
    {
        return $user->hasPermissionTo('update appdefaults');
    }

    /**
     * Determine whether the appDefault can delete the model.
     */
    public function delete(User $user, AppDefault $model): bool
    {
        return $user->hasPermissionTo('delete appdefaults');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete appdefaults');
    }

    /**
     * Determine whether the appDefault can restore the model.
     */
    public function restore(User $user, AppDefault $model): bool
    {
        return false;
    }

    /**
     * Determine whether the appDefault can permanently delete the model.
     */
    public function forceDelete(User $user, AppDefault $model): bool
    {
        return false;
    }
}
