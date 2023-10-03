<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;

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
    public function redirectTo()
    {
        // Check if user is authenticated with 'admin' guard
        if (Auth::guard('admins')->check()) {
            return RouteServiceProvider::ADMIN ;
        }
        
        // Default redirect for other cases
        return RouteServiceProvider::HOME;
    }
    
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm(Request $request)
    {   
        return view('users.auth.signup');
    }

    public function showAdminLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        // 根据不同的请求条件返回不同的 Guard 实例
        if (request()->is('admin/*')) {
            return auth()->guard('admins');
        }

        return auth()->guard('users');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()->with('error', "錯誤郵箱或密碼");
    }
}

