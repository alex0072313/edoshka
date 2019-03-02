<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RestaurantRepository;

use App\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends AdminController
{
    public function __construct()
    {
        $this->middleware(['role:megaroot'])->only(['create', 'index', 'store', 'destroy']);
        parent::__construct();
    }

    public function index()
    {
        $this->view = 'admin.restaurants.index';
        $this->title = 'Рестораны';

        $this->data['restaurants'] = Restaurant::all();

        return $this->render();
    }

    public function edit(Restaurant $restaurant)
    {
        $this->authorize('access', $restaurant);

        $this->title = 'Редактирование ресторана';
        $this->longtitle = $restaurant->name;
        $this->view = 'admin.restaurants.form';

        $this->data['restaurant'] = $restaurant;

        return $this->render();
    }

    protected function update(Restaurant $restaurant)
    {
        $this->authorize('access', $restaurant);

        $validator = \Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'address' => 'required',
            'bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Проверьте форму на ошибки!');
        }

        if($restaurant->update(request()->toArray())){

            //Фото
            if($img = request()->file('bg')){
                RestaurantRepository::createThumb($img, $restaurant);
            }

            return redirect()
                ->back()
                ->with('success', 'Данные успешно обновлены!');
        }
    }

    public function create()
    {
        $this->title = 'Добавление ресторана';
        $this->view = 'admin.restaurants.form';

        return $this->render();
    }

    protected function store()
    {
        $validator = \Validator::make(request()->all(), [
            'name' => 'required|max:255',
            'address' => 'required',
            'min_sum_order' => 'required',
            'bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Проверьте форму на ошибки!');
        }

        if($restaurant = Restaurant::create(request()->toArray())){

            //Фото
            if($img = request()->file('bg')){
                RestaurantRepository::createThumb($img, $restaurant);
            }

            return redirect()
                ->route('admin.restaurants.index')
                ->with('success', 'Ресторан '.$restaurant->name.' успешно добавлен!');
        }
    }


}
