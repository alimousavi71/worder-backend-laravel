<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Socialite;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function login()
    {
        return Socialite::with('google')->redirect();
    }
}
