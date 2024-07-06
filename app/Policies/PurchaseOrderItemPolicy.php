<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PurchaseOrderItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchaseOrderItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the purchaseOrderItem can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list purchaseorderitems');
    }

    /**
     * Determine whether the purchaseOrderItem can view the model.
     */
    public function view(User $user, PurchaseOrderItem $model): bool
    {
        return $user->hasPermissionTo('view purchaseorderitems');
    }

    /**
     * Determine whether the purchaseOrderItem can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create purchaseorderitems');
    }

    /**
     * Determine whether the purchaseOrderItem can update the model.
     */
    public function update(User $user, PurchaseOrderItem $model): bool
    {
        return $user->hasPermissionTo('update purchaseorderitems');
    }

    /**
     * Determine whether the purchaseOrderItem can delete the model.
     */
    public function delete(User $user, PurchaseOrderItem $model): bool
    {
        return $user->hasPermissionTo('delete purchaseorderitems');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete purchaseorderitems');
    }

    /**
     * Determine whether the purchaseOrderItem can restore the model.
     */
    public function restore(User $user, PurchaseOrderItem $model): bool
    {
        return false;
    }

    /**
     * Determine whether the purchaseOrderItem can permanently delete the model.
     */
    public function forceDelete(User $user, PurchaseOrderItem $model): bool
    {
        return false;
    }
}
