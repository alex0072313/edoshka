<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\RestaurantRepository;


class RestaurantController extends AdminController
{
    public function index()
    {
        $restaurant = \Auth::user()->restaurant;

        if(request()->method() == 'POST') return $this->update($restaurant);

        $this->title = 'Данные ресторана';
        $this->view = 'admin.restaurant';

        $this->data['restaurant'] = $restaurant;

        return $this->render();
    }

    protected function update($restaurant)
    {
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
}
