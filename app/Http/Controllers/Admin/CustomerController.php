<?php

namespace App\Http\Controllers\Admin;
use App\User;

class CustomerController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $this->view = 'admin.customers.index';
        $this->title = 'Все покупатели';

        $this->data['users'] = User::role('customer')->get();

        return $this->render();
    }

    public function show(User $user)
    {
        $this->view = 'admin.customers.view';
        $this->title = 'Профиль пользователя';

        return $this->render();
    }

    public function destroy(User $user)
    {
        if($user->delete()){
            return redirect()
                ->back()
                ->with('gritter', [
                    'title' => 'Покупатель был удален!',
                    'msg'=> 'Вы только что удалили покупателя '.$user->name
                ]);
        }
    }


}
