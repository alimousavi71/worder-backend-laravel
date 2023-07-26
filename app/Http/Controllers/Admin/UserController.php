<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $title = 'Worder - User - List';
        $routeData = route('admin.user.data');
        $selects = ['id', 'created_at'];
        return view('admin.user.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $users = User::query();
            return DataTables::of($users)
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($user) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.user.edit', $user->id), 'ویرایش');
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.user.show', $user->id), 'اطلاعات');
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = 'Worder - User - Create';
        $routeStore = route('admin.user.store');
        return view('admin.user.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $user = new User();
            $this->setData($request, $user);
            $user->save();
            return response()->json([
                'result' => 'success',
                'message' => 'با موفقیت ایجاد شد.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit(User $user)
    {
        $title = 'Worder - User - Edit';
        $routeUpdate = route('admin.user.update', $user->id);
        $routeDestroy = route('admin.user.destroy', $user->id);
        return view('admin.user.edit', compact('title', 'routeUpdate','routeDestroy', 'user'));
    }

    public function show(User $user)
    {
        $title = 'Worder - User - Show';
        return view('admin.user.show', compact('title', 'user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        try {
            $this->setData($request, $user);

            $user->update();
            return response()->json([
                'result' => 'success',
                'message' => 'با موفقیت به روز رسانی شد.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect(route('admin.user.index'))->with('success', 'با موفقیت حذف شد.');
        } catch (Exception $e) {
            return redirect(route('admin.user.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }

    /**
     * @param Request $request
     * @param User $user
     */
    protected function setData(Request $request, User $user): void
    {
        $user->title = $request->get('title');
    }
}
