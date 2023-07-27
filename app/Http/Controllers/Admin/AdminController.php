<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\Admin;
use DB;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $title = trans('panel.admin.index');
        $routeData = route('admin.admin.data');
        $selects = ['id', 'first_name', 'last_name', 'logins_count', 'created_at'];
        return view('admin.admin.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {
        try {
            $admins = Admin::query()->select('admins.*')->withCount('logins');
            return DataTables::of($admins)
                ->editColumn('created_at', function ($admin) {
                    return $admin->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($admin) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.admin.edit', $admin->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.admin.show', $admin->id), trans('panel.action.info'));
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = trans('panel.admin.create');
        $routeStore = route('admin.admin.store');
        $roles = Role::all();
        return view('admin.admin.create', compact('title', 'routeStore', 'roles'));
    }

    public function store(StoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $item = $this->itemProvider($request);
            $admin = Admin::create($item);
            $admin->syncRoles($request->get('role'));
            DB::commit();
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store')
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_store')
            ], 500);
        }
    }

    public function edit(Admin $admin)
    {
        $title = trans('panel.admin.edit');
        $routeUpdate = route('admin.admin.update', $admin->id);
        $routeDestroy = route('admin.admin.destroy', $admin->id);
        $roles = Role::all();
        return view('admin.admin.edit', compact('title', 'routeUpdate', 'routeDestroy', 'admin', 'roles'));
    }

    public function update(UpdateRequest $request, Admin $admin)
    {
        try {
            DB::beginTransaction();
            $item = $this->itemProvider($request, true);
            $admin->update($item);
            $admin->syncRoles($request->get('role'));
            DB::commit();
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_update')
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_update')
            ], 500);
        }
    }

    public function show(Admin $admin)
    {
        $title = trans('panel.admin.show');
        return view('admin.admin.show', compact('title', 'admin'));
    }

    public function destroy(Admin $admin)
    {
        try {
            DB::beginTransaction();
            $admin->update(['email' => uniqid($admin->email) . '_']);
            $admin->delete();
            DB::commit();
            return redirect(route('admin.admin.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            DB::rollBack();
            report($e);
            return redirect(route('admin.admin.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    /**
     * @param Request $request
     * @param bool $editMode
     * @return array
     */
    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['first_name'] = $request->get('first_name');
        $item['last_name'] = $request->get('last_name');
        $item['password'] = bcrypt($request->get('password'));
        $item['has_access'] = $request->has('has_access');

        if (!$editMode) {
            $item['email'] = $request->get('email');
        }

        if ($request->get('password')) {
            $item['password'] = bcrypt($request->get('password'));
        }

        if ($request->hasFile('avatar')) {
            $provider = (new Uploader())
                ->fit(150, 150)
                ->path('admin')
                ->field('avatar')
                ->upload();
            $item['avatar'] = $provider['photo'];
        }

        return $item;
    }
}
