<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $title = trans('panel.user.index');
        $routeData = route('admin.user.data');
        $selects = ['id', 'email', 'firstname', 'lastname', 'words_count', 'created_at'];

        return view('admin.user.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $users = User::query()->withCount('words');

            return DataTables::of($users)
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($user) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.user.edit', $user->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.user.show', $user->id), trans('panel.action.info'));

                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(User $user)
    {
        $title = trans('panel.user.edit');
        $routeUpdate = route('admin.user.update', $user->id);
        $routeDestroy = route('admin.user.destroy', $user->id);

        return view('admin.user.edit', compact('title', 'routeUpdate', 'routeDestroy', 'user'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        try {
            $item = $this->itemProvider($request);
            $user->update($item);

            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_update'),
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_update'),
            ], 500);
        }
    }

    public function show(User $user)
    {
        $user->load(['words', 'logins']);

        $totalUse = 0;
        $totalRepeat = 0;
        $totalWrong = 0;
        $totalCorrect = 0;
        $totalIKnow = 0;

        if ($user->words->isNotEmpty()) {
            $usages = $user->words;
            $totalUse = $usages->count();
            $totalRepeat = $usages->sum('pivot.repeat');
            $totalWrong = $usages->sum('pivot.wrong_answer');
            $totalCorrect = $usages->sum('pivot.correct_answer');
            $totalIKnow = $usages->where('pivot.is_knew', true)->count();
        }

        $title = trans('panel.user.show');

        return view('admin.user.show', compact('title', 'user', 'totalCorrect', 'totalWrong', 'totalRepeat', 'totalIKnow', 'totalUse'));
    }

    public function destroy(User $user)
    {
        try {
            $user->update([
                'email' => uniqid($user->email.'_'),
            ]);
            $user->delete();

            return redirect(route('admin.user.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.user.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    protected function itemProvider(Request $request): array
    {
        $item['firstname'] = $request->get('firstname');
        $item['lastname'] = $request->get('lastname');

        if ($request->get('password')) {
            $item['password'] = bcrypt($request->get('password'));
        }

        if ($request->hasFile('avatar')) {
            $provider = (new Uploader())
                ->fit(150, 150)
                ->path('user')
                ->field('avatar')
                ->upload();

            $item['avatar'] = $provider['photo'];
        }

        return $item;
    }
}
