<?php

namespace App\Policies;

use App\Dish;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DishPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the owner.
     *
     * @param  \App\User  $user
     * @param  \App\owner  $owner
     * @return mixed
     */
    public function access(User $user, Dish $dish)
    {
        // TODO: проверка прав доступа к блюду
        if($user->hasRole('admin')){
            return true;
        }
        return ($dish->restaurant->id == $user->restaurant->id);
    }

}
