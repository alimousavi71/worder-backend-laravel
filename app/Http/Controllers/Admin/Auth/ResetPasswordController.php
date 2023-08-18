<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected string $redirectTo = '/cp-admin-4242';

    public function __construct()
    {
        $this->middleware('admin.guest:admin');
    }

    public function showResetForm(Request $request, $token = null)
    {
        $title = 'Worder | Reset Password';

        return view('admin.auth.passwords.reset', compact('title'))->with(
            [
                'token' => $token,
                'email' => $request->get('email'),
            ]
        );
    }

    public function broker()
    {
        return Password::broker('admins');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
