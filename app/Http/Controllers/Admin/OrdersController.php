<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Site\SiteController;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController  extends AdminController
{
    public function __construct()
    {
        $this->middleware(['role:megaroot'])->only(['destroy']);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

        if(!$order->viewed){
            $order->viewed = now();
            $order->save();
        }

        $this->view = 'admin.orders.show';
        $this->data['order'] = $order;

        return $this->render();
    }

    public function accept()
    {
        if($order_id = request('order_id')){
            $order = Order::find($order_id);
            $order->accept = now();
            if($order->save()){
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['error'=>true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if($order->delete()){
            return response()->json(['success'=>true]);
        }

        return response()->json(['error'=>true]);
    }
}
