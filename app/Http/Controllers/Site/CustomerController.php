<?php

namespace App\Http\Controllers\Site;
use App\Http\Middleware\Customer;
use App\Repositories\UserRepository;
use App\User;

class CustomerController extends SiteController
{
    public function __construct()
    {
        $this->middleware(Customer::class);
        parent::__construct();

        $this->longtitle = 'Кабинет пользователя';

    }

    public function index()
    {
        $this->view = 'site.customer.home';

        $this->title = 'Личный кабинет';

        return $this->render();
    }

    public function profile(User $user)
    {
        if(request()->method() == 'POST') return $this->updateProfile($user);

        $this->view = 'site.customer.profile';
        $this->title = 'Личный кабинет | Профиль';
        $this->data['user'] = auth()->user();

        return $this->render();
    }

    protected function updateProfile(User $user)
    {

        $validate = \Validator::make(request()->all(), [
            'name' => 'required|min:2|max:20|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phone' => 'required|phone_number',
            'accept_policy' => 'required'
        ], [
            'name.required' => 'Необходимо указать Имя!',
            'name.min' => 'Имя не должно быть менее 2 символов!',
            'name.max' => 'Имя не должно быть более 20 символов!',
            'phone.required' => 'Необходимо указать Телефон!',
            'phone.phone_number' => 'Телефон указан не верно!',
            'email.required' => 'Email не должен быть пуст!',
            'email.email' => 'Email не корректен!',
            'avatar.image' => 'Аватар должен быть изображением!',
            'avatar.max' => 'Аватар должен быть размером не более 2 МБ!',
            'accept_policy.required' => 'Необходимо согласиться с политикой конфиденциальности!',
        ]);

        if($validate->fails()){
            return redirect()
                    ->back()
                    ->withErrors($validate)
                    ->withInput()
                    ->with('error', 'Проверьте форму на ошибки!');
        }

        if(!request('responder')){
            request()->request->add(['responder' => false]);
        }

        if($user->update(request()->all())){

            //Фото
            if($img = request()->file('avatar')){
                UserRepository::createThumb($img, $user);
            }

            return redirect()
                ->back()
                ->with('success', 'Данные успешно обновлены!');
        }

    }

    public function orders()
    {

    }


}
