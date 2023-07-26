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

class AdminController extends Controller
{
    public function index()
    {
        $title = 'کدبرگر | لیست مدیران';
        $routeData = route('admin.admin.data');
        $selects = ['id', 'first_name', 'last_name', 'logins_count', 'created_at'];
        return view('admin.admin.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {
        $admin = Admin::query()->select('admins.*')->withCount('logins');
        try {
            return DataTables::of($admin)
                ->editColumn('created_at', function ($admin) {
                    return $admin->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($admin) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.admin.edit', $admin->id), 'ویرایش');
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.admin.show', $admin->id), 'اطلاعات');
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = 'مدیریت | ایجاد';
        $routeStore = route('admin.admin.store');
        $roles = Role::all();
        return view('admin.admin.create', compact('title', 'roles', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $admin = new Admin();
            $admin->email = $request->get('email');
            $this->setData($request, $admin);

            $admin->save();
            return response()->json([
                'result' => 'success',
                'message' => 'مدیر با موفقیت ایجاد شد.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit(Admin $admin)
    {
        $title = 'مدیریت | ویرایش';
        $routeUpdate = route('admin.admin.update', $admin->id);
        $routeDestroy = route('admin.admin.destroy', $admin->id);

        $roles = Role::all();

        $currentRole = '';
        $assignedRoles = $admin->roles()->get();
        if ($assignedRoles->isNotEmpty()) {
            $currentRole = $assignedRoles->first()->id;
        }
        return view('admin.admin.edit', compact('title', 'currentRole', 'routeUpdate','routeDestroy', 'admin', 'roles'));
    }

    public function update(UpdateRequest $request, Admin $admin)
    {
        try {
            $this->setData($request, $admin);

            $admin->update();
            return response()->json([
                'result' => 'success',
                'message' => 'مدیر با موفقیت به روز رسانی شد.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function show(Admin $admin)
    {
        $title = 'کدبرگر | نمایش مدیر';
        $admin->load('logins');
        return view('admin.admin.show', compact('admin', 'title'));
    }

    public function destroy(Admin $admin)
    {
        try {
            $admin->delete();
            return redirect(route('admin.admin.index'))->with('success', 'مدیر با موفقیت حذف شد');
        } catch (Exception $e) {
            return redirect(route('admin.admin.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }

    /**
     * @param Request $request
     * @param Admin $admin
     */
    protected function setData(Request $request, Admin $admin): void
    {
        $admin->first_name = $request->get('first_name');
        $admin->last_name = $request->get('last_name');
        $admin->has_access = $request->has('has_access');

        $admin->syncRoles($request->get('role'));
        if ($request->get('password')) {
            $admin->password = bcrypt($request->get('password'));
        }

        if ($request->hasFile('avatar')) {
            $provider = (new Uploader())
                ->fit(150, 150)
                ->path('admin')
                ->field('avatar')
                ->oldDelete($admin->avatar)
                ->upload();
            $admin->avatar = $provider['photo'];
        }
    }
}
