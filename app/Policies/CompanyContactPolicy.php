<?php

namespace App\Policies;

use App\Models\User;
use App\Models\CompanyContact;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyContactPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the companyContact can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list companycontacts');
    }

    /**
     * Determine whether the companyContact can view the model.
     */
    public function view(User $user, CompanyContact $model): bool
    {
        return $user->hasPermissionTo('view companycontacts');
    }

    /**
     * Determine whether the companyContact can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create companycontacts');
    }

    /**
     * Determine whether the companyContact can update the model.
     */
    public function update(User $user, CompanyContact $model): bool
    {
        return $user->hasPermissionTo('update companycontacts');
    }

    /**
     * Determine whether the companyContact can delete the model.
     */
    public function delete(User $user, CompanyContact $model): bool
    {
        return $user->hasPermissionTo('delete companycontacts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete companycontacts');
    }

    /**
     * Determine whether the companyContact can restore the model.
     */
    public function restore(User $user, CompanyContact $model): bool
    {
        return false;
    }

    /**
     * Determine whether the companyContact can permanently delete the model.
     */
    public function forceDelete(User $user, CompanyContact $model): bool
    {
        return false;
    }
}
