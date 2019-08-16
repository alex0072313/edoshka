<?php
namespace App\Http\Controllers\Admin;

use App\Kitchen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KitchensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->view = 'admin.kitchens.index';
        $this->title = 'Кухни';

        $this->data['kitchens'] = Kitchen::all();

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.kitchens.form';
        $this->title = 'Добавление кухни';

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
            'name.required' => 'Укажите навзание кухни!',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании кухни!');
        }

        if(Kitchen::create(request()->all())){

            return redirect()
                ->route('admin.kitchens.index')
                ->with('success', 'Кухня "'.request()->get('name').'" была успешно добавлена!');
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
    public function edit(Kitchen $kitchen)
    {
        $this->view = 'admin.kitchens.form';
        $this->title = 'Редактирование кухни '.$kitchen->name;

        $this->data['kitchen'] = $kitchen;

        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kitchen $kitchen)
    {
        $validate = \Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
        ],
        [
            'name.required' => 'Укажите навзание кухни!',
        ]);

        if($kitchen->update(request()->all())){
            return redirect()
                ->route('admin.kitchens.index')
                ->with('success', 'Кухня "'.request()->get('name').'" была успешно обновлена!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kitchen $kitchen)
    {
        if($kitchen->delete()){
            return redirect()
                ->back()
                ->with('success', 'Кухня "'.$kitchen->name.'" был удален!');
        }
    }
}
