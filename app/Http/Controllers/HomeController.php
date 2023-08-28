<?php

namespace App\Http\Controllers;

use Socialite;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('front.welcome');
    }

    public function page()
    {
        return view('front.page');
    }

    public function login()
    {
        return Socialite::with('google')->redirect();
    }
}
