<?php

namespace App\Policies;

use App\Models\User;
use App\Models\InventoryDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the inventoryDetail can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list inventorydetails');
    }

    /**
     * Determine whether the inventoryDetail can view the model.
     */
    public function view(User $user, InventoryDetail $model): bool
    {
        return $user->hasPermissionTo('view inventorydetails');
    }

    /**
     * Determine whether the inventoryDetail can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create inventorydetails');
    }

    /**
     * Determine whether the inventoryDetail can update the model.
     */
    public function update(User $user, InventoryDetail $model): bool
    {
        return $user->hasPermissionTo('update inventorydetails');
    }

    /**
     * Determine whether the inventoryDetail can delete the model.
     */
    public function delete(User $user, InventoryDetail $model): bool
    {
        return $user->hasPermissionTo('delete inventorydetails');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete inventorydetails');
    }

    /**
     * Determine whether the inventoryDetail can restore the model.
     */
    public function restore(User $user, InventoryDetail $model): bool
    {
        return false;
    }

    /**
     * Determine whether the inventoryDetail can permanently delete the model.
     */
    public function forceDelete(User $user, InventoryDetail $model): bool
    {
        return false;
    }
}
