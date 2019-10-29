<?php

namespace App\Policies;

use App\Restaurant;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    public function access(User $user, Restaurant $restaurant){
        if(\Auth::user()->hasRole('megaroot')){
            return true;
        }
        elseif(\Auth::user()->hasRole('root')){
            if(\Auth::id() == $restaurant->present_id){
                return true;
            }
        }
        elseif(\Auth::user()->hasRole('boss')){
            if(\Auth::user()->restaurant->id == $restaurant->id){
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
