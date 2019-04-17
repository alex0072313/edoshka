<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Dish;
use App\Marker;
use App\Repositories\DishRepository;
use App\Restaurant;
use App\Variant;
use Illuminate\Http\Request;
use Auth;

class DishesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    {
        $this->title = 'Блюда';
        $this->view = 'admin.dishes.index';
        $this->pagetitle = 'Блюда';

        $dishes = Auth::user()->hasRole('megaroot') ? Dish::all() : Auth::user()->restaurant->dishes;

        foreach (Category::allToAccess(true) as $cat) {
            $this->data['category_by_dishes'][$cat->id] = $dishes->where('category_id', $cat->id)->count();
        }

        if ($category->name) {
            $this->title = 'Блюда в категории';
            $this->longtitle = $category->name;

            $this->data['category'] = $category;

            if(Auth::user()->hasRole('megaroot')){
                $dishes = Dish::where('category_id', $category->id)->get();
            }else{
                $dishes = Auth::user()
                    ->restaurant
                    ->dishes()
                    ->where('category_id', $category->id)
                    ->get();
            }

        }

        if (!$category->name && !Category::all()->count()) {
            \request()->session()->flash('error', 'Для добавления блюда необходимо добавить хотябы 1 категорию! <a href="' . route('admin.categories.create') . '">Добавить категорию</a>');
            //session(['error' => 'Для добавления блюда необходимо добавить хотябы 1 категорию!']);
            //$this->data['error'] = 'Для добавления блюда необходимо добавить хотябы 1 категорию!';
        }

//        $this->data['fields_names'] = [];
//        $fields_owners = [];
//        foreach ($owners as $owner){
//            foreach ($owner->fields as $field_content){
//                $field = $field_content->field;
//                $type = $field->type;
//
//                if(($type->type == 'htmltext') || ($type->type == 'files')) continue;
//
//                $this->data['fields_names'][$field->id] = $field->name;
//                $fields_owners[$owner->id][$field->id] = $field_content->content;
//            }
//        }
//
//        $owners = $owners->map(function ($owner) use ($fields_owners){
//            if($thumb = $owner
//                ->images()
//                ->orderBy('pos')
//                ->first())
//            {
//                $owner->thumb = $thumb->th_url(3);
//            }
//            $owner->fields_cont = $fields_owners[$owner->id];
//            return $owner;
//        });

        //dd($owners);

        $this->data['dishes'] = $dishes;

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        $this->view = 'admin.dishes.form';
        $this->title = 'Добавление блюда';

        if ($category) {
            $this->longtitle = $category->name;
            $this->data['category'] = $category;
        }

        $recomendeds = Auth::user()->hasRole('megaroot') ? Dish::all() : Auth::user()->restaurant->dishes;

        $this->data['restaurants'] = $restaurants = Restaurant::all();

        if(Auth::user()->hasRole('megaroot')){
            $recomendeds->map(function ($recomended) use ($restaurants){
                $recomended->restaurant = $restaurants->where('id', '=', $recomended->restaurant_id)->first();
                return $recomended;
            });
        }

        $this->data['recomendeds'] = $recomendeds;

