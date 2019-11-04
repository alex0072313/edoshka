<?php

namespace App\Http\Controllers\Admin;

use App\Kitchen;
use App\Repositories\RestaurantRepository;

use App\Restaurant;
use App\Special;
use Illuminate\Http\Request;

class RestaurantController extends AdminController
{
    public function __construct()
    {
        $this->middleware(['role:megaroot|root'])->only(['create', 'index', 'store', 'destroy']);
        parent::__construct();
    }

    public function index()
    {
        $this->view = 'admin.restaurants.index';
        $this->title = 'Рестораны';

        $this->data['restaurants'] = auth()->user()->hasRole('megaroot') ? Restaurant::all() : auth()->user()->restaurants;

        return $this->render();
    }

    public function edit(Restaurant $restaurant)
    {
        $this->authorize('access', $restaurant);

        $this->title = 'Редактирование ресторана';
        $this->longtitle = $restaurant->name;
        $this->view = 'admin.restaurants.form';

        $this->data['restaurant'] = $restaurant;
        $this->data['restaurant_specials'] = $restaurant->specials;
        $this->data['restaurant_kitchens'] = $restaurant->kitchens;

        $this->data['specials'] = Special::all();
        $this->data['kitchens'] = Kitchen::all();

        return $this->render();
    }

    protected function update(Restaurant $restaurant)
    {
        $this->authorize('access', $restaurant);

        $validator =  [
            'bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'min_sum_order' => 'required',
            'address' => 'required',
            'commission' => 'required|integer|between:5,100',
        ];

        $worktime = ['worktime'=>null];

        if(request('worktime_ot') || request('worktime_do')) {
            $validator = [
                'worktime_ot' => 'required|date_format:H:i',
                'worktime_do' => 'required|date_format:H:i',
            ];

            $worktime = ['worktime' => [request('worktime_ot'), request('worktime_do')]];
        }

        request()->request->add($worktime);

        if(\Auth::user()->hasRole('megaroot')){
            $validator['town_id'] = 'required';
            $validator['name'] = 'required|max:255';
            $validator['address'] = 'required';
            $validator['alias'] = 'required|unique:restaurants,alias,'.$restaurant->id;
        }else{
            request()->request->remove('town_id');
            request()->request->remove('name');
            request()->request->remove('address');
            request()->request->remove('alias');
        }

        $validator = \Validator::make(request()->all(), $validator);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Проверьте форму на ошибки!');
        }

        if(auth()->user()->hasAnyRole(['megaroot', 'root'])){
            if(!request('active')){
                request()->request->add(['active' => false]);
            }
            if(!request('present_id')){
                request()->request->set('present_id', auth()->id());
            }
        }

        if($restaurant->update(request()->toArray())){
            $restaurant->specials()->sync(request()->get('specials'));
            $restaurant->kitchens()->sync(request()->get('kitchens'));
            //Фото
            if($img = request()->file('bg')){
                RestaurantRepository::createThumb($img, $restaurant);
            }

            return redirect()
                ->route((auth()->user()->hasRole('megaroot') ? 'admin.restaurants.index' : 'admin.restaurants.edit'), $restaurant->id)
                ->with('success', 'Данные ресторана успешно обновлены!');
        }
    }

    public function create()
    {
        $this->title = 'Добавление ресторана';
        $this->view = 'admin.restaurants.form';


        $this->data['specials'] = Special::all();
        $this->data['kitchens'] = Kitchen::all();
        return $this->render();
    }

    protected function store()
    {
        $validator =  [
            'name' => 'required|max:255',
            'address' => 'required',
            'alias' => 'required|unique:restaurants,alias',
            'bg' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'min_sum_order' => 'required',
            'commission' => 'required|integer|between:5,100',
        ];

        if(\Auth::user()->hasRole('megaroot')){
            $validator['town_id'] = 'required';
        }

        if(\Auth::user()->hasRole('root')){
            request()->request->add(['present_id' => \Auth::id()]);
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

            $restaurant->specials()->sync(request()->get('specials'));
            $restaurant->kitchens()->sync(request()->get('kitchens'));

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
        if(!auth()->user()->hasRole('megaroot')) abort(403);
        if($restaurant->delete()){
            return redirect()
                ->back()
                ->with('success', 'Ресторан "'.$restaurant->name.'" был удален!');
        }
    }


}
