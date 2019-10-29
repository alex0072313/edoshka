<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Http\Controllers\Admin\AdminController;

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

class PresentController extends AdminController
{
    public function __construct()
    {
        $this->middleware(['role:megaroot'])->only(['create', 'index', 'store', 'destroy']);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $this->view = 'admin.presents.index';
        $this->title = 'Все представители';

        $users = User::role('root')->get();
        $this->data['users'] = $users;

        return $this->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->view = 'admin.presents.form';
        $this->title = 'Добавление нового представителя';

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

        $validator = Validator::make(request()->all(), $validator);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Ошибка при сохранении данных!');
        }

        // Валидация прошла ..
        $new_password = request()->get('password');

        request()->request->add(['image' => '']);
        request()->request->add(['provider' => 'email']);
        request()->request->add(['provider_id' => '']);

        $to_save = request()->toArray();
        $to_save['password'] = Hash::make($new_password);

        if($newuser = User::create($to_save)){
            //Фото
            if($img = request()->file('avatar')){
                UserRepository::createThumb($img, $newuser);
            }

            //Назначаем роль
            $newuser->assignRole(config('role.names.root.name'));
        }

        return redirect()
            ->route('admin.presents.index')
            ->with(['success' => 'Представитель был успешно добавлен! Email для входа: '.request()->get('email').' | Пароль: '.$new_password]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(User $user)
    {
        $this->view = 'pages.presents.profile';
        $this->title = 'Профиль представителя';

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
        $this->view = 'admin.presents.form';
        $this->title = 'Редактировать профиль';
        $this->data['user'] = $user;

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
                    'title' => 'Представитель был удален!',
                    'msg'=> 'Вы только что представителя '.$user->name
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

}
