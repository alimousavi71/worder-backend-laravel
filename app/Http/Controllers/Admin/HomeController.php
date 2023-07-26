<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\Admin;
use Exception;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Redirect;
class HomeController extends Controller
{

    public function index()
    {
        $title = 'کدبرگر | لیست مدیران';
        $routeData = route('admin.admin.data');
        $selects = ['id', 'first_name', 'last_name', 'logins_count', 'created_at'];
        return view('admin.home.index', compact('title', 'routeData', 'selects'));
    }

    public function redirect()
    {
        return Redirect::route('admin.dashboard');
    }
}
