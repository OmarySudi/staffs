<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function attemptLogin(Request $request)
    // {
    //     return \Auth::attempt(
    //         $this->credentials($request) + ["verified" => true],
    //         $request->filled('remember')
    //     );
    // }

    protected function attemptLogin(Request $request)
    {
        return \Auth::attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     throw ValidationException::withMessages([
    //         $this->username() => [trans('Authentication failed or Account not activated by administrator')],
    //     ]);
    // }

     protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('Authentication failed, Make sure you enter correct email and password')],
        ]);
    }



}
