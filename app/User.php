<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lastname', 'restaurant_id', 'phone', 'phone2', 'order_in_sms', 'image', 'provider', 'provider_id', 'responder', 'accept_policy', 'street', 'home'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullNameAttribute()
    {
        return $this->name . ($this->lastname ? ' '.$this->lastname : '');
    }

    public function setPhoneAttribute($value = null)
    {
        $this->attributes['phone'] = valid_phone($value);
    }

    public function restaurant(){
        return $this->hasOne('App\Restaurant', 'id', 'restaurant_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    // Уведомления
//    public function notifications(){
//        return $this->hasMany(Notification::class);
//    }
//
//    public function addNotification($key='', $subject = '', $text = '', $type = 0){
//        return $this->notifications()->create([
//            'key' => $key,
//            'subject' => $subject,
//            'text' => $text,
//            'type' => $type,
//        ]);
//    }

    public function roleName(){
        return config('role.names.'.$this->roles()->get()->first()->name.'.dolg');
    }

    public function delete()
    {
        \Storage::disk('public')->deleteDirectory('user_imgs/'.$this->id);
        return parent::delete();
    }

//    public function checkNotify($key = ''){
//        return $this->notifications()->where('key', $key)->count();
//    }

    public static function getAdmin(){
        $r =  User::whereHas("roles", function($q){
            $q->where("name", config('role.names.megaroot.name'));
        })->get();

        return $r[0];
    }

    public function addBalls($sumorder = 0)
    {
        $this->balls = $this->balls + calc_balls($sumorder);
        $this->save();
    }


}
