<?php

namespace App\Policies;

use App\User;
use App\category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function access(User $user, category $category){
        if($user->hasRole('megaroot')){
            return true;
        }elseif($category->user->hasRole('boss')){
            if($user->restaurant()->find($category->user->restaurant->id)->count()){
                return true;
            }
        }/*elseif($category->user->hasRole('manager')){
            if($category->user->id == $user->id){
                return true;
            }
        }*/

        return false;
    }
}
