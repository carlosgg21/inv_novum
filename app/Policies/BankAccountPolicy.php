<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Auth\Access\HandlesAuthorization;

class BankAccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the bankAccount can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list bankaccounts');
    }

    /**
     * Determine whether the bankAccount can view the model.
     */
    public function view(User $user, BankAccount $model): bool
    {
        return $user->hasPermissionTo('view bankaccounts');
    }

    /**
     * Determine whether the bankAccount can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create bankaccounts');
    }

    /**
     * Determine whether the bankAccount can update the model.
     */
    public function update(User $user, BankAccount $model): bool
    {
        return $user->hasPermissionTo('update bankaccounts');
    }

    /**
     * Determine whether the bankAccount can delete the model.
     */
    public function delete(User $user, BankAccount $model): bool
    {
        return $user->hasPermissionTo('delete bankaccounts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete bankaccounts');
    }

    /**
     * Determine whether the bankAccount can restore the model.
     */
    public function restore(User $user, BankAccount $model): bool
    {
        return false;
    }

    /**
     * Determine whether the bankAccount can permanently delete the model.
     */
    public function forceDelete(User $user, BankAccount $model): bool
    {
        return false;
    }
}