        return $this->render();
    }

    public function copy(Dish $dish)
    {
        $dish->load('variants');

        $newModel = $dish->replicate();
        $newModel->push();

        foreach($dish->getRelations() as $relation => $items){
            foreach($items as $item){
                unset($item->id);
                $newModel->{$relation}()->create($item->toArray());
            }
        }

        return redirect()->route('admin.dishes.edit', $newModel->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = [
            'name' => 'required|max:255|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'price' => 'required',
            'category_id' => 'required',
        ];

        if (Auth::user()->hasRole('megaroot')) {
            $validate['restaurant_id'] = 'required';
        }

        $validate = \Validator::make(request()->all(), $validate);

        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при добавлении блюда, проверьте форму!');
        }

        if (!Auth::user()->hasRole('megaroot')) {
            if ($restaurant = Auth::user()->restaurant) {
                request()->request->set('restaurant_id', $restaurant->id);
            }
        }

        if ($dish = Auth::user()->dishes()->create(request()->all())) {

            \Cache::clear();

            $dish->markers()->sync(request()->get('markers'));
            $dish->recomendeds()->sync(request()->get('recomendeds'));

            //Поля
            //$this->fields($owner);

            //Поля цен
            $this->price_variants($dish);

            //Фото
            if ($img = request()->file('image')) {
                DishRepository::createImage($img, $dish, request()->get('whitespace'));
            }

            if(request('create_copy')){
                return $this->copy($dish);
            }

            return redirect()
                ->route('admin.dishes.index', 'category_' . $dish->category->id)
                ->with(['success' =>
                    'Блюдо <a href="' . route('admin.dishes.edit', $dish->id) . '">' . $dish->name . '</a> добавлено в категорию ' .
                    (Auth::user()->can('access', $dish->category) ? '<a class="text-green" href="' . route('admin.categories.edit', $dish->category->id) . '">' : '') .
                    $dish->category->name .
                    (Auth::user()->can('access', $dish->category) ? '</a>' : '')
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        $this->authorize('access', $dish);

        $this->view = 'admin.dishes.form';
        $this->title = $dish->name;

        $this->pagetitle = $dish->name;

        if ($category = $dish->category) {
            $this->longtitle = $category->name;
        }

        $this->data['dish'] = $dish;

        $recomendeds = Auth::user()->hasRole('megaroot') ? Dish::where('id', '!=', $dish->id)->get() : Auth::user()->restaurant->dishes()->where('id', '!=', $dish->id)->get();

        $this->data['restaurants'] = $restaurants = Restaurant::all();

        if(Auth::user()->hasRole('megaroot')){
            $recomendeds->map(function ($recomended) use ($restaurants){
                $recomended->restaurant = $restaurants->where('id', '=', $recomended->restaurant_id)->first();
                return $recomended;
            });
        }

        $this->data['recomendeds'] = $recomendeds;
        $this->data['dish_recomendeds'] = $dish->recomendeds;

        //$this->data['fields'] = app('App\Http\Controllers\Dashboard\FieldController')->getFieldsForOwner($dish, $dish->category);
        return $this->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $this->authorize('access', $dish);

        $validate = [
            'name' => 'required|max:255|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'price' => 'required',
            'category_id' => 'required',
        ];

        if (Auth::user()->hasRole('megaroot')) {
            $validate['restaurant_id'] = 'required';
        }

        $validate = \Validator::make(request()->all(), $validate);

        if ($validate->fails()) {
            return redirect()
                ->back()
                ->withErrors($validate)
                ->withInput()
                ->with('error', 'Ошибка при обновлении блюда, проверьте форму!');
        }

        if (!Auth::user()->hasRole('megaroot')) {
            if ($restaurant = Auth::user()->restaurant) {
                request()->request->set('restaurant_id', $restaurant->id);
            }
        }

        if ($dish->update(request()->all())) {

            \Cache::clear();

            $dish->markers()->sync(request()->get('markers'));
            $dish->recomendeds()->sync(request()->get('recomendeds'));

            //Поля
            //$this->fields($owner);

            //Поля цен
            $this->price_variants($dish);


            //Фото
            if ($img = request()->file('image')) {
                DishRepository::createImage($img, $dish, request()->get('whitespace'));
            }

            if(request('create_copy')){
                return $this->copy($dish);
            }

            return redirect()
                ->route('admin.dishes.index')
                ->with(['success' => 'Блюдо было успешно обновлено!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        $this->authorize('access', $dish);

        if ($dish->delete()) {
            return redirect()
                ->route('admin.dishes.index', 'category_' . $dish->category->id)
                ->with(['success' => 'Блюдо ' . $dish->name . ' было удалено!']);
        }
    }

    public function findRepeat()
    {
        $json = [];

        if($name = request('name')){

            $dishes = Dish::whereRaw('lower(name) like "%' . strtolower($name) . '%"')->get();

            if($dishes->count()){
                $links = [];
                foreach ($dishes as $dish){
                    $links[] = '<a href="'.route('admin.dishes.edit', $dish->id).'">'.$dish->name.'</a>';
                }

                $json['repeat']['name'] = 'Есть блюда с похожим именем: '.implode(', ', $links);
            }
        }

        return response()->json($json);
    }

    public function recomendedsRandom()
    {
        $json = [];

        if($reatuarant_id = request('reatuarant_id')){

            $json = Restaurant::find($reatuarant_id)->dishes()->inRandomOrder()->where('id','!=',request('dish_id'))->select(['id', 'name'])->take(3)->get()->map(function ($dish){
                return $dish->id;
            });
        }

        return response()->json($json);
    }

    protected function price_variants(Dish $dish)
    {
        //Обновление
        $dish_variants = $dish->variants;
        if($variants = request('variants')){

            foreach ($dish_variants as $dish_variant){
                if(!isset($variants[$dish_variant->id])){
                    // Удаление
                    Variant::find($dish_variant->id)->delete();
                }elseif (($dish_variant->name != $variants[$dish_variant->id]['name']) || ($dish_variant->variants != $variants[$dish_variant->id]['variants'])){
                    // Обновление
                    Variant::find($dish_variant->id)->update($variants[$dish_variant->id]);
                }
            }

        }else if($dish_variants->count()){
            $dish->variants()->delete();
        }

        //Новые
        if($new_variants = request('new_variants')){

            foreach ($new_variants as $new_variant){
                if(empty($new_variant['name'])) continue;
                $dish->variants()->create($new_variant);
            }
        }
    }
}
