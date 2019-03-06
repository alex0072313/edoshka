<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->view = 'admin.categories.index';
        $this->title = 'Категории блюд';

        $this->data['categories'] = Category::allToAccess();

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.categories.form';
        $this->title = 'Добавление новой категории';

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
            'alias' => 'required|unique:categories,alias',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ],
        [
            'name.required' => 'Укажите навзание категории!',
            'alias.required' => 'Укажите алиас!',
            'alias.unique' => 'Алиас должен быть уникальным!',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при создании категории!');
        }

        if($category = auth()->user()->categories()->create(request()->all())){

            //Фото
            if($img = request()->file('image')){
                CategoryRepository::createImage($img, $category);
            }

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Категория "'.request()->get('name').'" была успешно добавлена!');
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
    public function edit(Category $category)
    {
        $this->authorize('access', $category);

        $this->view = 'admin.categories.form';
        $this->title = 'Редактирование категории '.$category->name;

        $this->data['category'] = $category;

        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('access', $category);

        $validate = Validator::make(request()->all(), [
            'name' => 'required|max:255|min:3',
            'alias' => 'required|unique:categories,alias,'.$category->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        if($validate->fails()){
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении категории!');
        }

        if($category->update(request()->all())){

            //Фото
            if($img = request()->file('image')){
                CategoryRepository::createImage($img, $category);
            }

            return redirect()
                ->route('admin.categories.index')
                ->with('success', 'Категория "'.request()->get('name').'" была успешно обновлена!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('access', $category);

        if($category->delete()){
            return redirect()
                ->back()
                ->with('success', 'Категория "'.$category->name.'" была удалена!');
        }
    }
}
