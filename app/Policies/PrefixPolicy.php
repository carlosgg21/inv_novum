<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Prefix;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrefixPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the prefix can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list prefixes');
    }

    /**
     * Determine whether the prefix can view the model.
     */
    public function view(User $user, Prefix $model): bool
    {
        return $user->hasPermissionTo('view prefixes');
    }

    /**
     * Determine whether the prefix can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create prefixes');
    }

    /**
     * Determine whether the prefix can update the model.
     */
    public function update(User $user, Prefix $model): bool
    {
        return $user->hasPermissionTo('update prefixes');
    }

    /**
     * Determine whether the prefix can delete the model.
     */
    public function delete(User $user, Prefix $model): bool
    {
        return $user->hasPermissionTo('delete prefixes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete prefixes');
    }

    /**
     * Determine whether the prefix can restore the model.
     */
    public function restore(User $user, Prefix $model): bool
    {
        return false;
    }

    /**
     * Determine whether the prefix can permanently delete the model.
     */
    public function forceDelete(User $user, Prefix $model): bool
    {
        return false;
    }
}
