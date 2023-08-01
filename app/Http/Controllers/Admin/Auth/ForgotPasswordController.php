<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('admin.guest:admin');
    }

    public function showLinkRequestForm()
    {
        $title = 'کدبرگر | فراموشی گذرواژه';

        return view('admin.auth.passwords.email', compact('title'));
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            /*'captcha'=>'required|captcha',*/
        ]);
    }
}
