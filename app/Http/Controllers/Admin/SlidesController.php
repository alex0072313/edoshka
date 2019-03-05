<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\SlideRepository;
use App\Slide;
use App\Town;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->view = 'admin.slides.index';
        $this->title = 'Слайды для главной';

        $this->data['slides'] = Slide::all();

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.slides.form';
        $this->title = 'Добавление слайда';

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
            'title' => 'required|max:255|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],
        [
            'image.required' => 'Укажите изображение!'
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании слайда!');
        }

        if($slide = Slide::create(request()->all())){

            //Фото
            if($img = request()->file('image')){
                SlideRepository::createImage($img, $slide);
            }

            return redirect()
                ->route('admin.slides.index')
                ->with('success', 'Слайд был успешно добавлен!');
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
    public function edit(Slide $slide)
    {
        $this->view = 'admin.slides.form';
        $this->title = 'Редактирование слайда '.$slide->name;

        $this->data['slide'] = $slide;

        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $validate = \Validator::make(request()->all(), [
            'title' => 'required|max:255|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],
        [
            'image.required' => 'Укажите изображение!'
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении категории!');
        }

        if($slide->update(request()->all())){

            //Фото
            if($img = request()->file('image')){
                SlideRepository::createImage($img, $slide);
            }

            return redirect()
                ->route('admin.slides.index')
                ->with('success', 'Слайд был успешно обновлен!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        if($slide->delete()){
            return redirect()
                ->back()
                ->with('success', 'Слайд была удален!');
        }
    }
}
