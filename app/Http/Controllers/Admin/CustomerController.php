<?php

namespace App\Http\Controllers\Admin;
use App\Order;
use App\Restaurant;
use App\User;
use Carbon\Carbon;

class CustomerController extends AdminController
{
    protected
        $start = 0,
        $step = 100;

    public function index(){
        $this->view = 'admin.customers.index';
        $this->title = 'Все покупатели';

        $result = $this->getResult(null, null);

        $this->data['total'] = $result->count();
        $this->data['users'] = $result->take($this->step);

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

    public function getResult($start = 0, $step = 100)
    {
        $q = User::role('customer');

//        if(\Auth::user()->hasRole('megaroot')){
//            if($restaurant_id = request('restaurant_id')){
//                $this->restaurant = Restaurant::find($restaurant_id);
//            }
//            $this->data['restaurants'] = Restaurant::all();
//        }else{
//            $this->restaurant = \Auth::user()->restaurant;
//        }

//        if($this->restaurant){
//            $q = $this->restaurant->orders();
//        }else{
//            $q = Order::query();
//        }
//
//        $q = $q->with('restaurant')->with('user')->with('dishes');

        if($start_d = request('start')){
            $q = $q->whereDate('created_at', '>', Carbon::createFromDate($start_d)->subDay(1));
        }

        if($end_d = request('end')){
            $q = $q->whereDate('created_at', '<', Carbon::createFromDate($end_d)->addDay(1));
        }

        $q = $q
            ->select(['users.*'])
            ->orderBy('created_at', 'desc');

        if($start && $step){
            $q = $q
                ->offset($start)
                ->limit($step);
        }

        return $q->get();
    }

    public function append()
    {
        $results = $this->getResult(request('ot'), $this->step);

        $html = '';
        $is_megaroot = auth()->user()->hasRole('megaroot');
        foreach ($results as $user){
            $html .= view('admin.includes.customer_tr_item', ['user' => $user, 'is_megaroot'=>$is_megaroot])->render();
        }

        return response()->json(['html' => $html, 'request'=>request()->all()]);
    }


}
