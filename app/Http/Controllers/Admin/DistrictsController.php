<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictsController extends Controller
{
    public function index()
    {
        $this->view = 'admin.districts.index';
        $this->title = 'Районы';

        $towns= Town::all();
        $this->data['districts'] = District::all()->map(function ($district) use ($towns){
            if($district->town_id && ($town = $towns->where('id', '=', $district->town_id)->first())){
                $district->town_name = $town->name;
                $district->town_name2 = $town->name2;
                $district->town_name3 = $town->name3;
            }
            return $district;
        });

        return $this->render();
    }

    public function create()
    {
        $this->view = 'admin.districts.form';
        $this->title = 'Добавление района';

        $this->data['towns'] = Town::all();

        return $this->render();
    }

    public function store(Request $request)
    {
        $validate = \Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
            'alias' => 'required|unique:districts,alias',
            'town_id' => 'required',
        ],
        [
            'town_id.required' => 'Укажите город!',
            'name.required' => 'Укажите навзание района!',
            'alias.required' => 'Укажите алиас района!',
            'alias.unique' => 'Такой алиас района уже есть!',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании района!');
        }

        if(District::create(request()->all())){

            return redirect()
                ->route('admin.districts.index')
                ->with('success', 'Район "'.request()->get('name').'" был успешно добавлен!');
        }
    }

    public function edit(District $district)
    {
        $this->view = 'admin.districts.form';
        $this->title = 'Редактирование района '.$district->name;

        $this->data['towns'] = Town::all();
        $this->data['district'] = $district;

        return $this->render();
    }

    public function update(Request $request, District $district)
    {
        $validate = \Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
        ],
        [
            'name.required' => 'Укажите навзание района!'
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении района!');
        }

        if($district->update(request()->all())){
            return redirect()
                ->route('admin.districts.index')
                ->with('success', 'Район "'.request()->get('name').'" был успешно обновлен!');
        }
    }

    public function destroy(District $district)
    {
        if($district->delete()){
            return redirect()
                ->back()
                ->with('success', 'Район "'.$district->name.'" была удален!');
        }
    }
}
