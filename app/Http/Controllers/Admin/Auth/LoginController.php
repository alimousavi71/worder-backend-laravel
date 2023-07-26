<?php

namespace App\Http\Controllers\Admin\Auth;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Login;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = '/cp-admin-4242';

    public function __construct()
    {
        $this->middleware('admin.guest:admin', ['except' => 'logout']);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function showLoginForm()
    {
        //auth()->guard('admin')->login(Admin::query()->first());
        $title = 'کدبرگر | ورود';
        return view('admin.auth.login',compact('title'));
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect()->route('admin.dashboard');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            //'captcha'=>'required|captcha',
        ]);
    }

    /**
     * @param Request $request
     * @param Admin $user
     */
    protected function authenticated(Request $request, $user)
    {
        $login = new Login();
        $login->userLogin($user);
    }

    protected function credentials(Request $request)
    {
        return array_merge($request->only($this->username(), 'password'), ['has_access' => true]);
    }
}
