<?php

namespace App\Http\Controllers\Admin;

use App\Marker;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->view = 'admin.markers.index';
        $this->title = 'Маркеры для блюд';

        $this->data['markers'] = Marker::all();

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.markers.form';
        $this->title = 'Добавление маркера';

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
        $validate = \Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
            'bg' => 'required',
            'border' => 'required',
            'content' => 'required',
        ],
        [
            'name.required' => 'Укажите навзание маркера!',
            'name.bg' => 'Укажите цвет фона!',
            'name.border' => 'Укажите цвет уголка!',
            'name.content' => 'Укажите содержимое!',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании маркера!');
        }

        if(Marker::create(request()->all())){

            return redirect()
                ->route('admin.markers.index')
                ->with('success', 'Маркер "'.request()->get('name').'" был успешно добавлен!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Marker $marker)
    {
        $this->view = 'admin.markers.form';
        $this->title = 'Редактирование маркера '.$marker->name;

        $this->data['marker'] = $marker;

        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Marker $marker)
    {
        $validate = \Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
            'bg' => 'required',
            'border' => 'required',
            'content' => 'required',
        ],
        [
            'name.required' => 'Укажите навзание маркера!',
            'name.bg' => 'Укажите цвет фона!',
            'name.border' => 'Укажите цвет уголка!',
            'name.content' => 'Укажите содержимое!',
        ]);

        if($marker->update(request()->all())){
            return redirect()
                ->route('admin.markers.index')
                ->with('success', 'Маркер "'.request()->get('name').'" был успешно обновлен!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marker $marker)
    {
        if($marker->delete()){
            return redirect()
                ->back()
                ->with('success', 'Маркер "'.$marker->name.'" был удален!');
        }
    }
}
