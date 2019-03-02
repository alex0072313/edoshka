<?php

namespace App\Http\Controllers\Admin;

use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TownsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->view = 'admin.towns.index';
        $this->title = 'Города';

        $this->data['towns'] = Town::all();

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.towns.form';
        $this->title = 'Добавление города';

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
        ],
        [
            'name.required' => 'Укажите навзание города!'
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании города!');
        }

        if(Town::create(request()->all())){

            return redirect()
                ->route('admin.towns.index')
                ->with('success', 'Город "'.request()->get('name').'" был успешно добавлен!');
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
    public function edit(Town $town)
    {
        $this->view = 'admin.towns.form';
        $this->title = 'Редактирование города '.$town->name;

        $this->data['town'] = $town;

        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $town)
    {
        $validate = \Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
        ],
        [
            'name.required' => 'Укажите навзание города!'
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении категории!');
        }

        if($town->update(request()->all())){
            return redirect()
                ->route('admin.towns.index')
                ->with('success', 'Город "'.request()->get('name').'" был успешно обновлен!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $town)
    {
        if($town->delete()){
            return redirect()
                ->back()
                ->with('success', 'Город "'.$town->name.'" была удален!');
        }
    }
}
