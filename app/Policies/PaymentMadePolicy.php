<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaymentMade;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentMadePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the paymentMade can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paymentmades');
    }

    /**
     * Determine whether the paymentMade can view the model.
     */
    public function view(User $user, PaymentMade $model): bool
    {
        return $user->hasPermissionTo('view paymentmades');
    }

    /**
     * Determine whether the paymentMade can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paymentmades');
    }

    /**
     * Determine whether the paymentMade can update the model.
     */
    public function update(User $user, PaymentMade $model): bool
    {
        return $user->hasPermissionTo('update paymentmades');
    }

    /**
     * Determine whether the paymentMade can delete the model.
     */
    public function delete(User $user, PaymentMade $model): bool
    {
        return $user->hasPermissionTo('delete paymentmades');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paymentmades');
    }

    /**
     * Determine whether the paymentMade can restore the model.
     */
    public function restore(User $user, PaymentMade $model): bool
    {
        return false;
    }

    /**
     * Determine whether the paymentMade can permanently delete the model.
     */
    public function forceDelete(User $user, PaymentMade $model): bool
    {
        return false;
    }
}
