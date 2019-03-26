<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Sale;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return mixed
     */
    public function view(User $user, Sale $sale)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can create sales.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can update the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return mixed
     */
    public function update(User $user, Sale $sale)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can delete the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return mixed
     */
    public function delete(User $user, Sale $sale)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can restore the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return mixed
     */
    public function restore(User $user, Sale $sale)
    {
        return $user->is_admin;
    }

    /**
     * Determine whether the user can permanently delete the sale.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Sale  $sale
     * @return mixed
     */
    public function forceDelete(User $user, Sale $sale)
    {
        return $user->is_admin;
    }
}
