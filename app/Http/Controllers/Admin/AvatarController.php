<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Uploader\Uploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Avatar\StoreRequest;
use App\Http\Requests\Admin\Avatar\UpdateRequest;
use App\Models\Avatar;
use Exception;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function index()
    {
        $title = trans('panel.avatar.index');
        $avatars = Avatar::query()->orderBy('sort_order')->get();

        return view('admin.avatar.index', compact('title', 'avatars'));
    }

    public function create()
    {
        $title = trans('panel.avatar.create');
        $routeStore = route('admin.avatar.store');

        return view('admin.avatar.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            Avatar::query()->create($item);

            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store'),
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_store'),
            ], 500);
        }
    }

    public function edit(Avatar $avatar)
    {
        $title = trans('panel.avatar.edit');
        $routeUpdate = route('admin.avatar.update', $avatar->id);
        $routeDestroy = route('admin.avatar.destroy', $avatar->id);

        return view('admin.avatar.edit', compact('title', 'routeUpdate', 'routeDestroy', 'avatar'));
    }

    public function update(UpdateRequest $request, Avatar $avatar)
    {
        try {
            $item = $this->itemProvider($request);
            $avatar->update($item);

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

    public function sortItem(StoreRequest $request)
    {
        $avatars = Avatar::query()->get();
        foreach ($avatars as $avatar) {
            $avatar->timestamps = false;
            $id = $avatar->id;
            foreach ($request->get('orders') as $order) {
                if ($order['id'] == $id) {
                    $avatar->update([
                        'sort_order' => $order['position'],
                    ]);
                }
            }
        }

        $response['result'] = 'updated';
        $response['message'] = 'Sort Successfully';

        return response()->json($response);
    }

    public function destroy(Avatar $avatar)
    {
        try {
            $avatar->delete();

            return redirect(route('admin.avatar.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);

            return redirect(route('admin.avatar.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item = [];
        if ($request->hasFile('icon')) {
            $provider = (new Uploader())
                ->fit(450, 450)
                ->path('avatar')
                ->field('icon')
                ->upload();

            $item['icon'] = $provider['photo'];
        }

        return $item;
    }
}
