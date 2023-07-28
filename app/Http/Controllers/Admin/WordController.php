<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Database\Category\CategoryType;
use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Word\StoreRequest;
use App\Http\Requests\Admin\Word\UpdateRequest;
use App\Models\Category;
use App\Models\Word;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WordController extends Controller
{
    public function index()
    {
        $title = trans('panel.word.index');
        $routeData = route('admin.word.data');
        $selects = ['id','word','category.title','status', 'created_at'];

        session()->put('word-status',request('status'),null);

        return view('admin.word.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {
        try {
            $words = Word::query()
                ->with('category')
                ->when(is_numeric(session('word-status')),function ($q){
                    return $q->where('status',session('word-status'));
                })
                ->has('category');
            return DataTables::of($words)
                ->editColumn('status', function ($sentence) {
                    return Helper::renderWordStatus($sentence->status);
                })
                ->editColumn('created_at', function ($word) {
                    return $word->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($word) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.word.edit', $word->id), trans('panel.action.edit'));
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.word.show', $word->id), trans('panel.action.info'));
                    return $actions;
                })
                ->rawColumns(['action','status'])
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = trans('panel.word.create');
        $routeStore = route('admin.word.store');
        $categories = Category::query()->where('type', CategoryType::Word)->get();
        return view('admin.word.create', compact('title', 'routeStore','categories'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $item = $this->itemProvider($request);
            Word::create($item);

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

    public function edit(Word $word)
    {
        $title = trans('panel.word.edit');
        $routeUpdate = route('admin.word.update', $word->id);
        $routeDestroy = route('admin.word.destroy', $word->id);
        $categories = Category::query()->where('type', CategoryType::Word)->get();
        return view('admin.word.edit', compact('title', 'routeUpdate','routeDestroy', 'word','categories'));
    }

    public function update(UpdateRequest $request, Word $word)
    {
        try {
            $item = $this->itemProvider($request);
            $word->update($item);

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

    public function show(Word $word)
    {
        $title = trans('panel.word.show');
        $totalUse = 0;
        $totalRepeat = 0;
        $totalWrong = 0;
        $totalCorrect = 0;
        $totalIKnow = 0;

        $word->load(['users','user']);

        if ($word->users->isNotEmpty()){
            $usages = $word->users;
            $totalUse = $usages->count();
            $totalRepeat = $usages->sum('pivot.repeat');
            $totalWrong = $usages->sum('pivot.wrong_answer');
            $totalCorrect = $usages->sum('pivot.correct_answer');
            $totalIKnow = $usages->where('pivot.is_knew',true)->count();
        }

        return view('admin.word.show', compact('title', 'word','totalUse','totalRepeat','totalWrong','totalCorrect','totalIKnow'));
    }

    public function destroy(Word $word)
    {
        try {
            $word->delete();
            return redirect(route('admin.word.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            report($e);
            return redirect(route('admin.word.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    /**
     * @param Request $request
     * @param bool $editMode
     * @return array
     */
    protected function itemProvider(Request $request, bool $editMode = false): array
    {
        $item['category_id'] = $request->get('category_id');
        $item['word'] = $request->get('word');
        $item['translate'] = $request->get('translate');
        $item['description'] = $request->get('description');
        $item['status'] = $request->get('status');
        return $item;
    }
}