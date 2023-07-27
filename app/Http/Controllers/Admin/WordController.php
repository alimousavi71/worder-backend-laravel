<?php

namespace App\Http\Controllers\Admin;

use App\Enums\General\BtnType;
use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Word\StoreRequest;
use App\Http\Requests\Admin\Word\UpdateRequest;
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
        $selects = ['id', 'created_at'];
        return view('admin.word.index', compact('title', 'routeData', 'selects'));
    }

    public function data()
    {

        try {
            $words = Word::query();
            return DataTables::of($words)
                ->editColumn('created_at', function ($word) {
                    return $word->created_at->toJalali()->format('h:i Y-m-d');
                })
                ->addColumn('action', function ($word) {
                    $actions = Helper::btnMaker(BtnType::Warning, route('admin.word.edit', $word->id), 'ویرایش');
                    $actions .= Helper::btnMaker(BtnType::Info, route('admin.word.show', $word->id), 'اطلاعات');
                    return $actions;
                })
                ->make();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function create()
    {
        $title = trans('panel.word.create');
        $routeStore = route('admin.word.store');
        return view('admin.word.create', compact('title', 'routeStore'));
    }

    public function store(StoreRequest $request)
    {
        try {
            $word = new Word();
            $this->setData($request, $word);
            $word->save();
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_store')
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function edit(Word $word)
    {
        $title = trans('panel.word.edit');
        $routeUpdate = route('admin.word.update', $word->id);
        $routeDestroy = route('admin.word.destroy', $word->id);
        return view('admin.word.edit', compact('title', 'routeUpdate','routeDestroy', 'word'));
    }

    public function show(Word $word)
    {
         $title = trans('panel.word.show');
        return view('admin.word.show', compact('title', 'word'));
    }

    public function update(UpdateRequest $request, Word $word)
    {
        try {
            $this->setData($request, $word);

            $word->update();
            return response()->json([
                'result' => 'success',
                'message' => trans('panel.success_update')
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'result' => 'exception',
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    public function destroy(Word $word)
    {
        try {
            $word->delete();
            return redirect(route('admin.word.index'))->with('success', trans('panel.success_delete'));
        } catch (Exception $e) {
            return redirect(route('admin.word.index'))->with('danger', trans('panel.error_delete'));
        }
    }

    /**
     * @param Request $request
     * @param Word $word
     */
    protected function setData(Request $request, Word $word): void
    {
        $word->title = $request->get('title');
    }
}
