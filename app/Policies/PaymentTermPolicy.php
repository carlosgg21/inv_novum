<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PaymentTerm;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaymentTermPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the paymentTerm can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paymentterms');
    }

    /**
     * Determine whether the paymentTerm can view the model.
     */
    public function view(User $user, PaymentTerm $model): bool
    {
        return $user->hasPermissionTo('view paymentterms');
    }

    /**
     * Determine whether the paymentTerm can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paymentterms');
    }

    /**
     * Determine whether the paymentTerm can update the model.
     */
    public function update(User $user, PaymentTerm $model): bool
    {
        return $user->hasPermissionTo('update paymentterms');
    }

    /**
     * Determine whether the paymentTerm can delete the model.
     */
    public function delete(User $user, PaymentTerm $model): bool
    {
        return $user->hasPermissionTo('delete paymentterms');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paymentterms');
    }

    /**
     * Determine whether the paymentTerm can restore the model.
     */
    public function restore(User $user, PaymentTerm $model): bool
    {
        return false;
    }

    /**
     * Determine whether the paymentTerm can permanently delete the model.
     */
    public function forceDelete(User $user, PaymentTerm $model): bool
    {
        return false;
    }
}
