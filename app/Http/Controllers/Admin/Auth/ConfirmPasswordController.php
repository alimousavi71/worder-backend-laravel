<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected string $redirectTo = '/cp-admin-4242';

    public function __construct()
    {
        $this->middleware('admin.auth');
    }

    public function showConfirmForm()
    {
        return view('admin.auth.passwords.confirm');
    }

    protected function resetPasswordConfirmationTimeout(Request $request)
    {
        $request->session()->put('admin.auth.password_confirmed_at', time());
    }

    protected function rules()
    {
        return [
            'password' => 'required|password:admin',
        ];
    }
}
