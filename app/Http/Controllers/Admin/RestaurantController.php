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

        $validator =  [
            'name' => 'required|max:255',
            'address' => 'required',
            'alias' => 'required|unique:restaurants,alias,'.$restaurant->id,
            'bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        if(request('worktime_ot') || request('worktime_do')){
            $validator = [
                'worktime_ot' => 'required|date_format:H:i',
                'worktime_do' => 'required|date_format:H:i',
            ];

            request()->request->add(['worktime'=>[request('worktime_ot'), request('worktime_do')]]);
        }

        if(\Auth::user()->hasRole('megaroot')){
            $validator['town_id'] = 'required';
        }

        $validator = \Validator::make(request()->all(), $validator);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Проверьте форму на ошибки!');
        }

        if(!request('active')){
            request()->request->add(['active' => false]);
        }

        if($restaurant->update(request()->toArray())){
            
            //Фото
            if($img = request()->file('bg')){
                RestaurantRepository::createThumb($img, $restaurant);
            }

            return redirect()
                ->route('admin.restaurants.index')
                ->with('success', 'Данные ресторана успешно обновлены!');
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
        $validator =  [
            'name' => 'required|max:255',
            'address' => 'required',
            'alias' => 'required|unique:restaurants,alias',
            'bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        if(\Auth::user()->hasRole('megaroot')){
            $validator['town_id'] = 'required';
        }

        $validator = \Validator::make(request()->all(), $validator);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Проверьте форму на ошибки!');
        }

        if(!request('active')){
            request()->request->add(['active' => false]);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if($restaurant->delete()){
            return redirect()
                ->back()
                ->with('success', 'Ресторан "'.$restaurant->name.'" был удален!');
        }
    }


}
