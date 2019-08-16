<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'name', 'address', 'description', 'min_sum_order', 'town_id', 'alias', 'worktime', 'active', 'commission', 'categories_sort', 'telegram_chat_id'
    ];

    protected $casts = [
        'worktime' => 'array',
        'categories_sort' => 'array'
    ];

    public function town()
    {
        return $this->belongsTo(Town::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }

    public function specials()
    {
        return $this->belongsToMany(Special::class, 'restaurants_specials');
    }

    public function managers(){
        $filtered = $this->users->filter(function ($user) {
            return $user->hasRole(config('role.names.manager.name'));
        });

        return $filtered->all();
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class, User::class,
            'restaurant_id', 'user_id', 'id'
        );
    }

    public function getCommissionTextAttribute()
    {
        $text = null;

        if($commission = $this->commission){

            if(is_numeric($commission)){
                //обычное число
                $text = (int)$commission.'%';
            }else{
                //вилка
                $fork = explode('|', $commission);
                $r = [];

                foreach ($fork as $fork_part){
                    $fork_item = explode(':', $fork_part);
                    $diaposon = explode(',', $fork_item[0]);
                    $percent = (int)$fork_item[1];

                    if(count($diaposon) > 1){
                        //от-до
                        if($diaposon[0]){
                            $r[] = $diaposon[0].' ₽ < '.$diaposon[1].' - <b>'. $percent.'%</b>';
                        }else{
                            $r[] = '< '.$diaposon[1].' ₽ - <b>'. $percent.'%</b>';
                        }
                    }else{
                        //от
                        $r[] = $diaposon[0].' ₽ < - <b>'. $percent.'%</b>';
                    }
                }
                $text = implode(', ', $r);
            }
        }

        return $text;
    }

    public function boss(){
        $filtered = $this->users->filter(function ($user) {
            return $user->hasRole(config('role.names.boss.name'));
        });

        return $filtered[0];
    }

    public function categoryGroup(){
        $dishes = [];
        foreach (Dish::all() as $dish){
            $dishes[$dish->category->name][] = $dish;
        }

        return $dishes;
    }

    public function scopeDishsByCat($query)
    {
        $dishes = [];
        foreach ($this->hasMany(Dish::class)->get() as $dish){
            $dishes[$dish->category->name][] = $dish;
        }

        return $dishes;
    }

    public function delete()
    {
        $this->users()->delete();
        \Storage::disk('public')->deleteDirectory('restaurant_imgs/'.$this->id);
        return parent::delete();
    }

    public function scopeActive($query)
    {
        return $query->where('active','=','1');
    }

}
