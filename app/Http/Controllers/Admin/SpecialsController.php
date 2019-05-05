<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use App\Repositories\SpecialRepository;
use App\Special;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use Validator;

class SpecialsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->view = 'admin.specials.index';
        $this->title = 'Акции ресторанов';

        $this->data['specials'] = Special::all();

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.specials.form';
        $this->title = 'Добавление новой акции';

        return $this->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],
        [
            'name.required' => 'Укажите навзание акции!',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании акции!');
        }

        if(!request('status')){
            request()->request->add(['status' => false]);
        }

        if($special = Special::create(request()->all())){
            \Cache::clear();
            //Фото
            if($img = request()->file('image')){
                SpecialRepository::createImage($img, $special);
            }

            return redirect()
                ->route('admin.specials.index')
                ->with('success', 'Акция "'.request()->get('name').'" была успешно добавлена!');
        }


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Special $special)
    {
        $this->view = 'admin.specials.form';
        $this->title = 'Редактирование акции '.$special->name;

        $this->data['special'] = $special;

        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Special $special)
    {
        $validate = Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении акции!');
        }

        if(!request('status')){
            request()->request->add(['status' => false]);
        }

        if($special->update(request()->all())){
            \Cache::clear();
            //Фото
            if($img = request()->file('image')){
                SpecialRepository::createImage($img, $special);
            }

            return redirect()
                ->route('admin.specials.index')
                ->with('success', 'Акция "'.request()->get('name').'" была успешно обновлена!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Special $special)
    {
        if($special->delete()){
            return redirect()
                ->back()
                ->with('success', 'Акция "'.$special->name.'" была удалена!');
        }
    }
}
