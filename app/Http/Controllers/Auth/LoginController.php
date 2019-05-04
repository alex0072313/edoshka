<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('admin.home');
        $this->middleware('guest')->except('logout');
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('site.home');
    }

    public function customer_login(\Request $request)
    {
        $validate = \Validator::make(request()->all(), [
            'email_or_phone' => 'required|string',
            'password' => 'required|string'
        ], [
            'email_or_phone.required' => 'Укажите Email!',
            'password.required' => 'Укажите Пароль!',
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()]);
        }

        $user = User::where('email', '=', request('email_or_phone'))->first();

        if(!$user) $user = User::where('phone', '=', valid_phone(request('email_or_phone')))->first();


        if($user){
            if(\Auth::attempt([
                'email' => $user->email,
                'password' => request('password'),
            ], request('remember'))){

                if(!auth()->user()->hasRole('customer')){
                    $r = route('admin.home');
                }else{
                    $r = url()->previous();
                }
                return response()->json(['success'=> $r]);
            }
        }
        return response()->json(['invalid_login'=> true]);
    }

}
