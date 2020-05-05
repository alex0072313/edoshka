<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\CategoryRepository;
use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use Validator;

class CategoryController extends AdminController
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

        $restaurant = null;
        $restaurants = null;

        $restaurants = auth()->user()->restaurants;

        if(\Auth::user()->hasRole('megaroot|root|boss') && ($restaurants->count() > 1)) {
            if ($restaurant_id = request('restaurant_id')) {
                $restaurant = Restaurant::find($restaurant_id);
            }
        }else{
            $restaurant = $restaurants->first();
        }

        $this->data['restaurant'] = $restaurant;

        if(auth()->user()->hasRole('megaroot')){
            $restaurants = Restaurant::all();
        }elseif (auth()->user()->hasRole('root|boss')){
            $restaurants = $restaurants;
        }else{
            $restaurants = null;
        }

        if(!is_null($restaurants)){
            if($restaurants->count() > 1) $this->data['restaurants'] = $restaurants;
        }

        if($restaurant){
            $dishes = $restaurant->dishes;
            $categories =
                Category::all()
                    ->map(function ($category) use ($dishes){
                        $dishes_in_cat = $dishes->where('category_id', '=', $category->id);
                        if($dishes_in_cat->count()){
                            $category->dishes_cnt = $dishes_in_cat->count();
                        }
                        return $category;
                    })->filter(function ($category){
                        return $category->dishes_cnt > 0 ? true : false;
                    });

            if($restaurant->categories_sort){
                $categories = $categories->sortBy(function($category) use ($restaurant){
                    return array_search($category->id, $restaurant->categories_sort);
                });
            }else{
                $categories = $categories->sortBy('name');
            }

        }else{
            $categories = Category::allToAccess()->sortBy('name');
        }

        $this->data['categories'] = $categories;

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

        if(!request('topmenu')){
            request()->request->add(['topmenu' => false]);
        }

        if($category = auth()->user()->categories()->create(request()->all())){
            \Cache::clear();
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

        if(!request('topmenu')){
            request()->request->add(['topmenu' => false]);
        }

        if($category->update(request()->all())){
            \Cache::clear();
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

    public function sort()
    {
        if($ids = request('ids')){

            if($restaurant = request('restaurant_id')){
                Restaurant::find($restaurant)->update(['categories_sort' => $ids]);
            }
        }

        return response()->json($ids);
    }

    public function clearsort(Restaurant $restaurant)
    {
        $restaurant->update(['categories_sort' => []]);
        return redirect()->back();
    }

}
