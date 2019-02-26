<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\UserRepository;

class ProfileController extends AdminController
{
    public function index()
    {
        if(request()->method() == 'POST') return $this->update();

        $this->title = 'Профиль пользователя';
        $this->view = 'admin.profile';

        return $this->render();
    }

    public function update()
    {
        $validate = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.\Auth::user()->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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

        if(\Auth::user()->update(request()->toArray())){

            //Фото
            if($img = request()->file('avatar')){
                UserRepository::createThumb($img, \Auth::user());
            }

            return redirect()
                ->back()
                ->with('success', 'Данные успешно обновлены!');
        }


    }
}
