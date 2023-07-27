<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Database\Category\CategoryType;
use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Sentence\StoreRequest;
use App\Http\Requests\Admin\Sentence\UpdateRequest;
use App\Models\Category;
use App\Models\Sentence;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SentenceController extends Controller
{
    public function index()
    {
        $title = trans('panel.sentence.index');
        $routeData = route('admin.sentence.data');
        $selects = ['id', 'title', 'category.title', 'status', 'created_at'];
        return view('admin.sentence.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $sentences = Sentence::query()
                ->with('category')
                ->has('category');

            return DataTables::of($sentences)
                ->editColumn('status', function ($sentence) {
                    return Helper::renderSentenceStatus($sentence->status);
                })
                ->editColumn('created_at', function ($sentence) {
                    return $sentence->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($sentence) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.sentence.edit', $sentence->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.sentence.show', $sentence->id), trans('panel.action.info'));
                    return $actions;
                })
                ->rawColumns(['action', 'status'])
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = trans('panel.sentence.create');
        $routeStore = route('admin.sentence.store');
        $categories = Category::query()->where('type', CategoryType::Sentence)->get();
        return view('admin.sentence.create', compact('title', 'routeStore', 'categories'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            Sentence::create($item);

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

    public function edit(Sentence $sentence)
    {
        $title = trans('panel.sentence.edit');
        $routeUpdate = route('admin.sentence.update', $sentence->id);
        $routeDestroy = route('admin.sentence.destroy', $sentence->id);
        $categories = Category::query()->where('type', CategoryType::Sentence)->get();
        return view('admin.sentence.edit', compact('title', 'routeUpdate', 'routeDestroy', 'sentence', 'categories'));
    }

    public function update(UpdateRequest $request, Sentence $sentence)
    {
        try {
            $item = $this->itemProvider($request);
            $sentence->update($item);

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

    public function show(Sentence $sentence)
    {
        $title = trans('panel.sentence.show');
        return view('admin.sentence.show', compact('title', 'sentence'));
    }

    public function destroy(Sentence $sentence)
    {
        try {
            $sentence->delete();
            return redirect(route('admin.sentence.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);
            return redirect(route('admin.sentence.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    /**
     * @param Request $request
     * @param bool $editMode
     * @return array
     */
    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['title'] = $request->get('title');
        $item['category_id'] = $request->get('category_id');
        $item['sentence'] = $request->get('sentence');
        $item['translate'] = $request->get('translate');
        $item['status'] = $request->get('status');
        return $item;
    }
}
