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
        $title = 'Worder - Category - List';
        $routeData = route('admin.category.data');
        $selects = ['id', 'created_at'];
        return view('admin.category.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $categories = Category::query();
            return DataTables::of($categories)
                ->editColumn('created_at', function ($category) {
                    return $category->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($category) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.category.edit', $category->id), 'ویرایش');
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.category.show', $category->id), 'اطلاعات');
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = 'Worder - Category - Create';
        $routeStore = route('admin.category.store');
        return view('admin.category.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $category = new Category();
            $this->setData($request, $category);
            $category->save();
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

    public function edit(Category $category)
    {
        $title = 'Worder - Category - Edit';
        $routeUpdate = route('admin.category.update', $category->id);
        $routeDestroy = route('admin.category.destroy', $category->id);
        return view('admin.category.edit', compact('title', 'routeUpdate','routeDestroy', 'category'));
    }

    public function show(Category $category)
    {
        $title = 'Worder - Category - Show';
        return view('admin.category.show', compact('title', 'category'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $this->setData($request, $category);

            $category->update();
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

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect(route('admin.category.index'))->with('success', 'با موفقیت حذف شد.');
        } catch (Exception $e) {
            return redirect(route('admin.category.index'))->with('danger', 'خطایی در سرور به وجود امده است لطفا بعدا تلاش کنید!');
        }
    }

    /**
     * @param Request $request
     * @param Category $category
     */
    protected function setData(Request $request, Category $category): void
    {
        $category->title = $request->get('title');
    }
}
