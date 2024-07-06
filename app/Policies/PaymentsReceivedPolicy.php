<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaymentsReceived;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentsReceivedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the paymentsReceived can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paymentsreceiveds');
    }

    /**
     * Determine whether the paymentsReceived can view the model.
     */
    public function view(User $user, PaymentsReceived $model): bool
    {
        return $user->hasPermissionTo('view paymentsreceiveds');
    }

    /**
     * Determine whether the paymentsReceived can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paymentsreceiveds');
    }

    /**
     * Determine whether the paymentsReceived can update the model.
     */
    public function update(User $user, PaymentsReceived $model): bool
    {
        return $user->hasPermissionTo('update paymentsreceiveds');
    }

    /**
     * Determine whether the paymentsReceived can delete the model.
     */
    public function delete(User $user, PaymentsReceived $model): bool
    {
        return $user->hasPermissionTo('delete paymentsreceiveds');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paymentsreceiveds');
    }

    /**
     * Determine whether the paymentsReceived can restore the model.
     */
    public function restore(User $user, PaymentsReceived $model): bool
    {
        return false;
    }

    /**
     * Determine whether the paymentsReceived can permanently delete the model.
     */
    public function forceDelete(User $user, PaymentsReceived $model): bool
    {
        return false;
    }
}
