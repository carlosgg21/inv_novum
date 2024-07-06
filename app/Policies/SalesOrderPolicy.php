<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesOrder;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesOrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesOrder can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesorders');
    }

    /**
     * Determine whether the salesOrder can view the model.
     */
    public function view(User $user, SalesOrder $model): bool
    {
        return $user->hasPermissionTo('view salesorders');
    }

    /**
     * Determine whether the salesOrder can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesorders');
    }

    /**
     * Determine whether the salesOrder can update the model.
     */
    public function update(User $user, SalesOrder $model): bool
    {
        return $user->hasPermissionTo('update salesorders');
    }

    /**
     * Determine whether the salesOrder can delete the model.
     */
    public function delete(User $user, SalesOrder $model): bool
    {
        return $user->hasPermissionTo('delete salesorders');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesorders');
    }

    /**
     * Determine whether the salesOrder can restore the model.
     */
    public function restore(User $user, SalesOrder $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesOrder can permanently delete the model.
     */
    public function forceDelete(User $user, SalesOrder $model): bool
    {
        return false;
    }
}
