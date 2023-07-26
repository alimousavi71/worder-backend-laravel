<?php

namespace App\Http\ViewComposers\Admin\User;

use App\Models\Avatar;
use App\Models\City;
use Illuminate\Contracts\View\View;

class UserComposer
{
    public function __construct()
    {

    }

    public function compose(View $view)
    {

        $avatars = Avatar::query()->get();
        $cities = City::query()->with('province')->get();

        $view->with(compact('avatars','cities'));
    }
}
