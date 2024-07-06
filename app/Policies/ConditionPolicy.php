<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Condition;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConditionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the condition can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list conditions');
    }

    /**
     * Determine whether the condition can view the model.
     */
    public function view(User $user, Condition $model): bool
    {
        return $user->hasPermissionTo('view conditions');
    }

    /**
     * Determine whether the condition can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create conditions');
    }

    /**
     * Determine whether the condition can update the model.
     */
    public function update(User $user, Condition $model): bool
    {
        return $user->hasPermissionTo('update conditions');
    }

    /**
     * Determine whether the condition can delete the model.
     */
    public function delete(User $user, Condition $model): bool
    {
        return $user->hasPermissionTo('delete conditions');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete conditions');
    }

    /**
     * Determine whether the condition can restore the model.
     */
    public function restore(User $user, Condition $model): bool
    {
        return false;
    }

    /**
     * Determine whether the condition can permanently delete the model.
     */
    public function forceDelete(User $user, Condition $model): bool
    {
        return false;
    }
}
