<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'کدبرگر | لیست نقش ها';
        $routeData = route('admin.role.data');
        $selects = ['id', 'name','permissions_count', 'created_at'];
        return view('admin.role.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {
        $roles = Role::query()->select('roles.*')->withCount('permissions');
        try {
            return DataTables::of($roles)
                ->editColumn('created_at',function ($admin){
                    return $admin->created_at->toJalali()->format('H:i Y-m-d');
                })
                ->addColumn('action', function ($roles) {
                    return Helper::btnMaker(BtnType::Warning, route('admin.role.edit', $roles->id), 'ویرایش');
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = 'نقش ها | ایجاد';
        $routeStore = route('admin.role.store');
        $permissions = Permission::all();
        return view('admin.role.create', compact('title','routeStore','permissions'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $role = new Role();
            $role->givePermissionTo($request->get('permissions'));
            $this->setData($request, $role);
            $role->save();
            return response()->json([
                'result'=>'success',
                'message'=>'نقش کاربری با موفقیت ایجاد شد.'
            ]);
        }catch (Exception $exception){
            return response()->json([
                'result'=>'exception',
                'message'=>$exception->getMessage()
            ],500);
        }
    }

    public function edit(Role $role)
    {
        $title = 'نقش کاربری | ویرایش';
        $routeUpdate = route('admin.role.update', $role->id);
        $routeDestroy = route('admin.role.destroy', $role->id);
        $permissions = Permission::all();
        $permissionSelected = $role->permissions()->pluck('id')->toArray();
        return view('admin.role.edit', compact('title', 'routeUpdate','routeDestroy', 'role','permissions','permissionSelected'));
    }

    public function update(UpdateRequest $request, Role $role)
    {
        try {
            $role->syncPermissions($request->get('permissions'));
            $this->setData($request, $role);
            $role->update();
            return response()->json([
                'result'=>'success',
                'message'=>'نقش کاربری با موفقیت ویرایش شد.'
            ]);
        }catch (Exception $exception){
            return response()->json([
                'result'=>'exception',
                'message'=>$exception->getMessage()
            ],500);
        }

    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect(route('admin.role.index'))->with('success', 'نقش کاربری با موفقیت حذف شد.');
        } catch (Exception $e) {
            return redirect(route('admin.admin.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }
    /**
     * @param Request $request
     * @param Role $role
     */
    protected function setData(Request $request, Role $role): void
    {
        $role->name = $request->get('name');
    }
}
