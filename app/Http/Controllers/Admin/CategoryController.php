<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        $title = trans('panel.category.index');
        $routeData = route('admin.category.data');
        $selects = ['id', 'title', 'type', 'words_count', 'created_at'];
        return view('admin.category.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $categories = Category::query()->withCount('words');
            return DataTables::of($categories)
                ->editColumn('type', function ($category) {
                    return Helper::renderCategoryType($category->type);
                })
                ->editColumn('created_at', function ($category) {
                    return $category->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($category) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.category.edit', $category->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.category.show', $category->id), trans('panel.action.info'));
                    return $actions;
                })
                ->rawColumns(['action','type'])
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = trans('panel.category.create');
        $routeStore = route('admin.category.store');
        return view('admin.category.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            Category::create($item);
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store')
            ]);
        } catch (Exception $e) {
            report($e);
            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_store')
            ], 500);
        }
    }

    public function edit(Category $category)
    {
        $title = trans('panel.category.edit');
        $routeUpdate = route('admin.category.update', $category->id);
        $routeDestroy = route('admin.category.destroy', $category->id);
        return view('admin.category.edit', compact('title', 'routeUpdate', 'routeDestroy', 'category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $item = $this->itemProvider($request);
            $category->update($item);
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_update')
            ]);
        } catch (Exception $e) {
            report($e);
            return response()->json([
                'result' => 'exception',
                'message' => trans('panel.error_update')
            ], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect(route('admin.category.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);
            return redirect(route('admin.category.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    public function show(Category $category)
    {
        $title = trans('panel.category.show');
        return view('admin.category.show', compact('title', 'category'));
    }

    /**
     * @param Request $request
     * @param bool $editMode
     * @return array
     */
    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['title'] = $request->get('title');
        $item['description'] = $request->get('description');
        $item['type'] = $request->get('type');
        $item['icon'] = $request->get('icon');

        return $item;
    }
}
