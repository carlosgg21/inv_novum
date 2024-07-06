<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SalesOrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalesOrderItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the salesOrderItem can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list salesorderitems');
    }

    /**
     * Determine whether the salesOrderItem can view the model.
     */
    public function view(User $user, SalesOrderItem $model): bool
    {
        return $user->hasPermissionTo('view salesorderitems');
    }

    /**
     * Determine whether the salesOrderItem can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create salesorderitems');
    }

    /**
     * Determine whether the salesOrderItem can update the model.
     */
    public function update(User $user, SalesOrderItem $model): bool
    {
        return $user->hasPermissionTo('update salesorderitems');
    }

    /**
     * Determine whether the salesOrderItem can delete the model.
     */
    public function delete(User $user, SalesOrderItem $model): bool
    {
        return $user->hasPermissionTo('delete salesorderitems');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete salesorderitems');
    }

    /**
     * Determine whether the salesOrderItem can restore the model.
     */
    public function restore(User $user, SalesOrderItem $model): bool
    {
        return false;
    }

    /**
     * Determine whether the salesOrderItem can permanently delete the model.
     */
    public function forceDelete(User $user, SalesOrderItem $model): bool
    {
        return false;
    }
}
