<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Admin\AdminController;

use App\Restaurant;
use Spatie\Permission\Models\Role;

use App\Notifications\toNewManagerNotification;
use Storage;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Hash;
use Auth;

class UserController extends AdminController
{
    public function __construct()
    {
        $this->middleware(['role:megaroot|root'])->only(['create', 'index', 'store', 'destroy']);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $this->view = 'admin.users.index';
        $this->title = 'Все управляющие';

        if(auth()->user()->hasRole('megaroot')){
            $this->data['users'] = User::role(['boss', 'manager'])->get();
        }elseif (auth()->user()->hasRole('root')){
            $this->data['users'] = auth()->user()->usersOnPresent;
        }elseif (auth()->user()->hasRole('boss')){
            $this->data['users'] = auth()->user()->restaurant->users()->get();
        }

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.users.form';
        $this->title = 'Добавление нового '. (Auth::user()->hasRole('megaroot|root') ? 'управляющего' : 'менеджера');

        if(auth()->user()->hasRole('megaroot')){
            $this->data['restaurants'] = Restaurant::all();
        }elseif (auth()->user()->hasRole('root')){
            $this->data['restaurants'] = auth()->user()->restaurants;
        }

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
        $validator = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required|min:6|confirmed',
        ];

        if(Auth::user()->hasRole('megaroot')){
            $validator['restaurant_id'] = 'required';
            $validator['role'] = 'required';
        }

        $validator = Validator::make(request()->all(), $validator);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ошибка при сохранении данных!');
        }

        if(!request('order_in_sms')){
            request()->request->add(['order_in_sms' => false]);
        }

        // Валидация прошла ..
        $new_password = request()->get('password');

        request()->request->add(['image' => '']);
        request()->request->add(['provider' => 'email']);
        request()->request->add(['provider_id' => '']);

        $to_save = request()->toArray();
        $to_save['password'] = Hash::make($new_password);

        if(!request()->get('restaurant_id')){
            $to_save['restaurant_id'] = Auth::user()->restaurant->id;
        }

        if($newuser = User::create($to_save)){

            //Фото
            if($img = request()->file('avatar')){
                UserRepository::createThumb($img, $newuser);
            }

            //Назначаем роль
            if(auth()->user()->hasRole('root')){
                $role = 'boss';
            }else {
                $role = 'manager';
            }

            $newuser->assignRole(config('role.names.'.$role.'.name'));

            //$newuser->notify(new toNewManagerNotification($newuser->email, $new_password));
        }

        return redirect()
            ->route('admin.users.index')
            ->with(['success' => 'Менеджер был успешно добавлен! Email для входа: '.request()->get('email').' | Пароль: '.$new_password]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        $this->view = 'pages.user.profile';
        $this->title = 'Профиль пользователя';

        return $this->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->view = 'admin.users.form';
        $this->title = 'Редактировать профиль';
        $this->data['user'] = $user;

        if(auth()->user()->hasRole('megaroot')){
            $this->data['restaurants'] = Restaurant::all();
        }elseif (auth()->user()->hasRole('root')){
            $this->data['restaurants'] = auth()->user()->restaurants;
        }

        return $this->render();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect()
                ->back()
                ->with('gritter', [
                    'title' => 'Менеджер был удален!',
                    'msg'=> 'Вы только что удалили менеджера '.$user->name
                ]);
        }
    }

    public function update(Request $request, User $user)
    {
        $validate = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];

        if(Auth::user()->hasRole('megaroot')){
            $validate['restaurant_id'] = 'required';
            $validate['role'] = 'required';
        }

        if(request()->get('password')){
            $validate['password'] = 'required|min:6|confirmed';
        }else{
            request()->request->remove('password');
            request()->request->remove('password_confirmation');
        }

        $validator = \Validator::make(request()->all(), $validate);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Проверьте форму на ошибки!');
        }

        if(!request('order_in_sms')){
            request()->request->add(['order_in_sms' => false]);
        }

        if(request()->get('role') && config('role.names.'.request()->get('role').'.name')){
            foreach ($user->roles as $role){
                $user->removeRole($role->name);
            }
            $user->assignRole(request()->get('role'));
        }

        if(request()->get('password')){
            request()->request->add(['password' => \Hash::make(request()->get('password'))]);
        }
        if($user->update(request()->toArray())){

            //Фото
            if($img = request()->file('avatar')){
                UserRepository::createThumb($img, $user);
            }

            return redirect()
                ->back()
                ->with('success', 'Данные успешно обновлены!');
        }
    }

    public function _destroy(User $user)
    {
        if($user->delete()){
            return redirect()
                ->route('_user_list')
                ->with('gritter', [
                    'title' => 'Менеджер был удален!',
                    'msg'=> 'Вы только что удалили менеджера '.$user->name
                ]);
        }
    }


}
