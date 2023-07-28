<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Database\Word\WordStatus;
use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\User;
use App\Models\Word;
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

        $data = cache()->remember('dashboard', 0, function () {
            $data['users_count'] = User::query()->select('id')->count();

            $data['users'] = User::query()
                ->withCount('words')
                ->limit(20)
                ->latest()
                ->get();

            $words = Word::query()->select(['id','word','translate', 'status'])->latest()->get();
            $data['words'] = $words;
            $data['words_count'] = $words->count();
            $data['words_pending_count'] = $words->where('status', WordStatus::Pending)->count();
            $data['contact_count'] = Contact::query()->select('id', 'is_seen')->where('is_seen', false)->count();
            return $data;
        });

        $title = trans('panel.dashboard.title');
        return view('admin.home.index', compact('title', 'data'));
    }

    public function redirect()
    {
        return Redirect::route('admin.dashboard');
    }
}
